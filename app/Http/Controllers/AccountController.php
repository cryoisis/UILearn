<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AccountController extends Controller
{
    public function show(Request $request)
    {
        return view('profile', [
            'user' => $request->user(),
            'plan' => config('uilearn.plans')[$request->user()->plan] ?? config('uilearn.plans.free'),
        ]);
    }

    public function update(Request $request): RedirectResponse
    {
        $data = $request->validateWithBag('profile', [
            'name' => ['required', 'string', 'max:255'],
        ]);

        $request->user()->update(['name' => $data['name']]);

        return back()->with('status', 'profile-updated');
    }

    public function password(Request $request): RedirectResponse
    {
        $data = $request->validateWithBag('password', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        // Cast "hashed" pada model User meng-hash password saat disimpan.
        $request->user()->update(['password' => $data['password']]);

        return back()->with('status', 'password-updated');
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('delete', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();
        $user->delete(); // pesan chat ikut terhapus (cascade)

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('status', 'account-deleted');
    }
}
