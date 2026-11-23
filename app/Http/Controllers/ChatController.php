<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Services\Assistant;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request, Assistant $assistant)
    {
        $user = $request->user();

        return view('chat', [
            'messages' => Message::where('user_id', $user->id)->orderBy('id')->get(['id', 'role', 'content']),
            'live' => $assistant->live(),
            'model' => config('uilearn.ai.model'),
            'presets' => collect(config('uilearn.presets'))->pluck('q')->values(),
            'remaining' => $this->remaining($request),
        ]);
    }

    public function send(Request $request, Assistant $assistant): JsonResponse
    {
        $data = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
            'context' => ['nullable', 'string', 'max:1000'],
            'source' => ['nullable', 'in:page,exercise'],
        ]);

        $user = $request->user();
        $plan = config('uilearn.plans')[$user->plan] ?? config('uilearn.plans.free');

        // Panel AI di halaman latihan hanya untuk Pro.
        if (($data['source'] ?? 'page') === 'exercise' && ! $plan['exercise_ai']) {
            return response()->json([
                'error' => 'Bantuan AI saat latihan hanya tersedia untuk paket Pro.',
                'upgrade' => route('subscription'),
            ], 403);
        }

        if ($this->remaining($request) === 0) {
            return response()->json([
                'error' => 'Batas pesan AI harian paket Free sudah habis. Upgrade ke Pro untuk tanpa batas.',
                'upgrade' => route('subscription'),
                'remaining' => 0,
            ], 429);
        }

        $history = Message::where('user_id', $user->id)
            ->latest('id')
            ->limit(config('uilearn.ai.history', 20))
            ->get(['role', 'content'])
            ->reverse()
            ->values()
            ->map(fn ($m) => ['role' => $m->role, 'content' => $m->content])
            ->all();

        Message::create(['user_id' => $user->id, 'role' => 'user', 'content' => $data['message']]);
        $this->countUsage($request);

        $reply = $assistant->reply($history, $data['message'], $data['context'] ?? null);

        $message = Message::create(['user_id' => $user->id, 'role' => 'assistant', 'content' => $reply]);

        return response()->json([
            'message' => $message->only(['id', 'role', 'content']),
            'remaining' => $this->remaining($request),
        ]);
    }

    public function clear(Request $request): JsonResponse
    {
        Message::where('user_id', $request->user()->id)->delete();

        return response()->json(['ok' => true, 'remaining' => $this->remaining($request)]);
    }

    /** Sisa pesan AI hari ini. null = tanpa batas (Pro). */
    private function remaining(Request $request): ?int
    {
        $user = $request->user();
        $limit = (config('uilearn.plans')[$user->plan] ?? config('uilearn.plans.free'))['daily_ai_messages'];

        if ($limit === null) {
            return null;
        }

        $used = $user->ai_used_on?->isToday() ? $user->ai_used_count : 0;

        return max(0, $limit - $used);
    }

    private function countUsage(Request $request): void
    {
        $user = $request->user();
        $today = $user->ai_used_on?->isToday();

        $user->forceFill([
            'ai_used_on' => now()->toDateString(),
            'ai_used_count' => $today ? $user->ai_used_count + 1 : 1,
        ])->save();
    }
}
