@extends('layouts.app')

@section('title', 'Latihan '.$course['title'].' — UIlearn')

@section('content')
@php
  // Free kini boleh memakai AI saat latihan, tetapi dibatasi lalu dijeda. Pro tanpa batas.
  $isPro = auth()->check() && auth()->user()->isPro();
  $canAsk = $aiAllowed || auth()->check();
  $limitMax = (int) config('uilearn.plans.free.exercise_ai_messages', 5);
  $cooldown = (int) config('uilearn.plans.free.exercise_ai_cooldown_minutes', 30);
  $payload = [
    'slug' => $slug,
    'title' => $course['title'],
    'questions' => $course['questions'],
    'aiAllowed' => $aiAllowed,
    'isPro' => $isPro,
    'canAsk' => $canAsk,
    'userId' => auth()->id() ?? 'guest',
    'limit' => ['max' => $limitMax, 'cooldownMin' => $cooldown],
  ];
@endphp

<div id="exercise" class="mx-auto max-w-6xl px-4 py-10 sm:px-6 sm:py-14">
  {{-- Navigasi Breadcrumb --}}
  <nav aria-label="Breadcrumb" class="muted mb-6 font-mono text-xs">
    <a href="{{ route('courses') }}" class="underline underline-offset-2">Kursus</a> /
    <a href="{{ route('lesson', $slug) }}" class="underline underline-offset-2">{{ $course['title'] }}</a> /
    <span class="font-semibold">Latihan</span>
  </nav>

  {{-- Tata Letak Divine Proportion (Golden Ratio: ~62% Kuis / ~38% Panduan & Status) --}}
  <div class="golden-layout items-start gap-8">
    {{-- Kolom Utama: Kuis Latihan (61.8%) --}}
    <main class="space-y-6">
      {{-- 1. Petunjuk Pengerjaan --}}
      <section id="ex-intro" class="glass f-focal-point p-6 sm:p-8" aria-labelledby="ex-title">
        <p class="eyebrow">Kuis Interaktif · 10 Soal</p>
        <h1 id="ex-title" tabindex="-1" class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl">Latihan {{ $course['title'] }}</h1>
        <p class="muted prose-optimal mt-3 text-sm leading-relaxed sm:text-base">
          Uji pemahaman Anda mengenai prinsip tata letak web, Divine Proportion (Golden Ratio), Rule of Thirds, dan keterbacaan optimal.
        </p>

        <h2 class="mt-6 text-base font-semibold">Petunjuk Pengerjaan</h2>
        <ol class="prose-optimal mt-3 list-decimal space-y-2 pl-5 text-sm leading-relaxed">
          <li>Latihan terdiri dari <strong>10 soal</strong>: 5 soal <strong>mudah</strong> terlebih dahulu, lalu 5 soal <strong>sedang</strong>.</li>
          <li>Setiap soal punya empat pilihan dan hanya satu yang paling tepat.</li>
          <li>Setelah memilih, jawaban langsung dinilai dan dijelaskan. Pilihan tidak bisa diubah.</li>
          <li>Di akhir Anda akan melihat skor dan pembahasan semua soal. Latihan boleh diulang kapan saja.</li>
          <li>Bingung? Baca ulang <a class="underline underline-offset-2" href="{{ route('lesson', $slug) }}">materi {{ $course['title'] }}</a>@if ($canAsk) atau tanyakan ke AI lewat tombol Tanya AI.@else.@endif</li>
          @if ($canAsk && ! $isPro)
            <li>Paket Free bisa bertanya ke AI hingga <strong>{{ $limitMax }} pesan</strong>. Setelah itu AI <strong>dijeda {{ $cooldown }} menit</strong>, dan Anda bisa melihat kapan AI aktif lagi. <a class="underline underline-offset-2" href="{{ route('subscription') }}">Paket Pro</a> tanpa batas dan tanpa jeda.</li>
          @endif
        </ol>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
          <button id="ex-start" type="button" data-ripple class="btn-primary">Mulai Latihan Sekarang <span aria-hidden="true">→</span></button>
          <a href="{{ route('lesson', $slug) }}" class="btn-secondary">Kembali ke Materi</a>
        </div>
      </section>

      {{-- 2. Tampilan Soal Kuis --}}
      <section id="ex-quiz" class="glass hidden p-6 sm:p-8" aria-label="Soal latihan">
        <div class="flex items-center justify-between gap-3">
          <p id="ex-count" class="font-mono text-sm font-semibold" aria-live="polite"></p>
          <span id="ex-level" class="badge level-badge"></span>
        </div>
        
        <div class="mt-4 h-2.5 overflow-hidden rounded-full bg-[#363B6C]/10 dark:bg-[#EAEDFE]/10" role="progressbar" aria-label="Kemajuan latihan" aria-valuemin="0" aria-valuemax="{{ count($course['questions']) }}" aria-valuenow="0">
          <div id="ex-bar" class="h-full w-0 rounded-full bg-[#363B6C] transition-all duration-500 dark:bg-[#C6C9E7]"></div>
        </div>

        <h2 id="ex-text" tabindex="-1" class="prose-optimal mt-6 text-xl font-semibold leading-snug tracking-tight sm:text-2xl"></h2>
        
        <div id="ex-options" class="mt-6 space-y-3" role="group" aria-label="Pilihan jawaban"></div>
        
        <div id="ex-feedback" class="glass-recessed prose-optimal hidden mt-6 p-4 text-sm leading-relaxed" role="status"></div>
        
        <div class="mt-6 flex justify-end">
          <button id="ex-next" type="button" class="btn-primary hidden"></button>
        </div>
      </section>

      {{-- 3. Hasil Kuis --}}
      <section id="ex-result" class="glass hidden p-6 sm:p-8" aria-labelledby="ex-result-title">
        <p class="eyebrow">Evaluasi Skor</p>
        <h2 id="ex-result-title" tabindex="-1" class="mt-2 text-3xl font-bold tracking-tight">Skor Anda: <span id="ex-score"></span> <span class="muted text-xl font-medium">(<span id="ex-pct"></span>)</span></h2>
        <p id="ex-msg" class="prose-optimal mt-3 text-base leading-relaxed"></p>
        
        <div class="mt-6 border-t border-[#363B6C]/10 pt-6 dark:border-[#EAEDFE]/10">
          <p class="eyebrow">Pembahasan Jawaban</p>
          <ul id="ex-review" class="mt-4 space-y-3"></ul>
        </div>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
          <button id="ex-retry" type="button" class="btn-primary">Ulangi Latihan</button>
          <a href="{{ route('lesson', $slug) }}" class="btn-secondary">Baca Ulang Materi</a>
          <a href="{{ route('courses') }}" class="btn-secondary">Kembali ke Kursus</a>
        </div>
      </section>
    </main>

    {{-- Kolom Samping (38.2%): Aturan Desain & Bantuan AI --}}
    <aside class="space-y-6 lg:sticky lg:top-24">
      {{-- Card Prinsip Desain Terkait --}}
      <div class="glass p-5">
        <div class="flex items-center justify-between border-b border-[#363B6C]/10 pb-3 dark:border-[#EAEDFE]/10">
          <p class="eyebrow">Catatan Prinsip</p>
          <span class="badge badge-pro">Tata Letak</span>
        </div>
        <ul class="mt-4 space-y-3 text-xs leading-relaxed">
          <li class="flex items-start gap-2">
            <span class="accent font-bold">•</span>
            <span><strong>Golden Ratio (1 : 1,618):</strong> Menentukan proporsi alami antara blok utama dan sidebar.</span>
          </li>
          <li class="flex items-start gap-2">
            <span class="accent font-bold">•</span>
            <span><strong>Rule of Thirds:</strong> Membagi 9 kotak (3x3), titik sudut kiri atas adalah area terkuat (pola F).</span>
          </li>
          <li class="flex items-start gap-2">
            <span class="accent font-bold">•</span>
            <span><strong>Keterbacaan Optimal:</strong> Batasi panjang baris antara 60 hingga 80 karakter.</span>
          </li>
        </ul>
        <div class="mt-4 border-t border-[#363B6C]/10 pt-3 text-[11px] dark:border-[#EAEDFE]/10">
          <a href="{{ route('lesson', $slug) }}" class="accent underline underline-offset-2">Buka materi lengkap →</a>
        </div>
      </div>

      {{-- Bantuan AI Info Box --}}
      <div class="glass-recessed p-5">
        <p class="eyebrow">Bantuan AI</p>
        @if ($isPro)
          <p class="muted mt-2 text-xs leading-relaxed">Paket Pro Anda aktif: tanya AI sebanyak yang Anda perlu, tanpa jeda, lewat tombol di sudut kanan bawah.</p>
        @elseif ($canAsk)
          <p class="muted mt-2 text-xs leading-relaxed">Paket Free: {{ $limitMax }} pesan, lalu dijeda {{ $cooldown }} menit.</p>
          <p id="ai-side-status" class="mt-2 font-mono text-xs font-semibold" aria-live="off">Sisa {{ $limitMax }} dari {{ $limitMax }} pesan</p>
          <a href="{{ route('subscription') }}" class="btn-secondary mt-3 inline-block !py-1.5 text-xs">Hilangkan batas dengan Pro</a>
        @else
          <p class="muted mt-2 text-xs leading-relaxed">Masuk untuk bertanya ke AI saat latihan. Paket Free dapat {{ $limitMax }} pesan per {{ $cooldown }} menit.</p>
          <a href="{{ route('login') }}" class="btn-secondary mt-3 inline-block !py-1.5 text-xs">Masuk</a>
        @endif
      </div>
    </aside>
  </div>
