@extends('layouts.app')

@section('title', 'Kursus — UIlearn')

@section('content')
<div class="mx-auto max-w-6xl space-y-8 px-4 py-10 sm:px-6 sm:py-14">
  {{-- Header Halaman --}}
  <div class="glass overflow-hidden p-6 sm:p-10 lg:p-12">
    <header class="border-0">
      <h1 class="text-4xl font-bold tracking-tight sm:text-5xl">Pilih Materi Belajar</h1>
      <p class="muted prose-optimal mt-4 leading-relaxed sm:text-lg text-base">
        Setiap topik dirancang dengan prinsip desain terstruktur: materi padat, FAQ mendalam, dan 10 latihan bertahap (5 mudah, 5 sedang) yang menerapkan Divine Proportion dan Rule of Thirds.
      </p>
    </header>
  </div>

  {{-- Tata Letak Golden Ratio (61,8% Kursus Utama / 38,2% Panduan Proporsi & Alat Bantu) --}}
  <div class="golden-layout items-start gap-8">
    {{-- Kolom Utama: Kartu Kursus (61.8%) --}}
    <div class="space-y-6">
      <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-1">
        @foreach ($courses as $slug => $c)
          <article class="glass flex flex-col p-6 sm:p-7 transition hover:border-[#C6C9E7]">
            <div class="flex items-start justify-between gap-4">
              <span class="accent font-mono text-3xl" aria-hidden="true">{{ $c['icon'] }}</span>
              <span class="badge {{ $slug === 'tata-letak' ? 'badge-pro' : '' }}">
                {{ $slug === 'tata-letak' ? 'Golden Ratio & 3×3 Grid' : $c['duration'] }}
              </span>
            </div>
            <h2 class="mt-4 font-semibold tracking-tight text-xl sm:text-2xl">{{ $c['title'] }}</h2>
            <p class="muted prose-optimal mt-2 flex-1 leading-relaxed text-base">{{ $c['tagline'] }}</p>
            
            <div class="glass-recessed mt-5 flex flex-wrap items-center justify-between gap-2 p-3 font-mono text-xs">
              <span>{{ count($c['sections']) }} Bagian Materi</span>
              <span>•</span>
              <span>{{ count($c['faq']) }} FAQ</span>
              <span>•</span>
              <span>{{ count($c['questions']) }} Soal Latihan</span>
            </div>

            <div class="mt-6 flex flex-col gap-3 sm:flex-row">
              <a href="{{ route('lesson', $slug) }}" class="btn-primary !py-2.5">Buka Materi <span aria-hidden="true">→</span></a>
              <a href="{{ route('exercise', $slug) }}" class="btn-secondary !py-2.5">Kerjakan Latihan</a>
            </div>
          </article>
        @endforeach
      </div>

      @guest
        <aside class="glass flex flex-col gap-4 p-6 sm:flex-row sm:items-center sm:justify-between">
          <div>
            <p class="font-semibold text-sm">Materi terbuka untuk umum</p>
            <p class="muted text-xs mt-1">Buat akun gratis untuk mengerjakan kuis latihan dan bertanya ke AI.</p>
          </div>
          <a href="{{ route('register') }}" class="btn-primary shrink-0 !py-2.5">Daftar Akun Gratis</a>
        </aside>
      @endguest
    </div>

    {{-- Kolom Samping (38.2%): Panduan Divine Proportion & Rule of Thirds --}}
    <div class="space-y-6">
      {{-- Box Panduan Golden Ratio --}}
      <aside class="glass p-6">
        <div class="flex items-center justify-between border-b border-[#363B6C]/10 pb-3 dark:border-[#EAEDFE]/10">
          <p class="eyebrow">Aturan Tata Letak</p>
          <span class="badge badge-pro">1 : 1,618</span>
        </div>
        <h3 class="mt-3 font-semibold tracking-tight text-xl">Divine Proportion (Golden Ratio)</h3>
        <p class="muted prose-optimal mt-2 leading-relaxed text-base">
          Gunakan rasio <strong>1 : 1,618</strong> (dibulatkan <strong>1,62</strong> atau <strong>5 : 3</strong>) untuk membagi bidang secara harmonis.
        </p>

        <div class="glass-recessed mt-4 p-3 text-xs">
          <p class="font-semibold text-[#363B6C] dark:text-[#C6C9E7]">Rumus Pembagian Kolom:</p>
          <p class="mt-1 font-mono">Area Utama = Total Lebar / 1,62</p>
          <p class="font-mono">Sidebar = Total Lebar - Area Utama</p>
          <div class="mt-2 rounded border border-[#363B6C]/10 bg-[#EAEDFE]/40 p-2 font-mono text-[11px] dark:border-[#EAEDFE]/10 dark:bg-[#363B6C]/40">
            Layout 960px:<br>
            • Utama: 960 / 1,62 ≈ <strong>593px</strong><br>
            • Sidebar: 960 - 593 = <strong>367px</strong>
          </div>
        </div>

        <h4 class="mt-5 text-sm font-semibold tracking-tight">Rule of Thirds (Aturan Sepertiga)</h4>
        <p class="muted prose-optimal mt-1 leading-relaxed text-base">
          Bagi bidang menjadi <strong>9 bagian</strong> (3x3). Tempatkan elemen kunci di 4 titik perpotongan, dengan prioritas <strong>sudut kiri atas</strong> mengikuti pola pemindaian huruf "F" (F-pattern).
        </p>

        <div class="mt-5 border-t border-[#363B6C]/10 pt-4 dark:border-[#EAEDFE]/10">
          <p class="eyebrow text-[10px]">Alat Bantu Rekomendasi</p>
          <ul class="mt-2 space-y-2 text-xs">
            <li>
              <a href="https://www.thismanslife.co.uk/phiculator" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between text-[#363B6C] underline-offset-2 hover:underline dark:text-[#EAEDFE]">
                <span>Phiculator</span>
                <span class="muted font-mono text-[11px]">Hitung otomatis ↗</span>
              </a>
            </li>
            <li>
              <a href="https://www.atrise.com/golden-section/" target="_blank" rel="noopener noreferrer" class="flex items-center justify-between text-[#363B6C] underline-offset-2 hover:underline dark:text-[#EAEDFE]">
                <span>Golden Section Ratio Tool</span>
                <span class="muted font-mono text-[11px]">Grid generator ↗</span>
              </a>
            </li>
          </ul>
        </div>
      </aside>

      {{-- Tips Keterbacaan --}}
      <aside class="glass-recessed p-5 text-xs leading-relaxed">
        <p class="font-semibold text-[#363B6C] dark:text-[#C6C9E7]">💡 Keterbacaan Optimal</p>
        <p class="muted mt-1">
          Jaga panjang baris teks antara <strong>60 hingga 80 karakter per baris</strong>. Jika teks terlalu lebar, mata pembaca kesulitan melompat ke baris baru.
        </p>
      </aside>
    </div>
  </div>
</div>
@endsection
