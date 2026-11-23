<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Assistant
{
    private const SYSTEM = <<<'TXT'
Kamu adalah asisten belajar UIlearn, platform belajar UI/UX untuk pemula. Jawab dalam bahasa Indonesia yang ramah dan mudah dipahami.

Aturan:
- Fokus pada tiga topik: tata letak (layout, hierarki, grid, white space), warna (palet, kontras, aksesibilitas), dan typography (hierarki, keterbacaan, font pairing).
- Jawab singkat: 1 kalimat pembuka, lalu 2 sampai 4 poin praktis dan contoh konkret.
- Gunakan istilah sederhana dan jelaskan istilah teknis saat pertama kali muncul.
- Jika pengguna sedang mengerjakan soal latihan, bantu dengan petunjuk dan penalaran. Jangan langsung menyebut pilihan jawaban yang benar.
- Jika pertanyaan di luar UI/UX, jawab singkat lalu arahkan kembali ke topik desain.
TXT;

    public function live(): bool
    {
        return filled(config('uilearn.ai.key'));
    }

    /**
     * @param  array<int, array{role: string, content: string}>  $history  oldest first, not including $prompt
     * @param  string|null  $context  mis. soal latihan yang sedang dikerjakan
     */
    public function reply(array $history, string $prompt, ?string $context = null): string
    {
        if ($this->live()) {
            try {
                return $this->ask($history, $prompt, $context);
            } catch (\Throwable $e) {
                Log::warning('uilearn AI request failed: '.$e->getMessage());

                return "Layanan AI sedang tidak dapat dihubungi, jadi ini jawaban offline:\n\n".$this->offline($prompt, $context);
            }
        }

        return $this->offline($prompt, $context);
    }

    private function ask(array $history, string $prompt, ?string $context): string
    {
        $messages = [];
        foreach ($history as $m) {
            // Anthropic mensyaratkan peran bergantian, dimulai dari "user".
            $last = empty($messages) ? null : $messages[array_key_last($messages)]['role'];
            $expected = $last === null || $last === 'assistant' ? 'user' : 'assistant';
            if ($m['role'] === $expected) {
                $messages[] = ['role' => $m['role'], 'content' => Str::limit($m['content'], 6000, '')];
            }
        }
        if (! empty($messages) && $messages[array_key_last($messages)]['role'] === 'user') {
            array_pop($messages);
        }
        $messages[] = ['role' => 'user', 'content' => $prompt];

        $system = self::SYSTEM;
        if ($context) {
            $system .= "\n\nKonteks soal latihan yang sedang dikerjakan pengguna:\n".Str::limit($context, 800, '');
        }

        $response = Http::withHeaders([
            'x-api-key' => config('uilearn.ai.key'),
            'anthropic-version' => '2023-06-01',
        ])->timeout(60)->post('https://api.anthropic.com/v1/messages', [
            'model' => config('uilearn.ai.model'),
            'max_tokens' => config('uilearn.ai.max_tokens'),
            'system' => $system,
            'messages' => $messages,
        ])->throw();

        $text = collect($response->json('content', []))
            ->where('type', 'text')
            ->pluck('text')
            ->implode("\n");

        return trim($text) !== '' ? $text : throw new \RuntimeException('Empty AI response');
    }

    /** Jawaban dummy berbasis kata kunci, dipakai bila belum ada API key. */
    private function offline(string $prompt, ?string $context = null): string
    {
        $needle = Str::lower($prompt.' '.($context ?? ''));
        $best = null;
        $bestScore = 0;

        foreach (config('uilearn.presets') as $slug => $preset) {
            $score = collect($preset['keywords'])->filter(fn ($k) => str_contains($needle, $k))->count();
            if ($score > $bestScore) {
                [$best, $bestScore] = [$slug, $score];
            }
        }

        if ($best === null) {
            return config('uilearn.fallback_answer');
        }

        $answer = config("uilearn.presets.$best.a");

        if ($context) {
            $answer = "Soal ini berkaitan dengan topik berikut. Gunakan sebagai petunjuk, lalu coba tentukan jawabannya sendiri.\n\n".$answer;
        }

        return $answer;
    }
}
