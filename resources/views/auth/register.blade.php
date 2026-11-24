@extends('layouts.app')

@section('title', 'Join — UIlearn')

@section('content')
<section class="mx-auto flex min-h-[calc(100svh-5rem)] max-w-5xl items-center justify-center px-4 py-12 sm:px-6 sm:py-16">
  {{-- Tata Letak Divine Proportion (Golden Ratio: ~38% Pengantar Kiri Atas / ~62% Formulir Register) --}}
  <div class="glass golden-layout-reverse w-full items-stretch overflow-hidden p-6 sm:p-10 lg:p-12">
    {{-- Kolom Kiri: Fokus Sudut Kiri Atas (F-Pattern) & Ringkasan Nilai --}}
    <div class="f-focal-point flex flex-col justify-between border-b border-[#363B6C]/10 pb-6 pl-3 dark:border-[#EAEDFE]/10 sm:pl-4 lg:border-b-0 lg:border-r lg:pb-0 lg:pr-8">
      <div>
        <div class="flex items-center gap-2 font-mono text-base font-semibold tracking-tight">
          <img src="{{ asset('images/logo.png') }}" alt="UI" width="26" height="32" loading="eager" class="h-7 w-auto dark:hidden" />
          <img src="{{ asset('images/logo-dark.png') }}" alt="UI" width="26" height="32" loading="eager" class="hidden h-7 w-auto dark:inline-block" />
          <span>Learn</span>
        </div>
        <p class="eyebrow mt-4">Bergabung Bersama Kami</p>
        <h1 class="mt-2 text-3xl font-bold tracking-tight">Buat Akun Anda</h1>
        <p class="muted prose-optimal mt-3 text-sm leading-relaxed">
          100% Gratis. Akun baru otomatis mendapatkan paket Free dengan akses penuh ke materi, kuis 10 soal, dan konsultasi AI harian.
        </p>
      </div>

      <div class="glass-recessed mt-6 space-y-2 p-4 text-xs leading-relaxed">
        <p class="font-semibold text-[#363B6C] dark:text-[#C6C9E7]">🎯 Keuntungan Bergabung</p>
        <ul class="muted space-y-1">
          <li>✓ Pelajari Divine Proportion (Golden Ratio 1:1,618)</li>
          <li>✓ Kuasai penempatan elemen dengan Rule of Thirds</li>
          <li>✓ Latihan interaktif dengan evaluasi otomatis</li>
        </ul>
      </div>
    </div>

    {{-- Kolom Kanan: Form Register --}}
    <form method="POST" action="{{ route('register') }}" class="flex flex-col justify-center pt-6 lg:pt-0" novalidate>
      @csrf
      <h2 class="text-xl font-semibold tracking-tight">Pendaftaran Akun Baru</h2>
      <p class="muted prose-optimal mt-1 text-xs">Lengkapi data diri singkat Anda untuk memulai pembelajaran.</p>

      <label for="name" class="mt-4 block text-xs font-medium">Nama Lengkap</label>
      <input id="name" name="name" type="text" autocomplete="name" autofocus value="{{ old('name') }}" class="glass-recessed mt-1 w-full px-3 py-2 text-sm outline-none focus-visible:ring-2 focus-visible:ring-[#C6C9E7]" required>
      @error('name')<p class="mt-1 text-xs text-[#9b2c4a] dark:text-[#ffb3c4]">{{ $message }}</p>@enderror

      <label for="email" class="mt-3.5 block text-xs font-medium">Alamat Email</label>
      <input id="email" name="email" type="email" autocomplete="email" value="{{ old('email') }}" class="glass-recessed mt-1 w-full px-3 py-2 text-sm outline-none focus-visible:ring-2 focus-visible:ring-[#C6C9E7]" required>
      @error('email')<p class="mt-1 text-xs text-[#9b2c4a] dark:text-[#ffb3c4]">{{ $message }}</p>@enderror

      <label for="password" class="mt-3.5 block text-xs font-medium">Password</label>
      <input id="password" name="password" type="password" autocomplete="new-password" minlength="8" class="glass-recessed mt-1 w-full px-3 py-2 text-sm outline-none focus-visible:ring-2 focus-visible:ring-[#C6C9E7]" required>
      @error('password')<p class="mt-1 text-xs text-[#9b2c4a] dark:text-[#ffb3c4]">{{ $message }}</p>@enderror

      <label for="password_confirmation" class="mt-3.5 block text-xs font-medium">Konfirmasi Password</label>
      <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" class="glass-recessed mt-1 w-full px-3 py-2 text-sm outline-none focus-visible:ring-2 focus-visible:ring-[#C6C9E7]" required>
      @error('password_confirmation')<p class="mt-1 text-xs text-[#9b2c4a] dark:text-[#ffb3c4]">{{ $message }}</p>@enderror

      <button type="submit" data-ripple class="btn-primary mt-6 w-full">Daftar Akun Gratis</button>

      <p class="muted mt-5 text-center text-xs">
        Sudah memiliki akun? <a href="{{ route('login') }}" class="font-semibold text-[#363B6C] underline underline-offset-2 hover:text-[#363B6C]/60 dark:hover:text-[#C6C9E7] dark:text-[#EAEDFE]">Sign in di sini</a>
      </p>
    </form>
  </div>
</section>
@endsection
