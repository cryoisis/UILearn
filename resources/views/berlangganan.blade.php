@extends('layouts.app')

@section('title', 'Berlangganan — UIlearn')

@section('content')
@php
  $current = auth()->check() ? auth()->user()->plan : null;
  $status = session('status');
  $freeLimit = $plans['free']['daily_ai_messages'];
@endphp
<div class="mx-auto max-w-6xl space-y-10 px-4 py-10 sm:px-6 sm:py-14">
  {{-- Header Halaman --}}
  <div class="glass overflow-hidden p-6 sm:p-10 lg:p-12">
    <header class="border-0">
      <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">Pilih Paket Belajar Anda</h1>
      <p class="muted prose-optimal mt-4 leading-relaxed sm:text-lg text-base">
        Mulai gratis untuk mempelajari teori dan mengerjakan latihan. Upgrade ke paket Pro untuk mendapatkan bimbingan AI tanpa batas kapan pun Anda membutuhkan arahan desain.
      </p>
    </header>
  </div>

  @if ($status === 'upgraded')
    <div role="status" class="glass flex items-center gap-3 px-5 py-3 text-sm">
      <span class="h-2 w-2 rounded-full bg-[#C6C9E7]"></span>
      <span>Selamat! Akun Anda sekarang berstatus <strong>Pro</strong>. Nikmati AI Chat tanpa batas.</span>
    </div>
  @elseif ($status === 'downgraded')
    <div role="status" class="glass flex items-center gap-3 px-5 py-3 text-sm">
      <span class="h-2 w-2 rounded-full bg-[#C6C9E7]"></span>
      <span>Akun Anda telah dikembalikan ke paket <strong>Free</strong>.</span>
    </div>
  @endif

  {{-- Dua Kartu Harga --}}
  <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    {{-- Free --}}
    <article class="glass flex flex-col justify-between p-6 sm:p-8 {{ $current === 'free' ? 'ring-2 ring-[#C6C9E7]' : '' }}" aria-labelledby="plan-free">
      <div>
        <div class="flex items-center justify-between">
          <h2 id="plan-free" class="font-bold tracking-tight text-xl sm:text-2xl">Free</h2>
          @if ($current === 'free')<span class="badge">Paket Anda</span>@endif
        </div>
        <p class="mt-3 text-3xl font-extrabold">Rp0</p>
        <p class="muted mt-1 text-xs">Otomatis aktif untuk semua akun baru</p>
        
        <ul class="mt-6 space-y-3 text-sm leading-relaxed">
          <li class="flex items-start gap-2.5">
            <span class="accent font-bold" aria-hidden="true">✓</span>
            <span>Semua materi lengkap &amp; FAQ (Tata Letak, Warna, Typography)</span>
          </li>
          <li class="flex items-start gap-2.5">
            <span class="accent font-bold" aria-hidden="true">✓</span>
            <span>10 soal latihan interaktif per topik (5 mudah, 5 sedang)</span>
          </li>
          <li class="flex items-start gap-2.5">
            <span class="accent font-bold" aria-hidden="true">✓</span>
            <span>AI Chat dibatasi {{ $freeLimit }} pesan per hari</span>
          </li>
          <li class="muted flex items-start gap-2.5">
            <span aria-hidden="true">✗</span>
            <span>Bantuan AI langsung saat mengerjakan kuis</span>
          </li>
        </ul>
      </div>

      <div class="mt-8 border-t border-[#363B6C]/10 pt-6 dark:border-[#EAEDFE]/10">
        @guest
          <a href="{{ route('register') }}" class="btn-secondary w-full">Daftar Akun Gratis</a>
        @elseif ($current === 'pro')
          <button type="button" class="btn-secondary w-full" data-dialog="downgrade-dialog">Kembali ke Free</button>
        @else
          <p class="muted text-center text-sm font-medium">✓ Paket aktif Anda saat ini</p>
        @endguest
      </div>
    </article>

    {{-- Pro --}}
    <article class="glass relative flex flex-col justify-between p-6 sm:p-8 {{ $current === 'pro' ? 'ring-2 ring-[#C6C9E7]' : 'border-[#C6C9E7]' }}" aria-labelledby="plan-pro">
      <div>
        <div class="flex items-center justify-between">
          <h2 id="plan-pro" class="font-bold tracking-tight text-xl sm:text-2xl">Pro</h2>
          @if ($current === 'pro')
            <span class="badge badge-pro">Paket Anda</span>
          @else
            <span class="badge badge-pro">Sangat Disarankan</span>
          @endif
        </div>
        <p class="mt-3 text-3xl font-extrabold">{{ $price }}</p>
        <p class="muted mt-1 text-xs">Akses penuh pembelajaran dan pendampingan AI</p>

        <ul class="mt-6 space-y-3 text-sm leading-relaxed">
          <li class="flex items-start gap-2.5">
            <span class="accent font-bold" aria-hidden="true">✓</span>
            <span>Seluruh akses yang ada di paket Free</span>
          </li>
          <li class="flex items-start gap-2.5">
            <span class="accent font-bold" aria-hidden="true">✓</span>
            <span>AI Chat <strong>tanpa batas</strong> pesan per hari</span>
          </li>
          <li class="flex items-start gap-2.5">
            <span class="accent font-bold" aria-hidden="true">✓</span>
            <span>Bantuan AI di halaman kuis latihan tanpa batas dan tanpa jeda (Free: {{ config('uilearn.plans.free.exercise_ai_messages', 5) }} pesan lalu jeda 30 menit)</span>
          </li>
          <li class="flex items-start gap-2.5">
            <span class="accent font-bold" aria-hidden="true">✓</span>
            <span>Riwayat percakapan konsultasi desain tersimpan rapi</span>
          </li>
        </ul>
      </div>

      <div class="mt-8 border-t border-[#363B6C]/10 pt-6 dark:border-[#EAEDFE]/10">
        @guest
          <a href="{{ route('register') }}" data-ripple class="btn-primary w-full">Daftar lalu Upgrade</a>
        @elseif ($current === 'pro')
          <p class="muted text-center text-sm font-medium">✓ Anda sudah berlangganan Pro</p>
        @else
          <button type="button" data-ripple class="btn-primary w-full" data-dialog="upgrade-dialog">Upgrade ke Pro Sekarang</button>
        @endguest
      </div>
    </article>
  </div>

  {{-- Tabel Perbedaan Fitur & Garansi Pembelajaran dalam Proporsi Golden Ratio --}}
  <div class="golden-layout items-start gap-8">
    {{-- Tabel (61.8%) --}}
    <section aria-labelledby="diff-title" class="glass overflow-hidden">
      <div class="border-b border-[#363B6C]/10 px-6 py-4 dark:border-[#EAEDFE]/10">
        <h2 id="diff-title" class="font-semibold tracking-tight text-xl sm:text-2xl">Perbandingan Detail Fitur</h2>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full min-w-[380px] border-collapse text-left text-sm">
          <thead>
            <tr class="border-b border-[#363B6C]/10 font-mono text-[11px] uppercase tracking-wider dark:border-[#EAEDFE]/10">
              <th class="px-6 py-3 font-medium"><span class="sr-only">Fitur</span></th>
              <th class="px-6 py-3 font-medium">Free</th>
              <th class="bg-[#C6C9E7]/20 px-6 py-3 font-medium">Pro</th>
            </tr>
          </thead>
          <tbody class="[&_tr]:border-b [&_tr]:border-[#363B6C]/10 dark:[&_tr]:border-[#EAEDFE]/10 [&_tr:last-child]:border-b-0">
            <tr>
              <th scope="row" class="px-6 py-3.5 font-semibold">Materi &amp; FAQ Lengkap</th>
              <td class="px-6 py-3.5">Ya</td>
              <td class="bg-[#C6C9E7]/20 px-6 py-3.5 font-medium">Ya</td>
            </tr>
            <tr>
              <th scope="row" class="px-6 py-3.5 font-semibold">Kuis 10 Soal per Topik</th>
              <td class="px-6 py-3.5">Ya</td>
              <td class="bg-[#C6C9E7]/20 px-6 py-3.5 font-medium">Ya</td>
            </tr>
            <tr>
              <th scope="row" class="px-6 py-3.5 font-semibold">AI Chat Harian</th>
              <td class="px-6 py-3.5">{{ $freeLimit }} pesan/hari</td>
              <td class="bg-[#C6C9E7]/20 px-6 py-3.5 font-semibold">Tanpa batas</td>
            </tr>
            <tr>
              <th scope="row" class="px-6 py-3.5 font-semibold">AI saat Mengerjakan Soal</th>
              <td class="px-6 py-3.5">{{ config('uilearn.plans.free.exercise_ai_messages', 5) }} pesan, lalu jeda 30 menit</td>
              <td class="bg-[#C6C9E7]/20 px-6 py-3.5 font-semibold">Tanpa batas</td>
            </tr>
          </tbody>
        </table>
      </div>
    </section>

    {{-- Info Samping / Garansi (38.2%) --}}
    <aside class="glass space-y-4 p-6">
      <p class="eyebrow">Keamanan &amp; Kualitas</p>
      <h3 class="font-semibold text-xl">Belajar Mandiri dengan Dukungan Nyata</h3>
      <p class="muted prose-optimal leading-relaxed text-base">
        Setiap kurikulum di UIlearn disusun berdasarkan standar industri dan prinsip estetika matematis. Upgrade Anda membantu kami terus mengembangkan materi terbaru.
      </p>
      <div class="glass-recessed p-3 font-mono text-[11px] leading-relaxed">
        Transaksi aman &amp; instan. Akun Pro langsung aktif setelah pembayaran dikonfirmasi.
      </div>
    </aside>
  </div>
</div>

@auth
  <dialog id="upgrade-dialog" class="confirm-dialog" aria-labelledby="up-title">
    <form method="POST" action="{{ route('subscription.upgrade') }}" class="p-6">
      @csrf
      <h2 id="up-title" class="font-semibold text-xl sm:text-2xl">Upgrade ke Pro?</h2>
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
      <h2 id="down-title" class="font-semibold text-xl sm:text-2xl">Kembali ke Free?</h2>
      <p class="muted mt-2 text-sm">AI Chat akan dibatasi {{ $freeLimit }} pesan per hari dan bantuan AI saat latihan dibatasi {{ config('uilearn.plans.free.exercise_ai_messages', 5) }} pesan, lalu jeda 30 menit.</p>
      <div class="mt-6 flex justify-end gap-2">
        <button type="button" class="btn-secondary" data-close>Batal</button>
        <button type="submit" class="btn-primary">Ya, kembali ke Free</button>
      </div>
    </form>
  </dialog>
@endauth
@endsection
