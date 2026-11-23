<!doctype html>
<html lang="id" class="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="theme-color" content="#363B6C">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'UIlearn — Belajar UI/UX untuk Pemula')</title>
  <meta name="description" content="Platform belajar UI/UX untuk pemula: Tata Letak, Warna, dan Typography, lengkap dengan latihan dan AI Chat.">
  <link rel="icon" type="image/png" href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABzenr0AAAEJklEQVR4nMVX3UtjRxSfmTu5SVON+TBhW+tCWhpINIU+RHyoJaSI4L9wffHVB+t2ofZF9M0HEdmXCL4usm+CoLAv2u7FQpUuYWPdStLeUhJYVsV8bNT05n6UczcjMc1NbNTdA5eZO3funN/5zTln5mDUQFJSXkd3IIFPnbh+DDdS/Lm/6y70o/RfBVMgCJS/K/kPw6kGyguFQnFtbe0X6Guapqmqqt4FCGJG19LS0vN4PG6BPgAghJjOZcIWL5VKZ1NTU88mJyfFXC6Xb/pTyoT6oaGhFyMjI79CP5vNvpqfn/+RsWFmlaIoCrSbm5t7gAee1dXVn5uxQMyAcRwHugxnsVgsdGZm5qu9vb0DjDGGD43+gW/QBgIBX19f3x/BYFAKh8PeZgTQFpQiBgB2IZVK5QcGBky3BACAZT09PT5BEHbhf7/fH2kbAJMqY8xAUwFHpZTShYWF3dnZ2SiMZbNZMR6Pf30jAExaIqjK0dER4ThOrfb5ZnMpugOhlOqqqnKs32wuuc6CwP+VAeaEus5aveowRltLlKqq+NYZoDz/llaM3xpQ1UgpNfJGPd62GMCNtru68sXjxz9pDx6ktKdPRWP49eusNvXtfvmH7/dRpXJm5fnLQwYCoy0A9SCqUWAM6E+eBEh/f0ArFD4y3g8O/ibSn2Fb7JswurjI8FarzvO8QilVWm0BQf9PDGuoIKTQy5cp4nC8MoCGQvc1/2f78vZWEtlsn1goRbIsU0VRqMfjqdxGHkCGIkIMa3hBiCJBAPQBY/zevV786FEvi7fvHj6MOLq6nlUqFTQ+Ph6+MYB6UcA8cESIAnDES4QY0KJcLlcQBKG/YQTdZAswcwqWhmuioKoFq5qmxWKxis/n88CzuLj4260BuI6Uy+VyqVT6gL07nc72GaCUanDEXkcxo/r4+Dh3enrqJIRoQExHR0dTHaTZcXxycmKHw4UtznGcaUixOZIkHcuyzMNZAKHb2dnZ3EhkIg6HQ97a2vpyYmJCTKfTHQghD6W0KQCQRCJRrHULh8NhaQsAxthIPsvLy5dHaasUC066sbFhXKnZYeT1ei/9oS0ntFqt//A8L9crqn2XISwppaIovhBF8QugH+4s3d3dp6FQqLctALquGzRCNgNrwKnqY5rdlnme5w8PD6WxsTEvsGaxWCrQjo6O/u52u11tAbDb7YYTgTWgHCxyuVy2Kz8TAhcPbn19fTcWi32YyWQ+BtDlctnmdrtzc3Nz91slItOb8c7OTtJut5+x2+3g4OD++fn5uVoj29vbieHh4edsDjwcxynRaDSRTCZTsI5ZPcHqAswANCrHAMTKysobn8+nTE9P93u9Xg+7HEIrSVImnU4fFYvFSj6fV2w2GwkGg65IJBJqVU9AmXalRHtfpRmuRfU+itOGieVdluf/Avxk75BONCeRAAAAAElFTkSuQmCC">
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
  <div class="page-bg fixed inset-0 -z-10" aria-hidden="true">
    <div class="ambient absolute -left-32 top-24 h-96 w-96 rounded-full"></div>
    <div class="ambient absolute -right-24 top-[55%] h-[28rem] w-[28rem] rounded-full"></div>
  </div>
  <canvas id="ascii" class="pointer-events-none fixed inset-0 z-0" aria-hidden="true"></canvas>

  <a href="#main" class="sr-only focus:not-sr-only focus:fixed focus:left-4 focus:top-4 focus:z-50 focus:rounded-md focus:bg-[#363B6C] focus:px-3 focus:py-2 focus:text-[#EAEDFE]">Lewati ke konten</a>

  @php
    $link = 'transition hover:text-[#A8A3E3]';
    $active = fn ($name) => request()->routeIs($name) ? 'font-semibold underline decoration-[#A8A3E3] decoration-2 underline-offset-8' : '';
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
          <img src="{{ asset('images/logo.png') }}" alt="UI" class="h-6 w-auto dark:hidden" />
          <img src="{{ asset('images/logo-dark.png') }}" alt="UI" class="hidden h-6 w-auto dark:inline-block" />
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
            <li><a class="{{ $link }} {{ request()->routeIs(...explode('|', $match)) ? 'font-semibold underline decoration-[#A8A3E3] decoration-2 underline-offset-8' : '' }}" href="{{ $url }}" @if(request()->routeIs(...explode('|', $match))) aria-current="page" @endif>{{ $label }}</a></li>
          @endforeach
        </ul>
        @auth
          <a href="{{ route('profile') }}" class="hidden max-w-[10rem] items-center gap-2 truncate font-mono text-xs text-[#363B6C]/80 transition hover:text-[#A8A3E3] dark:text-[#EAEDFE]/80 sm:inline-flex" title="Profile">
            {{ auth()->user()->name }}
            <span class="badge {{ auth()->user()->isPro() ? 'badge-pro' : '' }}">{{ auth()->user()->isPro() ? 'Pro' : 'Free' }}</span>
          </a>
        @else
          <a href="{{ route('register') }}" data-ripple class="btn-primary hidden !py-2 sm:inline-flex">Join</a>
        @endauth
        <button id="menu-toggle" type="button" aria-expanded="false" aria-controls="mobile-menu" aria-label="Buka menu" class="flex h-9 w-9 items-center justify-center rounded-md border border-[#363B6C]/15 dark:border-[#EAEDFE]/15 md:hidden">
          <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M4 7h16M4 12h16M4 17h16"/></svg>
        </button>
        <button id="theme-toggle" type="button" aria-label="Ganti ke mode cerah" class="flex h-9 w-9 items-center justify-center rounded-md border border-[#363B6C]/15 transition hover:bg-[#363B6C]/5 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#A8A3E3] dark:border-[#EAEDFE]/15 dark:hover:bg-[#EAEDFE]/10">
          <svg class="hidden h-4 w-4 dark:block" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/></svg>
          <svg class="h-4 w-4 dark:hidden" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8Z"/></svg>
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
    <div class="mx-auto flex max-w-6xl flex-col gap-2 px-4 py-8 text-sm text-[#363B6C]/75 dark:text-[#EAEDFE]/70 sm:flex-row sm:items-center sm:justify-between sm:px-6">
      <p>Copyright © {{ date('Y') }} UIlearn. All rights reserved.</p>
    </div>
  </footer>
</body>
</html>
