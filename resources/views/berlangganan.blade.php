@extends('layouts.app')

@section('title', 'Berlangganan — UIlearn')

@section('content')
@php
  $current = auth()->check() ? auth()->user()->plan : null;
  $status = session('status');
  $freeLimit = $plans['free']['daily_ai_messages'];
@endphp
<div class="mx-auto max-w-5xl space-y-8 px-4 py-10 sm:px-6 sm:py-14">
  <header class="max-w-2xl">
    <p class="eyebrow">Berlangganan</p>
    <h1 class="mt-2 text-4xl font-bold tracking-tight sm:text-5xl">Pilih paket belajar Anda</h1>
    <p class="muted mt-4 text-base leading-relaxed">Mulai gratis, upgrade ke Pro kapan saja untuk membuka AI tanpa batas.</p>
  </header>

  @if ($status === 'upgraded')
    <div role="status" class="glass px-5 py-3 text-sm">Selamat! Akun Anda sekarang berstatus <strong>Pro</strong>.</div>
  @elseif ($status === 'downgraded')
    <div role="status" class="glass px-5 py-3 text-sm">Akun Anda kembali ke paket <strong>Free</strong>.</div>
  @endif

  <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
    {{-- Free --}}
    <article class="glass flex flex-col p-6 sm:p-8 {{ $current === 'free' ? 'ring-2 ring-[#A8A3E3]' : '' }}" aria-labelledby="plan-free">
      <div class="flex items-center justify-between">
        <h2 id="plan-free" class="text-2xl font-semibold tracking-tight">Free</h2>
        @if ($current === 'free')<span class="badge">Paket Anda</span>@endif
      </div>
      <p class="mt-2 text-3xl font-bold">Rp0</p>
      <p class="muted text-sm">Otomatis untuk akun baru</p>
      <ul class="mt-5 flex-1 space-y-2 text-sm leading-relaxed">
        <li><span aria-hidden="true">✓</span> Semua materi dan FAQ (3 topik)</li>
        <li><span aria-hidden="true">✓</span> Latihan 10 soal per topik</li>
        <li><span aria-hidden="true">✓</span> AI Chat dibatasi {{ $freeLimit }} pesan per hari</li>
        <li class="muted"><span aria-hidden="true">✗</span> Bantuan AI saat mengerjakan latihan</li>
      </ul>
      <div class="mt-6">
        @guest
          <a href="{{ route('register') }}" class="btn-secondary w-full">Daftar gratis</a>
        @elseif ($current === 'pro')
          <button type="button" class="btn-secondary w-full" data-dialog="downgrade-dialog">Kembali ke Free</button>
        @else
          <p class="muted text-center text-sm">Paket aktif Anda saat ini</p>
        @endguest
      </div>
    </article>

    {{-- Pro --}}
    <article class="glass flex flex-col p-6 sm:p-8 {{ $current === 'pro' ? 'ring-2 ring-[#A8A3E3]' : '' }}" aria-labelledby="plan-pro">
      <div class="flex items-center justify-between">
        <h2 id="plan-pro" class="text-2xl font-semibold tracking-tight">Pro</h2>
        @if ($current === 'pro')<span class="badge badge-pro">Paket Anda</span>@else<span class="badge badge-pro">Disarankan</span>@endif
      </div>
      <p class="mt-2 text-3xl font-bold">{{ $price }}</p>
      <p class="muted text-sm">Akses penuh termasuk AI</p>
      <ul class="mt-5 flex-1 space-y-2 text-sm leading-relaxed">
        <li><span aria-hidden="true">✓</span> Semua yang ada di Free</li>
        <li><span aria-hidden="true">✓</span> AI Chat <strong>tanpa batas</strong> pesan</li>
        <li><span aria-hidden="true">✓</span> Bantuan AI langsung di halaman latihan</li>
        <li><span aria-hidden="true">✓</span> Riwayat percakapan tersimpan</li>
      </ul>
      <div class="mt-6">
        @guest
          <a href="{{ route('register') }}" class="btn-primary w-full">Daftar lalu upgrade</a>
        @elseif ($current === 'pro')
          <p class="muted text-center text-sm">Anda sudah berlangganan Pro</p>
        @else
          <button type="button" class="btn-primary w-full" data-dialog="upgrade-dialog">Upgrade ke Pro</button>
        @endguest
      </div>
    </article>
  </div>

  {{-- Tabel perbedaan --}}
  <section aria-labelledby="diff-title" class="glass overflow-x-auto">
    <h2 id="diff-title" class="eyebrow px-5 pt-5">Perbedaan paket</h2>
    <table class="mt-3 w-full min-w-[420px] border-collapse text-left text-sm">
      <thead><tr class="border-b border-[#363B6C]/10 font-mono text-[11px] uppercase tracking-wider dark:border-[#EAEDFE]/10"><th class="px-5 py-3 font-medium"><span class="sr-only">Fitur</span></th><th class="px-5 py-3 font-medium">Free</th><th class="bg-[#A8A3E3]/20 px-5 py-3 font-medium">Pro</th></tr></thead>
      <tbody class="[&_tr]:border-b [&_tr]:border-[#363B6C]/10 dark:[&_tr]:border-[#EAEDFE]/10 [&_tr:last-child]:border-b-0">
        <tr><th scope="row" class="px-5 py-3 font-semibold">Materi &amp; FAQ</th><td class="px-5 py-3">Lengkap</td><td class="bg-[#A8A3E3]/20 px-5 py-3">Lengkap</td></tr>
        <tr><th scope="row" class="px-5 py-3 font-semibold">Latihan</th><td class="px-5 py-3">10 soal / topik</td><td class="bg-[#A8A3E3]/20 px-5 py-3">10 soal / topik</td></tr>
        <tr><th scope="row" class="px-5 py-3 font-semibold">AI Chat</th><td class="px-5 py-3">{{ $freeLimit }} pesan / hari</td><td class="bg-[#A8A3E3]/20 px-5 py-3">Tanpa batas</td></tr>
        <tr><th scope="row" class="px-5 py-3 font-semibold">AI saat latihan</th><td class="px-5 py-3">Tidak tersedia</td><td class="bg-[#A8A3E3]/20 px-5 py-3">Tersedia</td></tr>
      </tbody>
    </table>
  </section>
