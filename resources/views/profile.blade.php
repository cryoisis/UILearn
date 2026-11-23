@extends('layouts.app')

@section('title', 'Profile — UIlearn')

@section('content')
@php
  $input = 'glass-recessed mt-1 w-full px-3 py-2 text-sm outline-none focus-visible:ring-2 focus-visible:ring-[#A8A3E3]';
  $initials = collect(preg_split('/\s+/', trim($user->name)))->filter()->take(2)->map(fn ($w) => mb_strtoupper(mb_substr($w, 0, 1)))->implode('');
  $status = session('status');
  $isPro = $user->isPro();
@endphp

<div class="mx-auto max-w-6xl space-y-6 px-4 py-10 sm:px-6 sm:py-14">
  <section aria-labelledby="profile-title" class="glass overflow-hidden">
    <div class="eyebrow border-b border-[#363B6C]/10 px-5 py-3 dark:border-[#EAEDFE]/10 sm:px-8">Profile Anda</div>
    <div class="flex flex-col gap-6 px-5 py-8 sm:flex-row sm:items-center sm:px-8 sm:py-10">
      <div class="flex h-20 w-20 shrink-0 items-center justify-center rounded-full bg-[#363B6C] font-mono text-2xl font-semibold text-[#EAEDFE] ring-2 ring-[#A8A3E3] dark:bg-[#EAEDFE]/10" aria-hidden="true">{{ $initials ?: '?' }}</div>
      <div class="min-w-0 flex-1">
        <h1 id="profile-title" class="truncate text-3xl font-bold tracking-tight sm:text-4xl">{{ $user->name }}</h1>
        <p class="muted mt-1 truncate font-mono text-sm">{{ $user->email }}</p>
      </div>
    </div>
  </section>

  @if ($status === 'profile-updated' || $status === 'password-updated')
    <div role="status" class="glass flex items-center gap-3 px-5 py-3 text-sm">
      <span class="h-2 w-2 shrink-0 rounded-full bg-[#A8A3E3]" aria-hidden="true"></span>
      {{ $status === 'profile-updated' ? 'Nama berhasil disimpan.' : 'Password berhasil diubah.' }}
    </div>
  @endif

  {{-- Status berlangganan --}}
  <section aria-labelledby="sub-title" class="glass flex flex-col gap-4 p-6 sm:flex-row sm:items-center sm:justify-between sm:p-8">
    <div>
      <p class="eyebrow">Status berlangganan</p>
      <h2 id="sub-title" class="mt-2 flex items-center gap-3 text-2xl font-semibold tracking-tight">
        Paket {{ $plan['label'] }}
        <span class="badge {{ $isPro ? 'badge-pro' : '' }}">{{ $isPro ? 'Aktif' : 'Default' }}</span>
      </h2>
      <p class="muted mt-1 text-sm">
        @if ($isPro) AI Chat tanpa batas dan bantuan AI saat latihan. @else AI Chat dibatasi {{ $plan['daily_ai_messages'] }} pesan per hari. @endif
      </p>
    </div>
    <a href="{{ route('subscription') }}" class="{{ $isPro ? 'btn-secondary' : 'btn-primary' }} shrink-0">{{ $isPro ? 'Kelola paket' : 'Upgrade ke Pro' }}</a>
  </section>

  <div class="grid grid-cols-1 gap-4 lg:grid-cols-2">
    {{-- Ubah nama --}}
    <form method="POST" action="{{ route('profile.update') }}" class="glass p-6 sm:p-8" novalidate>
      @csrf
      @method('PUT')
      <p class="eyebrow">Detail</p>
      <h2 class="mt-2 text-xl font-semibold tracking-tight">Ubah nama</h2>
      <label for="name" class="mt-5 block text-xs font-medium">Nama</label>
      <input id="name" name="name" type="text" autocomplete="name" value="{{ old('name', $user->name) }}" class="{{ $input }}" required aria-describedby="name-error">
      @if ($errors->profile->has('name'))<p id="name-error" class="mt-1 text-xs font-medium text-[#9b2c4a] dark:text-[#ffb3c4]">{{ $errors->profile->first('name') }}</p>@endif
      <button type="submit" class="btn-primary mt-6">Simpan nama</button>
    </form>

    {{-- Ubah password --}}
    <form method="POST" action="{{ route('profile.password') }}" class="glass p-6 sm:p-8" novalidate>
      @csrf
      @method('PUT')
      <p class="eyebrow">Keamanan</p>
      <h2 class="mt-2 text-xl font-semibold tracking-tight">Ubah password</h2>
      <p class="muted mt-1 text-sm">Gunakan minimal 8 karakter.</p>
      <label for="current_password" class="mt-5 block text-xs font-medium">Password saat ini</label>
      <input id="current_password" name="current_password" type="password" autocomplete="current-password" class="{{ $input }}" required>
      @if ($errors->password->has('current_password'))<p class="mt-1 text-xs font-medium text-[#9b2c4a] dark:text-[#ffb3c4]">{{ $errors->password->first('current_password') }}</p>@endif
      <label for="new_password" class="mt-5 block text-xs font-medium">Password baru</label>
      <input id="new_password" name="password" type="password" autocomplete="new-password" minlength="8" class="{{ $input }}" required>
      @if ($errors->password->has('password'))<p class="mt-1 text-xs font-medium text-[#9b2c4a] dark:text-[#ffb3c4]">{{ $errors->password->first('password') }}</p>@endif
      <label for="password_confirmation" class="mt-5 block text-xs font-medium">Konfirmasi password baru</label>
      <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" class="{{ $input }}" required>
      <button type="submit" class="btn-primary mt-6">Perbarui password</button>
    </form>
  </div>

  {{-- Hapus akun --}}
  <section aria-labelledby="danger-title" class="glass flex flex-col gap-4 border-[#9b2c4a]/40 p-6 sm:flex-row sm:items-center sm:justify-between sm:p-8">
    <div>
      <h2 id="danger-title" class="text-xl font-semibold tracking-tight">Hapus akun</h2>
      <p class="muted mt-1 max-w-xl text-sm">Akun, riwayat chat, dan status berlangganan akan dihapus permanen. Tindakan ini tidak dapat dibatalkan.</p>
    </div>
    <button type="button" class="btn-danger shrink-0" data-dialog="delete-dialog">Hapus akun</button>
  </section>
</div>

<dialog id="delete-dialog" class="confirm-dialog" aria-labelledby="del-title" @if ($errors->delete->any()) data-open-on-load @endif>
  <form method="POST" action="{{ route('profile.destroy') }}" class="p-6">
    @csrf
    @method('DELETE')
    <h2 id="del-title" class="text-lg font-semibold">Hapus akun secara permanen?</h2>
    <p class="muted mt-2 text-sm">Masukkan password untuk mengonfirmasi.</p>
    <label for="delete_password" class="mt-4 block text-xs font-medium">Password</label>
    <input id="delete_password" name="password" type="password" autocomplete="current-password" class="{{ $input }}" required>
    @if ($errors->delete->has('password'))<p class="mt-1 text-xs font-medium text-[#9b2c4a] dark:text-[#ffb3c4]">{{ $errors->delete->first('password') }}</p>@endif
    <div class="mt-6 flex justify-end gap-2">
      <button type="button" class="btn-secondary" data-close>Batal</button>
      <button type="submit" class="btn-danger">Ya, hapus akun</button>
    </div>
  </form>
</dialog>
@endsection
