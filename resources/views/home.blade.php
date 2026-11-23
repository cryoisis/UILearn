@extends('layouts.app')

@section('title', 'Dashboard — UIlearn')

@section('content')
{{-- 1. Hero --}}
<section aria-labelledby="hero-title" class="mx-auto flex min-h-[calc(100svh-4rem)] max-w-6xl items-center px-4 py-16 sm:px-6">
  <div class="glass w-full overflow-hidden">
    <div class="eyebrow border-b border-[#363B6C]/10 px-5 py-3 dark:border-[#EAEDFE]/10 sm:px-8">
      @auth Halo, {{ auth()->user()->name }} @else Belajar UI/UX untuk pemula @endauth
    </div>
    <div class="px-5 py-12 sm:px-8 sm:py-16 lg:px-12">
      <h1 id="hero-title" class="max-w-4xl tracking-tight">
        <span class="inline-flex items-center gap-3 text-5xl font-bold sm:gap-4 sm:text-6xl lg:text-7xl">
          <img src="{{ asset('images/logo.png') }}" alt="UI" class="h-14 w-auto drop-shadow-sm dark:hidden sm:h-20 lg:h-24" />
          <img src="{{ asset('images/logo-dark.png') }}" alt="UI" class="hidden h-14 w-auto drop-shadow-sm dark:inline-block sm:h-20 lg:h-24" />
          <span>Learn</span>
        </span>
        <span class="accent mt-4 block font-mono text-3xl font-medium tracking-tight sm:text-4xl lg:text-5xl">U Learn, I Learn</span>
      </h1>
      <p class="muted mt-6 max-w-xl text-pretty text-base leading-relaxed sm:text-lg">
        Pelajari dasar UI/UX dari nol lewat tiga topik inti: Tata Letak, Warna, dan Typography. Baca materi singkat, kerjakan latihan, dan tanyakan apa saja kepada AI Chat.
      </p>
      <div class="mt-9 flex flex-col gap-3 sm:flex-row">
        @guest
          <a href="{{ route('register') }}" data-ripple class="btn-primary">Join <span aria-hidden="true">→</span></a>
          <a href="{{ route('courses') }}" class="btn-secondary">Lihat</a>
        @else
          <a href="{{ route('courses') }}" data-ripple class="btn-primary">Lanjut belajar <span aria-hidden="true">→</span></a>
          <a href="{{ route('chat') }}" class="btn-secondary">Buka AI Chat</a>
        @endguest
      </div>
    </div>
  </div>
</section>

{{-- 2. Contoh interaksi AI (preset) --}}
<section id="ai-demo" aria-labelledby="demo-title" class="mx-auto max-w-6xl px-4 py-16 sm:px-6">
  <div class="mb-8 max-w-2xl">
    <p class="eyebrow">Contoh AI Chat</p>
    <h2 id="demo-title" class="mt-2 text-3xl font-semibold tracking-tight sm:text-4xl">Bingung soal desain? Tanya saja.</h2>
    <p class="muted mt-3 text-sm leading-relaxed sm:text-base">Pilih salah satu pertanyaan di bawah untuk melihat bagaimana AI membantu Anda belajar.</p>
  </div>
  <div class="glass p-3 sm:p-5">
    <div class="mb-4 flex flex-wrap items-center gap-2" role="group" aria-label="Pertanyaan contoh">
      <span class="eyebrow mr-1">Coba tanya</span>
      @foreach ($presets as $p)
        <button type="button" class="chip" data-preset="{{ $p['id'] }}" aria-pressed="false">{{ $p['q'] }}</button>
      @endforeach
    </div>
    <div id="ai-demo-log" class="min-h-[18rem] space-y-4 rounded-xl p-1 sm:p-2" aria-live="polite"></div>
    <p class="muted mt-4 border-t border-[#363B6C]/10 pt-3 font-mono text-xs dark:border-[#EAEDFE]/10">
      @guest
        Ini hanya contoh. <a href="{{ route('login') }}" class="font-medium underline underline-offset-2">Sign in</a> untuk bertanya bebas kepada AI.
      @else
        Ingin bertanya hal lain? <a href="{{ route('chat') }}" class="font-medium underline underline-offset-2">Buka AI Chat</a>.
      @endguest
    </p>
  </div>
  <script type="application/json" id="ai-demo-data">@json($presets)</script>
</section>

