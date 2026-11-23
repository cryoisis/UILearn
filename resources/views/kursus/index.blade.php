@extends('layouts.app')

@section('title', 'Kursus — UIlearn')

@section('content')
<div class="mx-auto max-w-6xl space-y-8 px-4 py-10 sm:px-6 sm:py-14">
  <header class="max-w-2xl">
    <p class="eyebrow">Kursus</p>
    <h1 class="mt-2 text-4xl font-bold tracking-tight sm:text-5xl">Pilih materi belajar</h1>
    <p class="muted mt-4 text-base leading-relaxed">Setiap topik berisi materi lengkap beserta FAQ, lalu ditutup dengan latihan 10 soal: 5 soal mudah dan 5 soal sedang.</p>
  </header>

  <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
    @foreach ($courses as $slug => $c)
      <article class="glass flex flex-col p-5 sm:p-6">
        <span class="accent font-mono text-3xl" aria-hidden="true">{{ $c['icon'] }}</span>
        <h2 class="mt-4 text-xl font-semibold tracking-tight">{{ $c['title'] }}</h2>
        <p class="muted mt-2 flex-1 text-sm leading-relaxed">{{ $c['tagline'] }}</p>
        <ul class="muted mt-4 space-y-1 font-mono text-xs">
          <li>{{ count($c['sections']) }} bagian materi</li>
          <li>{{ count($c['faq']) }} FAQ</li>
          <li>{{ count($c['questions']) }} soal latihan · {{ $c['duration'] }}</li>
        </ul>
        <div class="mt-5 flex flex-col gap-2 sm:flex-row">
          <a href="{{ route('lesson', $slug) }}" class="btn-primary !px-4 !py-2.5">Buka materi</a>
          <a href="{{ route('exercise', $slug) }}" class="btn-secondary !px-4 !py-2.5">Latihan</a>
        </div>
      </article>
    @endforeach
  </div>

  @guest
    <aside class="glass flex flex-col gap-3 p-5 sm:flex-row sm:items-center sm:justify-between sm:p-6">
      <p class="text-sm">Materi bisa dibaca tanpa login. <strong>Latihan dan AI Chat</strong> membutuhkan akun.</p>
      <a href="{{ route('register') }}" class="btn-primary shrink-0 !py-2.5">Daftar gratis</a>
    </aside>
  @endguest
</div>
@endsection
