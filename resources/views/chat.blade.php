@extends('layouts.app')

@section('title', 'AI Chat — UIlearn')

@section('content')
<section class="mx-auto max-w-6xl px-4 py-8 sm:px-6">
  {{-- Header Halaman dengan Fokus Sudut Kiri Atas (F-Pattern) --}}
  <div class="f-focal-point mb-6 pl-3 sm:pl-4">
    <p class="eyebrow">Asisten Desain Antarmuka</p>
    <h1 class="mt-1 text-2xl font-bold tracking-tight sm:text-3xl">AI Chat UIlearn</h1>
    <p class="muted prose-optimal mt-1 text-xs leading-relaxed sm:text-sm">
      Konsultasikan tata letak, kalkulasi Golden Ratio (1:1,618), penataan Rule of Thirds, dan palet warna dengan AI pendamping.
    </p>
  </div>

  {{-- Tata Letak Divine Proportion: Area Percakapan (61.8%) & Panel Saran (38.2%) --}}
  <div class="golden-layout items-start gap-6">
    {{-- Kolom Percakapan Utama (61.8%) --}}
    <div class="glass flex h-[calc(100svh-12rem)] min-h-[500px] flex-col overflow-hidden">
      <div class="flex items-center justify-between gap-3 border-b border-[#363B6C]/10 px-4 py-3 dark:border-[#EAEDFE]/10 sm:px-5">
        <div class="min-w-0">
          <p id="chat-status" class="truncate font-mono text-[11px] font-semibold uppercase tracking-wider text-[#363B6C] dark:text-[#C6C9E7]">
            @if (auth()->user()->isPro()) Pro · tanpa batas pesan @else Free · sisa {{ $remaining }} pesan hari ini @endif
          </p>
        </div>
        <div class="flex items-center gap-2">
          @unless (auth()->user()->isPro())
            <a href="{{ route('subscription') }}" class="btn-ghost shrink-0 text-xs">Upgrade ke Pro</a>
          @endunless
          <button id="chat-clear" type="button" data-url="{{ route('chat.clear') }}" class="btn-ghost shrink-0 text-xs">Hapus chat</button>
        </div>
      </div>

      {{-- Pesan Percakapan dengan Keterbacaan Optimal (60-80 Karakter per baris) --}}
      <div id="chat-log" class="flex-1 space-y-5 overflow-y-auto px-4 py-5 sm:px-6" aria-live="polite" aria-label="Percakapan"></div>

      <div class="border-t border-[#363B6C]/10 p-3 dark:border-[#EAEDFE]/10 sm:p-4">
        <div id="chat-chips" class="mb-3 flex gap-2 overflow-x-auto pb-1" role="group" aria-label="Pertanyaan saran">
          @foreach ($presets as $q)
            <button type="button" class="chip shrink-0 text-xs" data-q="{{ $q }}">{{ $q }}</button>
          @endforeach
        </div>
        <form id="chat-form" action="{{ route('chat.send') }}" method="POST" class="glass-recessed flex items-end gap-2 p-2">
          <textarea id="chat-input" rows="1" maxlength="2000" aria-label="Pertanyaan Anda" placeholder="Tanyakan soal tata letak, Golden Ratio, Rule of Thirds, warna, atau typography…"
            class="max-h-40 min-h-[2.5rem] flex-1 resize-none bg-transparent px-3 py-2 text-sm outline-none placeholder:text-[#363B6C]/60 dark:placeholder:text-[#EAEDFE]/55"></textarea>
          <button id="chat-send" type="submit" class="btn-primary !px-4 !py-2.5 text-sm disabled:cursor-wait">Kirim</button>
        </form>
      </div>
    </div>

    {{-- Kolom Samping (38.2%): Panduan Topik & Tips Bertanya --}}
    <aside class="space-y-6">
      <div class="glass p-5">
        <p class="eyebrow">Topik Konsultasi</p>
        <div class="mt-3 space-y-3 text-xs leading-relaxed">
          <div class="glass-recessed p-3">
            <p class="font-semibold text-[#363B6C] dark:text-[#C6C9E7]">Tata Letak &amp; Proporsi</p>
            <p class="muted mt-1">
              "Bagaimana cara membagi kolom pada layar 1200px dengan Golden Ratio 1,62?"
            </p>
          </div>
          <div class="glass-recessed p-3">
            <p class="font-semibold text-[#363B6C] dark:text-[#C6C9E7]">Rule of Thirds</p>
            <p class="muted mt-1">
              "Di mana sebaiknya saya meletakkan formulir login dan tombol CTA utama?"
            </p>
          </div>
          <div class="glass-recessed p-3">
            <p class="font-semibold text-[#363B6C] dark:text-[#C6C9E7]">👁️ Keterbacaan Optimal</p>
            <p class="muted mt-1">
              "Berapa ukuran font dan line-height ideal untuk panjang teks 70 karakter?"
            </p>
          </div>
        </div>
      </div>

      <div class="glass-recessed p-4 text-xs leading-relaxed">
        <p class="font-semibold text-[#363B6C] dark:text-[#EAEDFE]">Tips Belajar</p>
        <p class="muted mt-1">
          Jangan ragu menanyakan studi kasus desain Anda sendiri. AI dapat memberikan perbandingan solusi sebelum dan sesudah.
        </p>
      </div>
    </aside>
  </div>
</section>

<script type="application/json" id="chat-history">@json($messages)</script>
@endsection