</div>

<script type="application/json" id="exercise-data">@json($payload)</script>

{{-- Tombol Bantuan AI mengambang --}}
<button id="ai-open" type="button" aria-expanded="false" aria-controls="ai-panel" class="btn-primary fixed bottom-5 right-5 z-30 !px-5 shadow-lg">
  <span aria-hidden="true">✦</span> Tanya AI
  @if ($canAsk && ! $isPro)<span id="ai-open-badge" class="badge">{{ $limitMax }}/{{ $limitMax }}</span>@endif
</button>

{{-- Panel Samping AI --}}
<aside id="ai-panel" aria-label="Bantuan AI" aria-hidden="true" class="fixed inset-y-0 right-0 z-50 flex w-full max-w-md translate-x-full flex-col border-l border-[#363B6C]/15 bg-[#EAEDFE] text-[#363B6C] shadow-2xl transition-transform duration-300 dark:border-[#EAEDFE]/15 dark:bg-[#363B6C] dark:text-[#EAEDFE]">
  <div class="flex items-center justify-between border-b border-[#363B6C]/10 px-4 py-3 dark:border-[#EAEDFE]/10">
    <div>
      <h2 class="text-sm font-semibold">Bantuan AI</h2>
      <p id="ai-status" class="muted font-mono text-[11px] uppercase tracking-wider">{{ $isPro ? 'Pro · tanpa batas pesan' : ($canAsk ? 'Free · sisa '.$limitMax.' dari '.$limitMax.' pesan' : 'Masuk untuk memakai AI') }}</p>
    </div>
    <button id="ai-close" type="button" class="btn-ghost" aria-label="Tutup panel AI">Tutup</button>
  </div>

  @if ($canAsk)
    <form id="ai-form" action="{{ route('chat.send') }}" method="POST" class="contents">
      <div id="ai-log" class="flex-1 space-y-4 overflow-y-auto px-4 py-4" aria-live="polite" aria-label="Percakapan"></div>

      @unless ($isPro)
        {{-- Info kuota + penghitung mundur jeda (muncul saat kuota habis) --}}
        <div class="space-y-3 border-t border-[#363B6C]/10 px-4 pt-3 dark:border-[#EAEDFE]/10">
          <div class="flex items-center justify-between gap-3">
            <div id="ai-dots" class="flex items-center gap-1.5" role="img" aria-label="Indikator sisa pesan"></div>
            <span class="muted font-mono text-[11px]">{{ $limitMax }} pesan / jeda {{ $cooldown }} menit</span>
          </div>
          <div id="ai-lock" class="glass-recessed hidden p-4" role="timer" aria-label="Penghitung jeda AI">
            <p class="eyebrow">Kuota habis</p>
            <p id="ai-countdown" class="mt-1 font-mono text-3xl font-semibold tabular-nums" aria-live="off">{{ sprintf('%02d:00', $cooldown) }}</p>
            <p class="muted mt-1 text-xs leading-relaxed">AI bisa dipakai lagi pukul <strong id="ai-ready-at">--:--</strong>. Sambil menunggu, baca ulang materi atau lanjutkan soal.</p>
            <div class="mt-3 h-2 overflow-hidden rounded-full bg-[#363B6C]/10 dark:bg-[#EAEDFE]/10" aria-hidden="true">
              <div id="ai-lock-bar" class="h-full w-0 rounded-full bg-[#363B6C] transition-all duration-1000 ease-linear dark:bg-[#C6C9E7]"></div>
            </div>
            <div class="mt-3 flex flex-wrap gap-2">
              <a href="{{ route('lesson', $slug) }}" class="btn-secondary !py-1.5 text-xs">Baca materi</a>
              <a href="{{ route('subscription') }}" class="btn-primary !py-1.5 text-xs">Lewati jeda dengan Pro</a>
            </div>
          </div>
        </div>
      @endunless
      <div class="border-t border-[#363B6C]/10 p-3 dark:border-[#EAEDFE]/10">
        <div id="ai-chips" class="mb-3 flex flex-wrap gap-2" role="group" aria-label="Pertanyaan cepat">
          <button type="button" class="chip" data-q="Jelaskan konsep di balik soal ini dengan singkat.">Jelaskan konsepnya</button>
          <button type="button" class="chip" data-q="Beri saya petunjuk untuk soal ini tanpa menyebut jawabannya.">Beri petunjuk</button>
        </div>
        <div class="glass-recessed flex items-end gap-2 p-2">
          <textarea id="ai-input" rows="1" maxlength="2000" aria-label="Pertanyaan Anda" placeholder="Tanyakan soal ini…" class="max-h-40 min-h-[2.5rem] flex-1 resize-none bg-transparent px-3 py-2 text-sm outline-none placeholder:text-[#363B6C]/60 dark:placeholder:text-[#EAEDFE]/55"></textarea>
          <button id="ai-send" type="submit" class="btn-primary !px-4 !py-2.5">Kirim</button>
        </div>
      </div>
    </form>
  @else
    <div class="flex flex-1 flex-col items-start justify-center gap-4 p-6">
      <span class="badge">Free · {{ $limitMax }} pesan</span>
      <h3 class="text-xl font-semibold tracking-tight">Bantuan AI saat latihan</h3>
      <p class="muted prose-optimal text-sm leading-relaxed">Masuk dengan akun gratis untuk bertanya ke AI saat mengerjakan soal: {{ $limitMax }} pesan, lalu jeda {{ $cooldown }} menit. AI memberi petunjuk, bukan langsung jawaban.</p>
      <a href="{{ route('login') }}" class="btn-primary">Masuk</a>
      <p class="muted text-xs">Belum punya akun? <a class="underline underline-offset-2" href="{{ route('register') }}">Daftar gratis</a>. Paket <a class="underline underline-offset-2" href="{{ route('subscription') }}">Pro</a> tanpa batas.</p>
    </div>
  @endif
</aside>
@endsection
