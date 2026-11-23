@extends('layouts.app')

@section('title', 'Sign in — UIlearn')

@section('content')
<section class="mx-auto flex min-h-[calc(100svh-4rem)] max-w-6xl items-center justify-center px-4 py-16 sm:px-6">
  <form method="POST" action="{{ route('login') }}" class="glass w-full max-w-md p-6 sm:p-8" novalidate>
    @csrf
    <p class="font-mono text-[11px] uppercase tracking-wider text-[#A8A3E3]">Akses member</p>
    <h1 class="mt-2 text-2xl font-semibold tracking-tight">Selamat datang kembali</h1>
    <p class="mt-1 text-sm text-[#363B6C]/80 dark:text-[#EAEDFE]/80">Masuk untuk mengerjakan latihan dan memakai AI Chat.</p>


    <label for="email" class="mt-5 block text-xs font-medium">Email</label>
    <input id="email" name="email" type="email" autocomplete="email" autofocus value="{{ old('email') }}" class="glass-recessed mt-1 w-full px-3 py-2 text-sm outline-none focus-visible:ring-2 focus-visible:ring-[#A8A3E3]" required>
    @error('email')<p class="mt-1 text-xs text-[#A8A3E3]">{{ $message }}</p>@enderror
    <label for="password" class="mt-5 block text-xs font-medium">Password</label>
    <input id="password" name="password" type="password" autocomplete="current-password" class="glass-recessed mt-1 w-full px-3 py-2 text-sm outline-none focus-visible:ring-2 focus-visible:ring-[#A8A3E3]" required>
    @error('password')<p class="mt-1 text-xs text-[#A8A3E3]">{{ $message }}</p>@enderror
    <label class="mt-4 flex items-center gap-2 text-sm"><input type="checkbox" name="remember" class="h-4 w-4 accent-[#A8A3E3]"> Ingat saya</label>
    <button type="submit" class="btn-primary mt-6 w-full">Sign in</button>
    <p class="mt-5 text-center text-sm text-[#363B6C]/80 dark:text-[#EAEDFE]/80">Belum punya akun? <a href="{{ route('register') }}" class="font-medium underline underline-offset-2 dark:text-[#A8A3E3]">Buat akun an account</a></p>
  </form>
</section>
@endsection