{{-- 3. Sebelum & sesudah belajar UI/UX --}}
<section aria-labelledby="compare-title" class="mx-auto max-w-6xl px-4 py-16 sm:px-6">
  <div class="mb-8 max-w-2xl">
    <p class="eyebrow">Perbandingan</p>
    <h2 id="compare-title" class="mt-2 text-3xl font-semibold tracking-tight sm:text-4xl">Sebelum dan sesudah belajar UI/UX</h2>
    <p class="muted mt-3 text-sm leading-relaxed sm:text-base">Isi dan fungsinya sama persis. Yang berubah hanya tata letak, warna, dan typography.</p>
  </div>
  <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
    {{-- Sebelum --}}
    <figure class="glass p-5 sm:p-6">
      <figcaption class="mb-4 flex items-center justify-between">
        <span class="badge">Sebelum</span>
        <span class="muted text-xs">Berantakan dan sulit dibaca</span>
      </figcaption>
      <div class="mock-before overflow-hidden rounded-lg p-4" style="background:#ffe14d;color:#ff4fd8" role="img" aria-label="Contoh formulir pendaftaran yang berantakan: warna bertabrakan, banyak font, jarak acak, tombol tidak jelas">
        <div style="font-size:11px">DAFTAR SEKARANG!!!</div>
        <div style="font-size:26px;font-weight:700;font-family:'Times New Roman',serif;color:#00c2ff;margin-top:2px">Buat akun</div>
        <div style="font-size:9px;color:#ffc9f4;margin-top:6px">isi data kamu di bawah ini ya supaya bisa dipakai nanti untuk login</div>
        <div style="margin-top:14px;display:flex;gap:4px"><span style="border:1px solid #f00;background:#0f0;padding:3px 6px;font-size:10px;width:48%">nama</span><span style="border:1px solid #00f;background:#ff0;padding:3px 6px;font-size:10px;width:48%">email</span></div>
        <div style="margin-top:2px;display:flex;gap:4px;align-items:center"><span style="background:#ff7a00;color:#ffe14d;padding:4px 8px;font-size:12px">kirim</span><span style="background:#ff7a00;color:#ffe14d;padding:4px 8px;font-size:12px">batal</span><span style="background:#ff7a00;color:#ffe14d;padding:4px 8px;font-size:12px">reset</span></div>
      </div>
    </figure>
    {{-- Sesudah --}}
    <figure class="glass p-5 sm:p-6">
      <figcaption class="mb-4 flex items-center justify-between">
        <span class="badge badge-pro">Sesudah</span>
        <span class="muted text-xs">Rapi, jelas, nyaman dipakai</span>
      </figcaption>
      <div class="rounded-lg bg-white p-6 text-[#1f2347]" role="img" aria-label="Contoh formulir pendaftaran yang rapi: satu warna aksen, hierarki jelas, jarak konsisten, satu tombol utama">
        <p class="text-xs font-semibold uppercase tracking-wider text-[#5a54a8]">Daftar</p>
        <p class="mt-1 text-2xl font-bold leading-tight">Buat akun Anda</p>
        <p class="mt-2 text-sm leading-6 text-[#4b5078]">Isi data berikut untuk mulai belajar.</p>
        <div class="mt-5 grid grid-cols-2 gap-3">
          <div class="rounded-md border border-[#c9cdf0] px-3 py-2 text-sm text-[#4b5078]">Nama</div>
          <div class="rounded-md border border-[#c9cdf0] px-3 py-2 text-sm text-[#4b5078]">Email</div>
        </div>
        <div class="mt-4 flex items-center gap-3">
          <span class="rounded-md bg-[#363B6C] px-5 py-2 text-sm font-semibold text-white">Daftar</span>
          <span class="text-sm text-[#4b5078] underline underline-offset-2">Batal</span>
        </div>
      </div>
    </figure>
  </div>
  <ul class="mt-4 grid grid-cols-1 gap-3 sm:grid-cols-3">
    @foreach ([['Tata Letak', 'Satu aksi utama, elemen sejajar, jarak berskala.'], ['Warna', 'Satu warna aksen dan teks dengan kontras cukup.'], ['Typography', 'Dua ukuran jelas dan tinggi baris yang lega.']] as [$t, $d])
      <li class="glass-recessed p-4"><p class="text-sm font-semibold">{{ $t }}</p><p class="muted mt-1 text-sm">{{ $d }}</p></li>
    @endforeach
  </ul>
</section>

{{-- 4. Pilihan materi --}}
<section id="materi" aria-labelledby="courses-title" class="mx-auto max-w-6xl px-4 py-16 sm:px-6">
  <div class="mb-8 max-w-2xl">
    <p class="eyebrow">Materi</p>
    <h2 id="courses-title" class="mt-2 text-3xl font-semibold tracking-tight sm:text-4xl">Pilih topik untuk dipelajari</h2>
  </div>
  <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
    @foreach ($courses as $slug => $c)
      <a href="{{ route('lesson', $slug) }}" class="glass group flex flex-col p-5 transition hover:border-[#A8A3E3] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#A8A3E3] sm:p-6">
        <span class="accent font-mono text-3xl" aria-hidden="true">{{ $c['icon'] }}</span>
        <h3 class="mt-4 text-xl font-semibold tracking-tight">{{ $c['title'] }}</h3>
        <p class="muted mt-2 flex-1 text-sm leading-relaxed">{{ $c['tagline'] }}</p>
        <p class="accent mt-4 font-mono text-xs">Mulai belajar <span aria-hidden="true" class="inline-block transition group-hover:translate-x-1">→</span></p>
      </a>
    @endforeach
  </div>
  <div class="mt-8 flex justify-center">
    <a href="{{ route('courses') }}" class="btn-secondary">Lihat lebih <span aria-hidden="true">→</span></a>
  </div>