</div>

@auth
  <dialog id="upgrade-dialog" class="confirm-dialog" aria-labelledby="up-title">
    <form method="POST" action="{{ route('subscription.upgrade') }}" class="p-6">
      @csrf
      <h2 id="up-title" class="text-lg font-semibold">Upgrade ke Pro?</h2>
      <p class="muted mt-2 text-sm">Total: {{ $price }}. AI Chat tanpa batas dan bantuan AI saat latihan langsung aktif.</p>
      @if (config('app.debug'))
        <p class="mt-3 rounded-md border border-dashed border-current p-2 text-xs">Mode pengembangan: pembayaran disimulasikan. Hubungkan ke payment gateway sebelum rilis.</p>
      @endif
      <div class="mt-6 flex justify-end gap-2">
        <button type="button" class="btn-secondary" data-close>Batal</button>
        <button type="submit" class="btn-primary">Bayar &amp; upgrade</button>
      </div>
    </form>
  </dialog>
  <dialog id="downgrade-dialog" class="confirm-dialog" aria-labelledby="down-title">
    <form method="POST" action="{{ route('subscription.downgrade') }}" class="p-6">
      @csrf
      <h2 id="down-title" class="text-lg font-semibold">Kembali ke Free?</h2>
      <p class="muted mt-2 text-sm">AI Chat akan dibatasi {{ $freeLimit }} pesan per hari dan bantuan AI saat latihan dinonaktifkan.</p>
      <div class="mt-6 flex justify-end gap-2">
        <button type="button" class="btn-secondary" data-close>Batal</button>
        <button type="submit" class="btn-primary">Ya, kembali ke Free</button>
      </div>
    </form>
  </dialog>
@endauth
@endsection
