@extends('layouts.app')

@section('title', $course['title'].' — Kursus UIlearn')

@section('content')
<div class="mx-auto max-w-4xl space-y-6 px-4 py-10 sm:px-6 sm:py-14">
  <nav aria-label="Breadcrumb" class="muted font-mono text-xs">
    <a href="{{ route('courses') }}" class="underline underline-offset-2">Kursus</a> / <span>{{ $course['title'] }}</span>
  </nav>

  <header class="glass p-6 sm:p-8">
    <p class="eyebrow">Materi · {{ $course['duration'] }}</p>
    <h1 class="mt-2 text-4xl font-bold tracking-tight sm:text-5xl">{{ $course['title'] }}</h1>
    <p class="muted mt-4 text-base leading-relaxed sm:text-lg">{{ $course['intro'] }}</p>
    <div class="mt-5 grid grid-cols-1 gap-3 sm:grid-cols-2">
      <div class="glass-recessed p-4"><p class="eyebrow">Sebelum</p><p class="mt-1 text-sm">{{ $course['before'] }}</p></div>
      <div class="glass-recessed p-4"><p class="eyebrow">Sesudah</p><p class="mt-1 text-sm">{{ $course['after'] }}</p></div>
    </div>
  </header>

  {{-- Daftar isi --}}
  <nav aria-label="Daftar isi" class="glass-recessed p-4">
    <p class="eyebrow">Di materi ini</p>
    <ol class="mt-2 grid grid-cols-1 gap-x-6 gap-y-1 text-sm sm:grid-cols-2">
      @foreach ($course['sections'] as $i => $s)
        <li><a class="underline-offset-2 hover:underline" href="#bagian-{{ $i + 1 }}">{{ $s['title'] }}</a></li>
      @endforeach
      <li><a class="underline-offset-2 hover:underline" href="#faq">FAQ</a></li>
    </ol>
  </nav>

  @foreach ($course['sections'] as $i => $s)
    <section id="bagian-{{ $i + 1 }}" aria-labelledby="h-{{ $i + 1 }}" class="glass p-6 sm:p-8">
      <h2 id="h-{{ $i + 1 }}" class="text-2xl font-semibold tracking-tight">{{ $s['title'] }}</h2>
      <div class="mt-3 space-y-3 text-base leading-relaxed">
        @foreach ($s['body'] as $para)<p>{{ $para }}</p>@endforeach
      </div>
      @if (!empty($s['tip']))
        <aside class="glass-recessed mt-5 border-l-4 border-l-[#A8A3E3] p-4 text-sm">
          <strong>Tips:</strong> {{ $s['tip'] }}
        </aside>
      @endif
    </section>
  @endforeach

  {{-- FAQ --}}
  <section id="faq" aria-labelledby="faq-title" class="glass p-6 sm:p-8">
    <h2 id="faq-title" class="text-2xl font-semibold tracking-tight">FAQ</h2>
    <div class="mt-4 divide-y divide-[#363B6C]/10 dark:divide-[#EAEDFE]/10">
      @foreach ($course['faq'] as $f)
        <details class="group py-3">
          <summary class="flex cursor-pointer list-none items-center justify-between gap-4 text-base font-medium focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#A8A3E3]">
            {{ $f['q'] }}
            <span aria-hidden="true" class="accent font-mono transition group-open:rotate-45">+</span>
          </summary>
          <p class="muted mt-2 text-sm leading-relaxed sm:text-base">{{ $f['a'] }}</p>
        </details>
      @endforeach
    </div>
  </section>

  {{-- Navigasi --}}
  <div class="flex flex-col gap-3 sm:flex-row sm:justify-between">
    <a href="{{ route('courses') }}" class="btn-secondary"><span aria-hidden="true">←</span> Kembali ke daftar kursus</a>
    <a href="{{ route('exercise', $slug) }}" data-ripple class="btn-primary">
      @guest Masuk untuk latihan @else Lanjut ke latihan @endguest <span aria-hidden="true">→</span>
    </a>
  </div>
</div>
@endsection
