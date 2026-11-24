<!doctype html>
<html lang="id" class="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#363B6C">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'UIlearn — Belajar UI/UX untuk Pemula')</title>
  <meta name="description" content="Platform belajar UI/UX untuk pemula: Tata Letak, Warna, dan Typography, lengkap dengan latihan dan AI Chat.">
  <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}?v={{ time() }}">
  <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}?v={{ time() }}">
  <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/logo-icon.png') }}?v={{ time() }}">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}?v={{ time() }}">
  <link rel="shortcut icon" href="{{ asset('favicon.ico') }}?v={{ time() }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600&family=Geist+Mono:wght@400;500;600&display=swap" rel="stylesheet">
  <script>
    try { if (localStorage.getItem('uilearn-theme') === 'light') document.documentElement.classList.remove('dark'); } catch (e) {}
  </script>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-sans text-[#363B6C] antialiased dark:text-[#EAEDFE]">
  <div class="page-bg fixed inset-0 -z-10" aria-hidden="true"></div>
  <canvas id="ascii" class="pointer-events-none fixed inset-0 z-0" aria-hidden="true"></canvas>

  <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-md focus:bg-[#363B6C] focus:px-3 focus:py-2 focus:text-[#EAEDFE]">Lewati ke konten</a>

  @php
    $link = 'transition hover:text-[#363B6C]/60 dark:hover:text-[#C6C9E7]';
    $active = fn ($name) => request()->routeIs($name) ? 'font-semibold underline decoration-[#C6C9E7] decoration-2 underline-offset-8' : '';
    $nav = [
      ['home', 'Dashboard', route('home'), 'home'],
      ['courses', 'Kursus', route('courses'), 'courses|lesson|exercise'],
      ['about', 'About', route('about'), 'about'],
      ['chat', 'AI Chat', route('chat'), 'chat'],
      ['subscription', 'Berlangganan', route('subscription'), 'subscription'],
    ];
  @endphp

  <header class="sticky top-0 z-40 border-b border-[#363B6C]/10 bg-[#EAEDFE]/70 backdrop-blur-lg dark:border-[#EAEDFE]/10 dark:bg-[#363B6C]/70">
    <nav aria-label="Navigasi utama" class="mx-auto flex h-16 max-w-6xl items-center justify-between gap-4 px-4 sm:px-6">
      {{-- Sisi kiri: logo, Sign in / Sign out, toggle tema --}}
      <div class="flex items-center gap-2 sm:gap-3">
        <a href="{{ route('home') }}" class="mr-1 flex items-center gap-2 font-mono text-base font-semibold tracking-tight">
          <img src="{{ asset('images/logo.png') }}" alt="UI" width="22" height="28" loading="eager" class="h-6 w-auto dark:hidden sm:h-7" />
          <img src="{{ asset('images/logo-dark.png') }}" alt="UI" width="22" height="28" loading="eager" class="hidden h-6 w-auto dark:inline-block sm:h-7" />
          <span>Learn</span>
        </a>
        @guest
          <a href="{{ route('login') }}" class="btn-ghost">Sign in</a>
        @else
          <button type="button" class="btn-ghost" data-dialog="logout-dialog">Sign out</button>
        @endguest
      </div>

      {{-- Sisi kanan: tautan halaman --}}
      <div class="flex items-center gap-4">
        <ul class="hidden items-center gap-6 text-sm text-[#363B6C]/85 dark:text-[#EAEDFE]/85 md:flex">
          @foreach ($nav as [$key, $label, $url, $match])
            <li><a class="{{ $link }} {{ request()->routeIs(...explode('|', $match)) ? 'font-semibold underline decoration-[#C6C9E7] decoration-2 underline-offset-8' : '' }}" href="{{ $url }}" @if(request()->routeIs(...explode('|', $match))) aria-current="page" @endif>{{ $label }}</a></li>
          @endforeach
        </ul>
        @auth
          <a href="{{ route('profile') }}" class="hidden max-w-[10rem] items-center gap-2 truncate font-mono text-xs text-[#363B6C]/80 transition hover:text-[#363B6C]/60 dark:hover:text-[#C6C9E7] dark:text-[#EAEDFE]/80 sm:inline-flex" title="Profile">
            {{ auth()->user()->name }}
            <span class="badge {{ auth()->user()->isPro() ? 'badge-pro' : '' }}">{{ auth()->user()->isPro() ? 'Pro' : 'Free' }}</span>
          </a>
        @else
          <a href="{{ route('register') }}" data-ripple class="btn-primary hidden !py-2 sm:inline-flex">Join</a>
        @endauth
        <button id="menu-toggle" type="button" aria-expanded="false" aria-controls="mobile-menu" aria-label="Buka menu" class="flex h-9 w-9 items-center justify-center rounded-md border border-[#363B6C]/15 dark:border-[#EAEDFE]/15 md:hidden">
          <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
        </button>
        <button id="theme-toggle" type="button" aria-label="Ganti ke mode cerah" class="flex h-9 w-9 items-center justify-center rounded-md border border-[#363B6C]/15 transition hover:bg-[#363B6C]/5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#C6C9E7] dark:border-[#EAEDFE]/15 dark:hover:bg-[#EAEDFE]/10">
          <svg class="hidden h-4 w-4 dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
          <svg class="h-4 w-4 dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8Z"/></svg>
        </button>
        <button id="grid-toggle" type="button" title="Tampilkan Panduan Grid (Rule of Thirds & Golden Ratio)" aria-label="Tampilkan panduan visual grid" class="hidden h-9 items-center gap-1.5 rounded-md border border-[#363B6C]/15 px-2.5 font-mono text-xs text-[#363B6C] transition hover:bg-[#363B6C]/5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#C6C9E7] dark:border-[#EAEDFE]/15 dark:text-[#EAEDFE] dark:hover:bg-[#EAEDFE]/10 sm:inline-flex">
          <span class="text-[#363B6C] dark:text-[#C6C9E7]">▦</span> Grid
        </button>

      </div>
    </nav>
    <div id="mobile-menu" class="hidden border-t border-[#363B6C]/10 px-4 pb-4 dark:border-[#EAEDFE]/10 md:hidden">
      <ul class="flex flex-col gap-1 pt-3 text-sm">
        @foreach ($nav as [$key, $label, $url, $match])
          <li><a class="block rounded-md px-3 py-2 hover:bg-[#363B6C]/5 dark:hover:bg-[#EAEDFE]/10" href="{{ $url }}">{{ $label }}</a></li>
        @endforeach
        @auth
          <li><a class="block rounded-md px-3 py-2 hover:bg-[#363B6C]/5 dark:hover:bg-[#EAEDFE]/10" href="{{ route('profile') }}">Profile ({{ auth()->user()->name }})</a></li>
        @else
          <li><a class="block rounded-md px-3 py-2 hover:bg-[#363B6C]/5 dark:hover:bg-[#EAEDFE]/10" href="{{ route('register') }}">Join UIlearn</a></li>
        @endauth
      </ul>
    </div>
  </header>

  @auth
    {{-- Konfirmasi Sign out --}}
    <dialog id="logout-dialog" class="confirm-dialog" aria-labelledby="logout-title">
      <form method="POST" action="{{ route('logout') }}" class="p-6">
        @csrf
        <h2 id="logout-title" class="text-lg font-semibold">Keluar dari akun?</h2>
        <p class="muted mt-2 text-sm">Anda perlu masuk lagi untuk mengerjakan latihan dan memakai AI Chat.</p>
        <div class="mt-6 flex justify-end gap-2">
          <button type="button" class="btn-secondary" data-close>Batal</button>
          <button type="submit" class="btn-primary">Ya, Sign out</button>
        </div>
      </form>
    </dialog>
  @endauth

  @if (session('status') === 'account-deleted')
    <div role="status" class="glass mx-auto mt-4 max-w-6xl px-5 py-3 text-sm">Akun Anda sudah dihapus. Terima kasih sudah belajar bersama UIlearn.</div>
  @endif

  <main id="main" class="relative z-10">
    @yield('content')
  </main>

  <footer class="relative z-10 border-t border-[#363B6C]/10 bg-[#EAEDFE]/60 backdrop-blur-lg dark:border-[#EAEDFE]/10 dark:bg-[#363B6C]/60">
    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6">
      <div class="golden-layout items-start gap-8 border-b border-[#363B6C]/10 pb-8 dark:border-[#EAEDFE]/10">
        {{-- Sisi Utama (~62% / Konten Utama Golden Ratio) --}}
        <div>
          <div class="flex items-center gap-2 font-mono text-base font-semibold tracking-tight">
            <img src="{{ asset('images/logo.png') }}" alt="UI" width="22" height="28" loading="lazy" class="h-6 w-auto dark:hidden" />
            <img src="{{ asset('images/logo-dark.png') }}" alt="UI" width="22" height="28" loading="lazy" class="hidden h-6 w-auto dark:inline-block" />
            <span>Learn</span>
          </div>
          <p class="muted mt-3 max-w-[65ch] text-sm leading-relaxed">
            UIlearn menerapkan prinsip tata letak modern: <strong>Divine Proportion (Golden Ratio 1:1,618)</strong> untuk harmoni spasial, <strong>Rule of Thirds</strong> untuk hierarki titik fokus, dan panjang baris <strong>60–80 karakter</strong> untuk kenyamanan membaca optimal.
          </p>
        </div>
        {{-- Sisi Sidebar (~38% / Pelengkap & Alat Bantu) --}}
        <div class="space-y-3">
          <p class="eyebrow">Alat Bantu Desain Web</p>
          <ul class="space-y-2 text-xs">
            <li>
              <a href="https://www.thismanslife.co.uk/phiculator" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 underline-offset-2 hover:underline">
                <span>Phiculator</span>
                <span class="muted font-mono">(Kalkulator Golden Ratio) ↗</span>
              </a>
            </li>
            <li>
              <a href="https://www.atrise.com/golden-section/" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-1.5 underline-offset-2 hover:underline">
                <span>Golden Section Ratio Tool</span>
                <span class="muted font-mono">(Grid Generator) ↗</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
      <div class="mt-6 flex flex-col gap-2 text-xs text-[#363B6C]/75 dark:text-[#EAEDFE]/70 sm:flex-row sm:items-center sm:justify-between">
        <p>Copyright © {{ date('Y') }} UIlearn. Jelas, intuitif, dan terstruktur proporsional.</p>
        <p class="font-mono text-[11px]">Rasio Golden: 1 : 1,618 · Grid 3×3 Rule of Thirds</p>
      </div>
    </div>
  </footer>

  {{-- Overlay Panduan Visual Grid (Toggle via tombol Grid di header) --}}
  <div id="composition-grid-overlay" class="pointer-events-none fixed inset-0 z-50 hidden opacity-60" aria-hidden="true">
    <div class="mx-auto h-full max-w-6xl border-x border-[#C6C9E7]/30 px-4 sm:px-6">
      <div class="grid h-full grid-cols-3 border-x border-dashed border-[#C6C9E7]/40">
        <div class="relative border-r border-dashed border-[#C6C9E7]/40">
          <div class="absolute left-0 top-[33.33%] -translate-x-1/2 -translate-y-1/2 rounded-full bg-[#C6C9E7] p-1.5 shadow" title="Titik Temu Kiri Atas (F-Pattern Anchor)"></div>
        </div>
        <div class="relative border-r border-dashed border-[#C6C9E7]/40"></div>
        <div class="relative"></div>
      </div>
    </div>
  </div>
</body>
</html>
