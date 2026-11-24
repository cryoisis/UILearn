@extends('layouts.app')

@section('title', 'Profile — UIlearn')

@section('content')
@php
  $input = 'glass-recessed mt-1 w-full px-3 py-2 text-sm outline-none focus-visible:ring-2 focus-visible:ring-[#C6C9E7]';
  $initials = collect(preg_split('/\s+/', trim($user->name)))->filter()->take(2)->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))->implode('');
  $status = session('status');
  $isPro = $user->isPro();
@endphp

<div class="mx-auto max-w-6xl space-y-8 px-4 py-10 sm:px-6 sm:py-14">
  {{-- Header Profil dengan Fokus Sudut Kiri Atas (F-Pattern) --}}
  <header class="glass f-focal-point overflow-hidden p-6 sm:p-8">
    <div class="flex flex-col gap-6 sm:flex-row sm:items-center">
      <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-full bg-[#363B6C] font-mono text-2xl font-bold text-[#EAEDFE] ring-4 ring-[#C6C9E7]/40 dark:bg-[#EAEDFE]/10" aria-hidden="true">
        {{ $initials ?: '?' }}
      </div>
      <div class="min-w-0 flex-1">
        <p class="eyebrow">Pengaturan Akun</p>
        <h1 id="profile-title" class="truncate text-3xl font-bold tracking-tight sm:text-4xl">{{ $user->name }}</h1>
        <p class="muted mt-1 truncate font-mono text-sm">{{ $user->email }}</p>
      </div>
      <div>
        <span class="badge {{ $isPro ? 'badge-pro' : '' }} text-xs">Paket {{ $plan['label'] }}</span>
      </div>
    </div>
  </header>

  @if ($status === 'profile-updated' || $status === 'password-updated')
    <div role="status" class="glass flex items-center gap-3 px-5 py-3 text-sm">
      <span class="h-2 w-2 shrink-0 rounded-full bg-[#C6C9E7]" aria-hidden="true"></span>
      <span>{{ $status === 'profile-updated' ? 'Nama profil berhasil diperbarui.' : 'Password akun berhasil diubah.' }}</span>
    </div>
  @endif

  {{-- Tata Letak Divine Proportion (61.8% Form Pengaturan / 38.2% Status Langganan & Info) --}}
  <div class="golden-layout items-start gap-8">
    {{-- Kolom Utama: Form Pengaturan Akun (61.8%) --}}
    <main class="space-y-6">
      {{-- Ubah nama --}}
      <form method="POST" action="{{ route('profile.update') }}" class="glass p-6 sm:p-8" novalidate>
        @csrf
        @method('PUT')
        <p class="eyebrow">Identitas Akun</p>
        <h2 class="mt-2 text-xl font-semibold tracking-tight">Ubah Nama Profil</h2>
        <p class="muted prose-optimal mt-1 text-xs">Nama ini akan ditampilkan pada sertifikat belajar dan navigasi antarmuka.</p>
        
        <label for="name" class="mt-5 block text-xs font-medium">Nama Lengkap</label>
        <input id="name" name="name" type="text" autocomplete="name" value="{{ old('name', $user->name) }}" class="{{ $input }}" required aria-describedby="name-error">
        @if ($errors->profile->has('name'))
          <p id="name-error" class="mt-1 text-xs font-medium text-[#9b2c4a] dark:text-[#ffb3c4]">{{ $errors->profile->first('name') }}</p>
        @endif
        
        <button type="submit" class="btn-primary mt-6">Simpan Perubahan Nama</button>
      </form>

      {{-- Ubah password --}}
      <form method="POST" action="{{ route('profile.password') }}" class="glass p-6 sm:p-8" novalidate>
        @csrf
        @method('PUT')
        <p class="eyebrow">Keamanan</p>
        <h2 class="mt-2 text-xl font-semibold tracking-tight">Perbarui Password</h2>
        <p class="muted prose-optimal mt-1 text-xs">Gunakan minimal 8 karakter dengan kombinasi huruf dan angka.</p>
        
        <label for="current_password" class="mt-5 block text-xs font-medium">Password Saat Ini</label>
        <input id="current_password" name="current_password" type="password" autocomplete="current-password" class="{{ $input }}" required>
        @if ($errors->password->has('current_password'))
          <p class="mt-1 text-xs font-medium text-[#9b2c4a] dark:text-[#ffb3c4]">{{ $errors->password->first('current_password') }}</p>
        @endif
        
        <label for="new_password" class="mt-4 block text-xs font-medium">Password Baru</label>
        <input id="new_password" name="password" type="password" autocomplete="new-password" minlength="8" class="{{ $input }}" required>
        @if ($errors->password->has('password'))
          <p class="mt-1 text-xs font-medium text-[#9b2c4a] dark:text-[#ffb3c4]">{{ $errors->password->first('password') }}</p>
        @endif
        
        <label for="password_confirmation" class="mt-4 block text-xs font-medium">Konfirmasi Password Baru</label>
        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" class="{{ $input }}" required>
        
        <button type="submit" class="btn-primary mt-6">Perbarui Password</button>
      </form>

      {{-- Hapus akun --}}
      <section aria-labelledby="danger-title" class="glass border-[#9b2c4a]/40 p-6 sm:p-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
          <div>
            <h2 id="danger-title" class="text-lg font-semibold text-[#9b2c4a] dark:text-[#ffb3c4]">Hapus Akun Permanen</h2>
            <p class="muted prose-optimal mt-1 text-xs">Akun, riwayat chat, dan status berlangganan akan dihapus permanen.</p>
          </div>
          <button type="button" class="btn-danger shrink-0" data-dialog="delete-dialog">Hapus Akun</button>
        </div>
      </section>
    </main>

    {{-- Kolom Samping: Status Langganan & Info (38.2%) --}}
    <aside class="space-y-6">
      <div class="glass p-6">
        <p class="eyebrow">Langganan Anda</p>
        <h3 class="mt-2 text-2xl font-bold tracking-tight">Paket {{ $plan['label'] }}</h3>
        <p class="muted prose-optimal mt-2 text-xs leading-relaxed">
          @if ($isPro)
            Status Pro aktif: AI Chat tanpa batas harian dan pendampingan AI langsung saat mengerjakan soal kuis.
          @else
            Status Free: AI Chat dibatasi {{ $plan['daily_ai_messages'] }} pesan per hari.
          @endif
        </p>
        <div class="mt-6 border-t border-[#363B6C]/10 pt-4 dark:border-[#EAEDFE]/10">
          <a href="{{ route('subscription') }}" class="{{ $isPro ? 'btn-secondary' : 'btn-primary' }} w-full text-center">
            {{ $isPro ? 'Kelola Paket' : 'Upgrade ke Paket Pro' }}
          </a>
        </div>
      </div>

      <div class="glass-recessed p-5 text-xs leading-relaxed">
        <p class="font-semibold text-[#363B6C] dark:text-[#C6C9E7]">Keseimbangan Struktural</p>
        <p class="muted mt-1">
          Tata letak halaman ini menerapkan proporsi konsisten antara blok utama dan ruang kosong di sekitarnya sehingga memberikan rasa keteraturan alami.
        </p>
      </div>
    </aside>
  </div>
</div>

{{-- Dialog Hapus Akun --}}
<dialog id="delete-dialog" class="confirm-dialog" aria-labelledby="del-title" @if ($errors->delete->any()) data-open-on-load @endif>
  <form method="POST" action="{{ route('profile.destroy') }}" class="p-6">
    @csrf
    @method('DELETE')
    <h2 id="del-title" class="text-lg font-semibold">Hapus akun secara permanen?</h2>
    <p class="muted mt-2 text-sm">Masukkan password untuk mengonfirmasi.</p>
    <label for="delete_password" class="mt-4 block text-xs font-medium">Password</label>
    <input id="delete_password" name="password" type="password" autocomplete="current-password" class="{{ $input }}" required>
    @if ($errors->delete->has('password'))
      <p class="mt-1 text-xs font-medium text-[#9b2c4a] dark:text-[#ffb3c4]">{{ $errors->delete->first('password') }}</p>
    @endif
    <div class="mt-6 flex justify-end gap-2">
      <button type="button" class="btn-secondary" data-close>Batal</button>
      <button type="submit" class="btn-danger">Ya, hapus akun</button>
    </div>
  </form>
</dialog>
@endsection
