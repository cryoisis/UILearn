@extends('layouts.app')

@section('title', 'Join — UIlearn')

@section('content')
<section class="mx-auto flex min-h-[calc(100svh-4rem)] max-w-6xl items-center justify-center px-4 py-16 sm:px-6">
  <form method="POST" action="{{ route('register') }}" class="glass w-full max-w-md p-6 sm:p-8" novalidate>
    @csrf
    <p class="font-mono text-[11px] uppercase tracking-wider text-[#A8A3E3]">Akses member</p>
    <h1 class="mt-2 text-2xl font-semibold tracking-tight">Buat akun Anda</h1>
    <p class="mt-1 text-sm text-[#363B6C]/80 dark:text-[#EAEDFE]/80">Gratis. Akun baru otomatis berpaket Free.</p>


    <label for="name" class="mt-5 block text-xs font-medium">Nama</label>
    <input id="name" name="name" type="text" autocomplete="name" autofocus value="{{ old('name') }}" class="glass-recessed mt-1 w-full px-3 py-2 text-sm outline-none focus-visible:ring-2 focus-visible:ring-[#A8A3E3]" required>
    @error('name')<p class="mt-1 text-xs text-[#A8A3E3]">{{ $message }}</p>@enderror
    <label for="email" class="mt-5 block text-xs font-medium">Email</label>
    <input id="email" name="email" type="email" autocomplete="email" value="{{ old('email') }}" class="glass-recessed mt-1 w-full px-3 py-2 text-sm outline-none focus-visible:ring-2 focus-visible:ring-[#A8A3E3]" required>
    @error('email')<p class="mt-1 text-xs text-[#A8A3E3]">{{ $message }}</p>@enderror
    <label for="password" class="mt-5 block text-xs font-medium">Password</label>
    <input id="password" name="password" type="password" autocomplete="new-password" minlength="8" class="glass-recessed mt-1 w-full px-3 py-2 text-sm outline-none focus-visible:ring-2 focus-visible:ring-[#A8A3E3]" required>
    @error('password')<p class="mt-1 text-xs text-[#A8A3E3]">{{ $message }}</p>@enderror
    <label for="password_confirmation" class="mt-5 block text-xs font-medium">Konfirmasi password</label>
    <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" class="glass-recessed mt-1 w-full px-3 py-2 text-sm outline-none focus-visible:ring-2 focus-visible:ring-[#A8A3E3]" required>
    @error('password_confirmation')<p class="mt-1 text-xs text-[#A8A3E3]">{{ $message }}</p>@enderror
    <button type="submit" class="btn-primary mt-6 w-full">Create account</button>
    <p class="mt-5 text-center text-sm text-[#363B6C]/80 dark:text-[#EAEDFE]/80">Sudah punya akun? <a href="{{ route('login') }}" class="font-medium underline underline-offset-2 dark:text-[#A8A3E3]">Sign in</a></p>
  </form>
</section>
@endsection