</section>

{{-- 5. About singkat --}}
<section aria-labelledby="about-short-title" class="mx-auto max-w-6xl px-4 py-16 sm:px-6">
  <div class="glass grid grid-cols-1 gap-6 p-6 sm:p-8 lg:grid-cols-[1.2fr_1fr] lg:items-center">
    <div>
      <p class="eyebrow">Tentang UIlearn</p>
      <h2 id="about-short-title" class="mt-2 text-2xl font-semibold tracking-tight sm:text-3xl">Belajar UI/UX tanpa merasa kewalahan</h2>
      <p class="muted mt-3 text-sm leading-relaxed sm:text-base">UIlearn dibuat untuk pemula. Materinya ringkas, latihannya bertahap dari mudah ke sedang, dan AI siap membantu saat Anda buntu.</p>
    </div>
    <div class="lg:text-right">
      <a href="{{ route('about') }}" class="btn-secondary">Selengkapnya <span aria-hidden="true">→</span></a>
    </div>
  </div>
</section>

{{-- 6. Ajakan menjadi member (hanya untuk yang belum login) --}}
@guest
<section id="join" aria-labelledby="join-title" class="mx-auto max-w-6xl scroll-mt-24 px-4 pb-20 pt-4 sm:px-6">
  <article class="glass overflow-hidden">
    <div class="grid grid-cols-1 lg:grid-cols-[1fr_1.2fr]">
      <div class="border-b border-[#363B6C]/10 p-6 dark:border-[#EAEDFE]/10 md:p-8 lg:border-b-0 lg:border-r">
        <p class="eyebrow">Kenapa jadi member?</p>
        <h2 id="join-title" class="mt-3 text-balance text-2xl font-semibold leading-snug tracking-tight sm:text-3xl">Buka kursus lengkap dan AI Chat.</h2>
        <p class="muted mt-3 max-w-md text-sm leading-relaxed">Tanpa login Anda bisa membaca materi. Dengan akun gratis Anda bisa mengerjakan latihan dan mencoba AI Chat. Paket Pro membuka AI tanpa batas, termasuk bantuan saat mengerjakan soal.</p>
        <div class="mt-6 flex flex-col gap-3 sm:flex-row">
          <a href="{{ route('register') }}" class="btn-primary">Daftar gratis</a>
          <a href="{{ route('login') }}" class="btn-ghost inline-flex items-center justify-center px-6 py-3 text-sm">Saya sudah punya akun</a>
        </div>
      </div>
      <div class="overflow-x-auto">
        <table class="w-full min-w-[420px] border-collapse text-left text-sm">
          <caption class="sr-only">Perbandingan akses tamu, Free, dan Pro</caption>
          <thead>
            <tr class="border-b border-[#363B6C]/10 font-mono text-[11px] uppercase tracking-wider dark:border-[#EAEDFE]/10">
              <th scope="col" class="px-4 py-3"><span class="sr-only">Fitur</span></th>
              <th scope="col" class="px-4 py-3 font-medium">Tamu</th>
              <th scope="col" class="px-4 py-3 font-medium">Free</th>
              <th scope="col" class="bg-[#A8A3E3]/20 px-4 py-3 font-medium">Pro</th>
            </tr>
          </thead>
          <tbody class="[&_tr]:border-b [&_tr]:border-[#363B6C]/10 dark:[&_tr]:border-[#EAEDFE]/10 [&_tr:last-child]:border-b-0">
            <tr><th scope="row" class="px-4 py-3 font-semibold">Materi</th><td class="px-4 py-3">Baca</td><td class="px-4 py-3">Baca</td><td class="bg-[#A8A3E3]/20 px-4 py-3">Baca</td></tr>
            <tr><th scope="row" class="px-4 py-3 font-semibold">Latihan</th><td class="px-4 py-3">Perlu login</td><td class="px-4 py-3">10 soal / topik</td><td class="bg-[#A8A3E3]/20 px-4 py-3">10 soal / topik</td></tr>
            <tr><th scope="row" class="px-4 py-3 font-semibold">AI Chat</th><td class="px-4 py-3">Contoh saja</td><td class="px-4 py-3">{{ config('uilearn.plans.free.daily_ai_messages') }} pesan / hari</td><td class="bg-[#A8A3E3]/20 px-4 py-3">Tanpa batas</td></tr>
            <tr><th scope="row" class="px-4 py-3 font-semibold">AI saat latihan</th><td class="px-4 py-3">–</td><td class="px-4 py-3">–</td><td class="bg-[#A8A3E3]/20 px-4 py-3">Ya</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </article>
</section>
@endguest
@endsection
