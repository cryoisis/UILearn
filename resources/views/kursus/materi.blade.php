@extends('layouts.app')

@section('title', $course['title'].' — Kursus UIlearn')

@section('content')
<div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 sm:py-14">
  {{-- Navigasi Breadcrumb --}}
  <nav aria-label="Breadcrumb" class="muted mb-6 font-mono text-xs">
    <a href="{{ route('courses') }}" class="underline underline-offset-2">Kursus</a> / <span class="font-semibold">{{ $course['title'] }}</span>
  </nav>

  {{-- Tata Letak Divine Proportion (Golden Ratio: ~62% Konten Utama / ~38% Sidebar Pelengkap) --}}
  <div class="golden-layout items-start gap-8">
    {{-- ========================================================
         KONTEN UTAMA (61.8% / Divine Proportion Main Block)
         ======================================================== --}}
    <main class="space-y-8">
      {{-- Header Materi --}}
      <header class="glass p-6 sm:p-8">
        <h1 class="text-3xl font-bold tracking-tight sm:text-4xl lg:text-5xl">{{ $course['title'] }}</h1>
        {{-- Keterbacaan Optimal 60 - 80 Karakter per Baris --}}
        <p class="muted prose-optimal mt-4 text-base leading-relaxed sm:text-lg">{{ $course['intro'] }}</p>
        
        <div class="mt-6 grid grid-cols-1 gap-3 sm:grid-cols-2">
          <div class="glass-recessed p-4">
            <p class="eyebrow">Sebelum</p>
            <p class="prose-optimal mt-1 text-sm">{{ $course['before'] }}</p>
          </div>
          <div class="glass-recessed p-4">
            <p class="eyebrow">Sesudah</p>
            <p class="prose-optimal mt-1 text-sm">{{ $course['after'] }}</p>
          </div>
        </div>
      </header>

      {{-- Bagian-Bagian Materi --}}
      @foreach ($course['sections'] as $i => $s)
        <section id="bagian-{{ $i + 1 }}" aria-labelledby="h-{{ $i + 1 }}" class="glass scroll-mt-24 p-6 sm:p-8">
          <h2 id="h-{{ $i + 1 }}" class="text-2xl font-semibold tracking-tight">{{ $s['title'] }}</h2>
          <div class="prose-optimal mt-4 space-y-3 text-base leading-relaxed">
            @foreach ($s['body'] as $para)
              <p>{{ $para }}</p>
            @endforeach
          </div>
          @if (!empty($s['tip']))
            <aside class="glass-recessed mt-6 border-l-4 border-l-[#C6C9E7] p-4 text-sm leading-relaxed">
              <strong>Tips:</strong> {{ $s['tip'] }}
            </aside>
          @endif
        </section>
      @endforeach

      {{-- FAQ --}}
      <section id="faq" aria-labelledby="faq-title" class="glass scroll-mt-24 p-6 sm:p-8">
        <h2 id="faq-title" class="text-2xl font-semibold tracking-tight">Tanya Jawab (FAQ)</h2>
        <div class="mt-4 divide-y divide-[#363B6C]/10 dark:divide-[#EAEDFE]/10">
          @foreach ($course['faq'] as $f)
            <details class="group py-3.5">
              <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-base font-medium focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#C6C9E7]">
                <span>{{ $f['q'] }}</span>
                <span aria-hidden="true" class="accent font-mono transition group-open:rotate-45">+</span>
              </summary>
              <p class="muted prose-optimal mt-2 text-sm leading-relaxed sm:text-base">{{ $f['a'] }}</p>
            </details>
          @endforeach
        </div>
      </section>

      {{-- Navigasi Bawah --}}
      <div class="flex flex-col gap-3 pt-4 sm:flex-row sm:justify-between">
        <a href="{{ route('courses') }}" class="btn-secondary">
          <span aria-hidden="true">←</span> Kembali ke Kursus
        </a>
        <a href="{{ route('exercise', $slug) }}" data-ripple class="btn-primary">
          @guest Masuk untuk Latihan @else Lanjut ke Latihan (10 Soal) @endguest <span aria-hidden="true">→</span>
        </a>
      </div>
    </main>

    {{-- ========================================================
         SIDEBAR STICKY (38.2% / Divine Proportion Secondary Block)
         ======================================================== --}}
    <aside class="space-y-6 lg:sticky lg:top-24">
      {{-- Daftar Isi Materi --}}
      <nav aria-label="Daftar isi" class="glass p-5">
        <p class="eyebrow">Daftar Isi</p>
        <ol class="mt-3 space-y-2 text-sm">
          @foreach ($course['sections'] as $i => $s)
            <li>
              <a class="block truncate rounded px-2 py-1 transition hover:bg-[#363B6C]/5 hover:text-[#363B6C]/60 dark:hover:text-[#C6C9E7] dark:hover:bg-[#EAEDFE]/10" href="#bagian-{{ $i + 1 }}">
                {{ $s['title'] }}
              </a>
            </li>
          @endforeach
          <li>
            <a class="block rounded px-2 py-1 transition hover:bg-[#363B6C]/5 hover:text-[#363B6C]/60 dark:hover:text-[#C6C9E7] dark:hover:bg-[#EAEDFE]/10" href="#faq">
              Tanya Jawab (FAQ)
            </a>
          </li>
        </ol>
      </nav>

      {{-- Kalkulator Cepat Golden Ratio (1:1.62) --}}
      <div class="glass p-5">
        <div class="flex items-center justify-between border-b border-[#363B6C]/10 pb-2 dark:border-[#EAEDFE]/10">
          <p class="eyebrow">Kalkulator Golden Ratio</p>
          <span class="badge badge-pro">1 : 1,62</span>
        </div>
        <p class="muted mt-2 text-xs leading-relaxed">
          Hitung proporsi kolom utama dan sidebar secara otomatis berdasarkan Divine Proportion.
        </p>

        <div class="mt-3 space-y-2">
          <label for="calc-total" class="block font-mono text-[11px]">Total Lebar (px):</label>
          <input id="calc-total" type="number" value="960" min="320" max="2560" step="10"
            class="glass-recessed w-full px-3 py-1.5 font-mono text-sm outline-none focus-visible:ring-2 focus-visible:ring-[#C6C9E7]">
          
          <div class="grid grid-cols-2 gap-2 pt-1 font-mono text-xs">
            <div class="rounded bg-[#363B6C] p-2 text-[#EAEDFE] dark:bg-[#C6C9E7] dark:text-[#363B6C]">
              <div class="text-[10px] opacity-75">Konten Utama (/ 1.62):</div>
              <div id="calc-main" class="text-base font-bold">593px</div>
            </div>
            <div class="rounded border border-[#363B6C]/20 p-2 dark:border-[#EAEDFE]/20">
              <div class="text-[10px] opacity-75">Sidebar:</div>
              <div id="calc-side" class="text-base font-bold">367px</div>
            </div>
          </div>
        </div>

        <script>
          document.addEventListener('DOMContentLoaded', function() {
            var input = document.getElementById('calc-total');
            var mainEl = document.getElementById('calc-main');
            var sideEl = document.getElementById('calc-side');
            if (input && mainEl && sideEl) {
              function update() {
                var total = parseFloat(input.value) || 960;
                var main = Math.round(total / 1.62);
                var side = total - main;
                mainEl.textContent = main + 'px';
                sideEl.textContent = side + 'px';
              }
              input.addEventListener('input', update);
            }
          });
        </script>

        <div class="mt-4 border-t border-[#363B6C]/10 pt-3 text-[11px] dark:border-[#EAEDFE]/10">
          <div class="muted">Alat bantu online:</div>
          <div class="mt-1 flex flex-col gap-1 font-mono">
            <a href="https://www.thismanslife.co.uk/phiculator" target="_blank" rel="noopener noreferrer" class="underline hover:text-[#363B6C]/60 dark:hover:text-[#C6C9E7]">Phiculator Calculator ↗</a>
            <a href="https://www.atrise.com/golden-section/" target="_blank" rel="noopener noreferrer" class="underline hover:text-[#363B6C]/60 dark:hover:text-[#C6C9E7]">Golden Section Ratio Tool ↗</a>
          </div>
        </div>
      </div>

    </aside>
  </div>
</div>
@endsection
