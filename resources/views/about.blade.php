@extends('layouts.app')

@section('title', 'About — UIlearn')

@section('content')
<div class="mx-auto max-w-6xl space-y-8 px-4 py-10 sm:px-6 sm:py-14">
  <section aria-labelledby="about-title" class="glass overflow-hidden">
    <div class="eyebrow border-b border-[#363B6C]/10 px-5 py-3 dark:border-[#EAEDFE]/10 sm:px-8">Tentang UIlearn</div>
    <div class="px-5 py-10 sm:px-8 sm:py-14 lg:px-12">
      <h1 id="about-title" class="max-w-3xl text-balance text-4xl font-bold tracking-tight sm:text-5xl">U Learn, <span class="accent font-mono font-medium">I Learn</span></h1>
      <p class="muted mt-5 max-w-2xl text-pretty text-base leading-relaxed sm:text-lg">
        UIlearn adalah platform belajar UI/UX untuk pemula. Anda tidak perlu latar belakang desain. Cukup mulai dari tiga topik inti, kerjakan latihan, dan tanyakan apa pun kepada AI saat buntu.
      </p>
    </div>
  </section>

  <section aria-labelledby="outcome-title">
    <h2 id="outcome-title" class="eyebrow">Harapan hasil belajar</h2>
    <p class="mt-3 max-w-3xl text-base leading-relaxed">Setelah menyelesaikan kursus, Anda diharapkan mampu menilai dan memperbaiki tampilan antarmuka dengan alasan yang jelas, bukan sekadar selera. Anda juga punya fondasi untuk lanjut ke topik UI/UX yang lebih dalam.</p>
  </section>

  <section aria-labelledby="skills-title">
    <h2 id="skills-title" class="eyebrow">Kompetensi yang dapat dicapai</h2>
    <div class="mt-3 grid grid-cols-1 gap-4 md:grid-cols-3">
      @php
        $skills = [
          'tata-letak' => ['Menyusun hierarki visual sehingga aksi utama mudah dikenali.', 'Memakai grid dan skala jarak agar elemen sejajar dan konsisten.', 'Merancang tata letak yang menyesuaikan layar ponsel hingga laptop.'],
          'warna' => ['Membangun palet dengan aturan 60-30-10 dan skema warna dasar.', 'Memeriksa kontras teks agar memenuhi pedoman keterbacaan WCAG AA.', 'Memakai warna secara konsisten dan tidak hanya mengandalkan warna untuk informasi.'],
          'typography' => ['Memilih dan memasangkan satu sampai dua font dengan tepat.', 'Membuat hierarki dan skala tipografi yang harmonis.', 'Mengatur ukuran, tinggi baris, dan panjang baris agar nyaman dibaca.'],
        ];
      @endphp
      @foreach ($courses as $slug => $c)
        <article class="glass p-5 sm:p-6">
          <span class="accent font-mono text-2xl" aria-hidden="true">{{ $c['icon'] }}</span>
          <h3 class="mt-3 text-lg font-semibold tracking-tight">{{ $c['title'] }}</h3>
          <ul class="mt-3 list-disc space-y-2 pl-5 text-sm leading-relaxed">
            @foreach ($skills[$slug] as $s)<li>{{ $s }}</li>@endforeach
          </ul>
          <a href="{{ route('lesson', $slug) }}" class="accent mt-4 inline-block font-mono text-xs underline underline-offset-2">Pelajari materinya →</a>
        </article>
      @endforeach
    </div>
  </section>

  <section aria-labelledby="how-title">
    <h2 id="how-title" class="eyebrow">Cara belajar</h2>
    <ol class="mt-3 grid grid-cols-1 gap-4 md:grid-cols-3">
      @foreach ([['01', 'Baca materi', 'Konsep dijelaskan singkat, lengkap dengan tips dan FAQ.'], ['02', 'Kerjakan latihan', '10 soal per topik, dari mudah ke sedang, dengan pembahasan.'], ['03', 'Tanya AI', 'Bingung? AI Chat membantu menjelaskan dan memberi petunjuk.']] as [$n, $t, $d])
        <li class="glass p-5 sm:p-6"><p class="accent font-mono text-xs">{{ $n }}</p><h3 class="mt-2 text-lg font-semibold tracking-tight">{{ $t }}</h3><p class="muted mt-2 text-sm leading-relaxed">{{ $d }}</p></li>
      @endforeach
    </ol>
  </section>

  <div class="flex flex-col gap-3 sm:flex-row">
    <a href="{{ route('courses') }}" data-ripple class="btn-primary">Mulai belajar <span aria-hidden="true">→</span></a>
    <a href="{{ route('subscription') }}" class="btn-secondary">Lihat paket Free &amp; Pro</a>
  </div>
</div>
@endsection
