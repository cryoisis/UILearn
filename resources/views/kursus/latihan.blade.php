@extends('layouts.app')

@section('title', 'Latihan '.$course['title'].' — UIlearn')

@section('content')
@php
  $payload = [
    'slug' => $slug,
    'title' => $course['title'],
    'questions' => $course['questions'],
    'aiAllowed' => $aiAllowed,
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
          <li>Bingung? Baca ulang <a class="underline underline-offset-2" href="{{ route('lesson', $slug) }}">materi {{ $course['title'] }}</a>@if ($aiAllowed) atau tanyakan ke AI lewat tombol Bantuan AI.@else.@endif</li>
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
          <div id="ex-bar" class="h-full w-0 rounded-full bg-[#363B6C] transition-all duration-500 dark:bg-[#A8A3E3]"></div>
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
        <p class="muted mt-2 text-xs leading-relaxed">
          @if ($aiAllowed)
            Paket Pro Anda aktif. Anda bisa bertanya tentang konsep soal ke AI melalui tombol di sudut kanan bawah.
          @else
            Butuh petunjuk tanpa membocorkan jawaban? AI pendamping siap membantu di paket Pro.
          @endif
        </p>
        @unless ($aiAllowed)
          <a href="{{ route('subscription') }}" class="btn-secondary mt-3 inline-block !py-1.5 text-xs">Lihat Paket Pro</a>
        @endunless
      </div>
    </aside>
  </div>
</div>

<script type="application/json" id="exercise-data">@json($payload)</script>

{{-- Tombol Bantuan AI mengambang --}}
<button id="ai-open" type="button" aria-expanded="false" aria-controls="ai-panel" class="btn-primary fixed bottom-5 right-5 z-30 !rounded-full !px-5 shadow-lg">
  <span aria-hidden="true">✦</span> Tanya AI
  @unless ($aiAllowed)<span class="badge">Pro</span>@endunless
</button>

{{-- Panel Samping AI --}}
<aside id="ai-panel" aria-label="Bantuan AI" aria-hidden="true" class="fixed inset-y-0 right-0 z-50 flex w-full max-w-md translate-x-full flex-col border-l border-[#363B6C]/15 bg-[#EAEDFE] text-[#363B6C] shadow-2xl transition-transform duration-300 dark:border-[#EAEDFE]/15 dark:bg-[#2c3059] dark:text-[#EAEDFE]">
  <div class="flex items-center justify-between border-b border-[#363B6C]/10 px-4 py-3 dark:border-[#EAEDFE]/10">
    <div>
      <h2 class="text-sm font-semibold">Bantuan AI</h2>
      <p id="ai-status" class="muted font-mono text-[11px] uppercase tracking-wider">{{ $aiAllowed ? 'Pro · tanpa batas pesan' : 'Khusus paket Pro' }}</p>
    </div>
    <button id="ai-close" type="button" class="btn-ghost" aria-label="Tutup panel AI">Tutup</button>
  </div>

  @if ($aiAllowed)
    <form id="ai-form" action="{{ route('chat.send') }}" method="POST" class="contents">
      <div id="ai-log" class="flex-1 space-y-4 overflow-y-auto px-4 py-4" aria-live="polite" aria-label="Percakapan"></div>
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
      <span class="badge badge-pro">Pro</span>
      <h3 class="text-xl font-semibold tracking-tight">Bantuan AI saat latihan</h3>
      <p class="muted prose-optimal text-sm leading-relaxed">Dengan paket Pro Anda bisa bertanya kepada AI langsung saat mengerjakan soal. AI memberi petunjuk dan penjelasan konsep, tanpa langsung membocorkan jawaban.</p>
      <a href="{{ route('subscription') }}" class="btn-primary">Lihat paket Pro</a>
      <p class="muted text-xs">Paket Free tetap bisa memakai <a class="underline underline-offset-2" href="{{ route('chat') }}">halaman AI Chat</a> dengan batas pesan harian.</p>
    </div>
  @endif
</aside>
@endsection
