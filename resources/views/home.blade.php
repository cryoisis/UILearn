@extends('layouts.app')

@section('title', 'Dashboard — UIlearn')

@section('content')
{{-- 1. Hero dengan Divine Proportion (Golden Ratio: ~62% Konten Utama / ~38% Visual Harmonik) --}}
<section aria-labelledby="hero-title" class="mx-auto max-w-6xl px-4 py-12 sm:px-6 sm:py-16">
  <div class="glass overflow-hidden p-6 sm:p-10 lg:p-12">
    <div class="golden-layout items-center">
      {{-- Area Utama (61.8%): Titik Fokus Sudut Kiri Atas mengikuti Pola F (F-Pattern) --}}
      <div class="f-focal-point pl-3 sm:pl-4">
        <div class="eyebrow">
          @auth Halo, {{ auth()->user()->name }} · Selamat belajar @else Belajar UI/UX untuk Pemula @endauth
        </div>
        <h1 id="hero-title" class="mt-3 tracking-tight">
          <span class="inline-flex items-center gap-3 text-4xl font-bold sm:gap-4 sm:text-5xl lg:text-6xl">
            <img src="{{ asset('images/logo.png') }}" alt="UI" width="74" height="96" loading="eager" class="h-12 w-auto drop-shadow-sm dark:hidden sm:h-16 lg:h-20" />
            <img src="{{ asset('images/logo-dark.png') }}" alt="UI" width="74" height="96" loading="eager" class="hidden h-12 w-auto drop-shadow-sm dark:inline-block sm:h-16 lg:h-20" />
            <span>Learn</span>
          </span>
          <span class="accent mt-3 block font-mono text-2xl font-medium tracking-tight sm:text-3xl lg:text-4xl">U Learn, I Learn</span>
        </h1>
        {{-- Keterbacaan Optimal: Panjang baris 60 - 80 karakter (max-w-[65ch]) --}}
        <p class="muted prose-optimal mt-5 text-base leading-relaxed sm:text-lg">
          Kuasai fondasi desain web modern: <strong>Divine Proportion (Golden Ratio 1:1,618)</strong>, <strong>Rule of Thirds</strong> untuk penempatan elemen kunci, serta keterbacaan teks ideal <strong>60–80 karakter per baris</strong>.
        </p>
        <div class="mt-8 flex flex-col gap-3 sm:flex-row">
          @guest
            <a href="{{ route('register') }}" data-ripple class="btn-primary">Mulai Belajar Gratis <span aria-hidden="true">→</span></a>
            <a href="{{ route('courses') }}" class="btn-secondary">Jelajahi Kursus</a>
          @else
            <a href="{{ route('courses') }}" data-ripple class="btn-primary">Lanjut belajar <span aria-hidden="true">→</span></a>
            <a href="{{ route('chat') }}" class="btn-secondary">Buka AI Chat</a>
          @endguest
        </div>
      </div>

      {{-- Area Samping (38.2%): Visualisasi Interaktif Golden Ratio & Rule of Thirds --}}
      <div class="glass-recessed relative rounded-xl border border-[#363B6C]/15 p-5 dark:border-[#EAEDFE]/15">
        <div class="flex items-center justify-between border-b border-[#363B6C]/10 pb-3 dark:border-[#EAEDFE]/10">
          <span class="eyebrow">Rasio Harmonik</span>
          <span class="badge badge-pro">1 : 1,618</span>
        </div>
        
        {{-- Visual Grid 3x3 Rule of Thirds dengan Titik Temu Kiri Atas --}}
        <div class="mt-4 grid grid-cols-3 gap-1.5 rounded-lg border border-[#C6C9E7]/40 bg-[#363B6C]/5 p-2 dark:bg-[#EAEDFE]/5">
          <div class="relative flex h-14 items-center justify-center rounded border border-dashed border-[#C6C9E7]/50 bg-[#C6C9E7]/20 text-center font-mono text-[10px] font-semibold text-[#363B6C] dark:text-[#eaedfe]">
            <span class="absolute -bottom-1 -right-1 h-3 w-3 rounded-full bg-[#363B6C] ring-2 ring-[#C6C9E7] dark:bg-[#C6C9E7]" title="Titik Fokus Kiri Atas (Pola F)"></span>
            Fokus Utama (Pola F)
          </div>
          <div class="flex h-14 items-center justify-center rounded border border-dashed border-[#C6C9E7]/30 text-center font-mono text-[10px] opacity-70">
            Navigasi
          </div>
          <div class="flex h-14 items-center justify-center rounded border border-dashed border-[#C6C9E7]/30 text-center font-mono text-[10px] opacity-70">
            Aksi Kanan
          </div>
          <div class="flex h-14 items-center justify-center rounded border border-dashed border-[#C6C9E7]/30 text-center font-mono text-[10px] opacity-70">
            Konten
          </div>
          <div class="flex h-14 items-center justify-center rounded border border-dashed border-[#C6C9E7]/30 text-center font-mono text-[10px] opacity-70">
            Pusat
          </div>
          <div class="flex h-14 items-center justify-center rounded border border-dashed border-[#C6C9E7]/30 text-center font-mono text-[10px] opacity-70">
            Sidebar
          </div>
          <div class="flex h-14 items-center justify-center rounded border border-dashed border-[#C6C9E7]/30 text-center font-mono text-[10px] opacity-70">
            Dukungan
          </div>
          <div class="flex h-14 items-center justify-center rounded border border-dashed border-[#C6C9E7]/30 text-center font-mono text-[10px] opacity-70">
            Status
          </div>
          <div class="flex h-14 items-center justify-center rounded border border-dashed border-[#C6C9E7]/30 text-center font-mono text-[10px] opacity-70">
            Footer
          </div>
        </div>

        {{-- Kalkulasi Proporsi 960px --}}
        <div class="mt-4 space-y-2 font-mono text-xs">
          <div class="flex justify-between text-[#363B6C]/80 dark:text-[#EAEDFE]/80">
            <span>Contoh Layout 960px:</span>
            <span class="font-semibold">960 / 1,62</span>
          </div>
          <div class="grid grid-cols-[1.618fr_1fr] gap-1 text-[11px]">
            <div class="rounded bg-[#363B6C] px-2 py-1 text-center font-semibold text-[#EAEDFE] dark:bg-[#C6C9E7] dark:text-[#363B6C]">
              Konten ~593px (61,8%)
            </div>
            <div class="rounded border border-[#363B6C]/25 px-2 py-1 text-center dark:border-[#EAEDFE]/25">
              Sidebar ~367px (38,2%)
            </div>
          </div>
        </div>

        <div class="mt-4 flex items-center justify-between border-t border-[#363B6C]/10 pt-3 text-[11px] dark:border-[#EAEDFE]/10">
          <span class="muted">Alat bantu hitung:</span>
          <div class="flex gap-2">
            <a href="https://www.thismanslife.co.uk/phiculator" target="_blank" rel="noopener noreferrer" class="underline underline-offset-2 hover:text-[#363B6C]/60 dark:hover:text-[#C6C9E7]">Phiculator ↗</a>
            <a href="https://www.atrise.com/golden-section/" target="_blank" rel="noopener noreferrer" class="underline underline-offset-2 hover:text-[#363B6C]/60 dark:hover:text-[#C6C9E7]">Golden Section ↗</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

{{-- 2. Ciri Desain Web yang Baik (Rule of Thirds: 3 Kolom Seimbang) --}}
<section aria-labelledby="principles-title" class="mx-auto max-w-6xl px-4 py-12 sm:px-6">
  <div class="mb-8 max-w-2xl">
    <p class="eyebrow">Prinsip Fundamental</p>
    <h2 id="principles-title" class="mt-2 text-3xl font-semibold tracking-tight sm:text-4xl">Ciri Desain Web yang Baik</h2>
    <p class="muted prose-optimal mt-3 text-sm leading-relaxed sm:text-base">
      Desain yang efektif mengutamakan kenyamanan psikologis pengguna melalui tiga pilar: kejelasan fungsi, kenyamanan baca, dan keteraturan spasial.
    </p>
  </div>

  <div class="rule-of-thirds-grid">
    {{-- Pilar 1 --}}
    <article class="glass flex flex-col p-6 sm:p-7">
      <div class="flex items-center gap-3">
        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#363B6C] font-mono text-sm font-bold text-[#EAEDFE] dark:bg-[#C6C9E7] dark:text-[#363B6C]">01</span>
        <h3 class="text-xl font-semibold tracking-tight">Jelas dan Intuitif</h3>
      </div>
      <p class="muted prose-optimal mt-4 flex-1 text-sm leading-relaxed">
        Desain yang efektif tidak harus selalu penuh warna atau terlihat cantik, melainkan mudah dipahami dan memberikan rasa keteraturan serta kenyamanan alami bagi pengunjung.
      </p>
      <div class="glass-recessed mt-5 p-3 font-mono text-xs text-[#363B6C] dark:text-[#C6C9E7]">
        Kunci: Hirarki visual tegas tanpa elemen visual yang bersaing.
      </div>
    </article>

    {{-- Pilar 2 --}}
    <article class="glass flex flex-col p-6 sm:p-7">
      <div class="flex items-center gap-3">
        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#363B6C] font-mono text-sm font-bold text-[#EAEDFE] dark:bg-[#C6C9E7] dark:text-[#363B6C]">02</span>
        <h3 class="text-xl font-semibold tracking-tight">Keterbacaan Optimal</h3>
      </div>
      <p class="muted prose-optimal mt-4 flex-1 text-sm leading-relaxed">
        Ukuran tata letak yang proporsional akan membantu menjaga panjang baris teks tetap ideal, yaitu sekitar <strong>60 hingga 80 karakter per baris</strong>, sehingga nyaman dibaca tanpa melelahkan mata.
      </p>
      <div class="glass-recessed mt-5 p-3 font-mono text-xs text-[#363B6C] dark:text-[#C6C9E7]">
        Ideal: Rentang 60–80 karakter · Line-height 1,5–1,7.
      </div>
    </article>

    {{-- Pilar 3 --}}
    <article class="glass flex flex-col p-6 sm:p-7">
      <div class="flex items-center gap-3">
        <span class="flex h-10 w-10 items-center justify-center rounded-lg bg-[#363B6C] font-mono text-sm font-bold text-[#EAEDFE] dark:bg-[#C6C9E7] dark:text-[#363B6C]">03</span>
        <h3 class="text-xl font-semibold tracking-tight">Keseimbangan Struktural</h3>
      </div>
      <p class="muted prose-optimal mt-4 flex-1 text-sm leading-relaxed">
        Meskipun tidak selalu mengikuti rasio matematis secara kaku, tata letak yang menjaga proporsi konsisten antara blok utama dan ruang kosong (white space) di sekitarnya akan terasa seimbang dan rapi.
      </p>
      <div class="glass-recessed mt-5 p-3 font-mono text-xs text-[#363B6C] dark:text-[#C6C9E7]">
        Prinsip: White space memberi nafas pada konten utama.
      </div>
    </article>
  </div>
</section>

{{-- 3. Panduan Implementasi: Divine Proportion & Rule of Thirds --}}
<section aria-labelledby="golden-section-title" class="mx-auto max-w-6xl px-4 py-12 sm:px-6">
  <div class="golden-layout items-stretch gap-6">
    {{-- Kartu Golden Ratio (61.8%) --}}
    <div class="glass flex flex-col justify-between p-6 sm:p-8">
      <div>
        <div class="flex items-center justify-between">
          <p class="eyebrow">Prinsip 1</p>
          <span class="badge badge-pro">Rasio 1 : 1,618</span>
        </div>
        <h2 id="golden-section-title" class="mt-2 text-2xl font-bold tracking-tight sm:text-3xl">Penerapan Divine Proportion (Golden Ratio)</h2>
        <p class="muted prose-optimal mt-3 text-sm leading-relaxed sm:text-base">
          Prinsip ini menggunakan rasio <strong>1 : 1,618</strong> (sering dibulatkan menjadi <strong>1,62</strong> atau rasio cepat <strong>5 : 3</strong>) untuk menentukan ukuran elemen tata letak agar terasa harmonis secara alami.
        </p>

        <div class="glass-recessed mt-6 space-y-3 p-4 text-sm leading-relaxed">
          <p class="font-semibold text-[#363B6C] dark:text-[#EAEDFE]">Cara menghitung lebar kolom:</p>
          <p class="muted">
            Bagi total lebar tata letak dengan <strong>1,62</strong> untuk mendapatkan ukuran area konten utama, lalu sisanya digunakan untuk sidebar.
          </p>
          <div class="rounded-md border border-[#363B6C]/10 bg-[#EAEDFE]/40 p-3 font-mono text-xs dark:border-[#EAEDFE]/10 dark:bg-[#363B6C]/40">
            Contoh pada lebar 960px:<br>
            • Konten Utama = 960px / 1,62 ≈ <strong>593px</strong><br>
            • Sisa Sidebar = 960px - 593px = <strong>367px</strong>
          </div>
        </div>
      </div>

      <div class="mt-6 flex flex-wrap items-center justify-between gap-3 border-t border-[#363B6C]/10 pt-4 text-xs dark:border-[#EAEDFE]/10">
        <span class="muted font-mono">Alat bantu otomatis:</span>
        <div class="flex gap-3">
          <a href="https://www.thismanslife.co.uk/phiculator" target="_blank" rel="noopener noreferrer" class="btn-secondary !py-1.5 text-xs">
            Phiculator ↗
          </a>
          <a href="https://www.atrise.com/golden-section/" target="_blank" rel="noopener noreferrer" class="btn-secondary !py-1.5 text-xs">
            Golden Section Tool ↗
          </a>
        </div>
      </div>
    </div>

    {{-- Kartu Rule of Thirds (38.2%) --}}
    <div class="glass flex flex-col justify-between p-6 sm:p-8">
      <div>
        <div class="flex items-center justify-between">
          <p class="eyebrow">Prinsip 2</p>
          <span class="badge">Grid 3 × 3</span>
        </div>
        <h2 class="mt-2 text-2xl font-bold tracking-tight">Penerapan Rule of Thirds</h2>
        <p class="muted prose-optimal mt-3 text-sm leading-relaxed">
          Aturan ini adalah versi sederhana dari Golden Ratio untuk menonjolkan elemen terpenting tanpa perlu banyak perhitungan rumit.
        </p>

        <ul class="mt-5 space-y-3 text-sm leading-relaxed">
          <li class="flex items-start gap-2">
            <span class="accent font-mono font-bold">•</span>
            <span><strong>Membagi 9 bidang:</strong> Tarik 2 garis horizontal &amp; 2 vertikal dengan jarak sama.</span>
          </li>
          <li class="flex items-start gap-2">
            <span class="accent font-mono font-bold">•</span>
            <span><strong>Menempatkan elemen kunci:</strong> Posisikan pesan utama, navigasi penting, atau fitur unggulan di 4 titik perpotongan garis.</span>
          </li>
          <li class="flex items-start gap-2">
            <span class="accent font-mono font-bold">•</span>
            <span><strong>Fokus sudut kiri atas:</strong> Titik potong kiri atas adalah area terkuat karena pengguna cenderung memindai halaman web mengikuti <strong>pola huruf "F" (F-pattern)</strong>.</span>
          </li>
        </ul>
      </div>

      <div class="glass-recessed mt-6 border-l-4 border-l-[#C6C9E7] p-3 text-xs leading-relaxed">
        <strong>Tips Cepat:</strong> Tempatkan Logo dan Call-to-Action terpenting pada perpotongan garis sepertiga atas kiri.
      </div>
    </div>
  </div>
</section>

{{-- 4. Contoh interaksi AI (preset) dengan Golden Ratio Layout --}}
<section id="ai-demo" aria-labelledby="demo-title" class="mx-auto max-w-6xl px-4 py-12 sm:px-6">
  <div class="mb-8 max-w-2xl">
    <p class="eyebrow">Contoh AI Chat</p>
    <h2 id="demo-title" class="mt-2 text-3xl font-semibold tracking-tight sm:text-4xl">Bingung soal desain? Tanya saja.</h2>
    <p class="muted prose-optimal mt-3 text-sm leading-relaxed sm:text-base">Pilih salah satu pertanyaan di bawah untuk melihat bagaimana AI membantu Anda memahami tata letak proporsional.</p>
  </div>
  
  <div class="glass p-5 sm:p-7">
    <div class="golden-layout items-start gap-6">
      {{-- Kolom Kiri (~62%): Layar Interaksi AI --}}
      <div class="min-w-0">
        <div id="ai-demo-log" class="min-h-[18rem] space-y-4 rounded-xl p-1 sm:p-2" aria-live="polite"></div>
        <p class="muted mt-4 border-t border-[#363B6C]/10 pt-3 font-mono text-xs dark:border-[#EAEDFE]/10">
          @guest
            Ini hanya contoh. <a href="{{ route('login') }}" class="font-medium underline underline-offset-2">Sign in</a> untuk bertanya bebas kepada AI.
          @else
            Ingin bertanya hal lain? <a href="{{ route('chat') }}" class="font-medium underline underline-offset-2">Buka AI Chat</a>.
          @endguest
        </p>
      </div>

      {{-- Kolom Kanan (~38%): Pilihan Pertanyaan Cepat (Chips) & Tips --}}
      <div class="glass-recessed flex flex-col gap-4 p-4">
        <div>
          <p class="eyebrow">Pilihan Pertanyaan</p>
          <div class="mt-3 flex flex-wrap gap-2" role="group" aria-label="Pertanyaan contoh">
            @foreach ($presets as $p)
              <button type="button" class="chip w-full justify-start text-left" data-preset="{{ $p['id'] }}" aria-pressed="false">{{ $p['q'] }}</button>
            @endforeach
          </div>
        </div>
        <div class="border-t border-[#363B6C]/10 pt-3 text-xs leading-relaxed text-[#363B6C]/75 dark:border-[#EAEDFE]/10 dark:text-[#EAEDFE]/70">
          💡 AI dapat membantu menghitung Golden Ratio layout Anda, memeriksa kontras warna WCAG AA, dan merekomendasikan skala typography.
        </div>
      </div>
    </div>
  </div>
  <script type="application/json" id="ai-demo-data">@json($presets)</script>
</section>

{{-- 5. Sebelum & sesudah belajar UI/UX --}}
<section aria-labelledby="compare-title" class="mx-auto max-w-6xl px-4 py-12 sm:px-6">
  <div class="mb-8 max-w-2xl">
    <p class="eyebrow">Perbandingan Nyata</p>
    <h2 id="compare-title" class="mt-2 text-3xl font-semibold tracking-tight sm:text-4xl">Sebelum dan Sesudah Menerapkan Prinsip</h2>
    <p class="muted prose-optimal mt-3 text-sm leading-relaxed sm:text-base">
      Isi dan fungsinya sama persis. Yang berubah adalah penerapan Divine Proportion (Golden Ratio), Rule of Thirds (fokus kiri atas), dan keterbacaan baris teks 60–80 karakter.
    </p>
  </div>
  <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
    {{-- Sebelum --}}
    <figure class="glass p-5 sm:p-6">
      <figcaption class="mb-4 flex items-center justify-between">
        <span class="badge">Sebelum</span>
        <span class="muted text-xs">Abaikan proporsi &amp; panjang baris</span>
      </figcaption>
      <div class="mock-before overflow-hidden rounded-lg p-4" style="background:#ffe14d;color:#ff4fd8" role="img" aria-label="Contoh formulir pendaftaran yang berantakan: warna bertabrakan, banyak font, jarak acak, tombol tidak jelas">
        <div style="font-size:11px">DAFTAR SEKARANG!!!</div>
        <div style="font-size:26px;font-weight:700;font-family:'Times New Roman',serif;color:#00c2ff;margin-top:2px">Buat akun</div>
        <div style="font-size:9px;color:#ffc9f4;margin-top:6px">isi data kamu di bawah ini ya supaya bisa dipakai nanti untuk login ke website</div>
        <div style="margin-top:14px;display:flex;gap:4px"><span style="border:1px solid #f00;background:#0f0;padding:3px 6px;font-size:10px;width:48%">nama</span><span style="border:1px solid #00f;background:#ff0;padding:3px 6px;font-size:10px;width:48%">email</span></div>
        <div style="margin-top:2px;display:flex;gap:4px;align-items:center"><span style="background:#ff7a00;color:#ffe14d;padding:4px 8px;font-size:12px">kirim</span><span style="background:#ff7a00;color:#ffe14d;padding:4px 8px;font-size:12px">batal</span><span style="background:#ff7a00;color:#ffe14d;padding:4px 8px;font-size:12px">reset</span></div>
      </div>
    </figure>
    {{-- Sesudah --}}
    <figure class="glass p-5 sm:p-6">
      <figcaption class="mb-4 flex items-center justify-between">
        <span class="badge badge-pro">Sesudah</span>
        <span class="muted text-xs">Proporsional, seimbang, mudah dipindai</span>
      </figcaption>
      <div class="rounded-lg border border-[#363B6C]/15 bg-[#EAEDFE] p-6 text-[#363B6C]" role="img" aria-label="Contoh formulir pendaftaran yang rapi: satu warna aksen, hierarki jelas, jarak konsisten, satu tombol utama">
        <p class="text-xs font-semibold uppercase tracking-wider text-[#363B6C]">Daftar Akun</p>
        <p class="mt-1 text-2xl font-bold leading-tight">Buat akun Anda</p>
        <p class="mt-2 text-sm leading-6 text-[#363B6C]/80">Terapkan Golden Ratio dan keterbacaan teks ideal.</p>
        <div class="mt-5 grid grid-cols-2 gap-3">
          <div class="rounded-md border border-[#C6C9E7] px-3 py-2 text-sm text-[#363B6C]/80">Nama</div>
          <div class="rounded-md border border-[#C6C9E7] px-3 py-2 text-sm text-[#363B6C]/80">Email</div>
        </div>
        <div class="mt-4 flex items-center gap-3">
          <span class="rounded-md bg-[#363B6C] px-5 py-2 text-sm font-semibold text-[#EAEDFE]">Daftar</span>
          <span class="text-sm text-[#363B6C]/80 underline underline-offset-2">Batal</span>
        </div>
      </div>
    </figure>
  </div>
  <ul class="mt-6 grid grid-cols-1 gap-4 sm:grid-cols-3">
    @foreach ([
      ['Tata Letak & Proporsi', 'Rasio 1:1,618 membagi konten & sidebar secara harmonis, fokus F-pattern.'],
      ['Warna & Kontras', 'Palet 60-30-10, satu warna aksen, kontras teks memenuhi WCAG AA.'],
      ['Typography & Keterbacaan', 'Panjang baris dijaga 60–80 karakter, skala tipografi proporsional.']
    ] as [$t, $d])
      <li class="glass-recessed p-4">
        <p class="text-sm font-semibold">{{ $t }}</p>
        <p class="muted prose-optimal mt-1 text-sm">{{ $d }}</p>
      </li>
    @endforeach
  </ul>
</section>

{{-- 6. Pilihan materi (Rule of Thirds: 3 Kolom) --}}
<section id="materi" aria-labelledby="courses-title" class="mx-auto max-w-6xl px-4 py-12 sm:px-6">
  <div class="mb-8 max-w-2xl">
    <p class="eyebrow">Materi Belajar</p>
    <h2 id="courses-title" class="mt-2 text-3xl font-semibold tracking-tight sm:text-4xl">Pilih Topik untuk Dipelajari</h2>
    <p class="muted prose-optimal mt-2 text-sm sm:text-base">Tiga pilar dasar yang wajib dipahami sebelum merancang antarmuka profesional.</p>
  </div>
  <div class="rule-of-thirds-grid">
    @foreach ($courses as $slug => $c)
      <a href="{{ route('lesson', $slug) }}" class="glass group flex flex-col p-6 transition hover:border-[#C6C9E7] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#C6C9E7]">
        <div class="flex items-center justify-between">
          <span class="accent font-mono text-3xl" aria-hidden="true">{{ $c['icon'] }}</span>
          <span class="muted font-mono text-xs">{{ $c['duration'] }}</span>
        </div>
        <h3 class="mt-4 text-xl font-semibold tracking-tight">{{ $c['title'] }}</h3>
        <p class="muted prose-optimal mt-2 flex-1 text-sm leading-relaxed">{{ $c['tagline'] }}</p>
        <p class="accent mt-4 font-mono text-xs font-semibold">Mulai belajar <span aria-hidden="true" class="inline-block transition group-hover:translate-x-1">→</span></p>
      </a>
    @endforeach
  </div>
  <div class="mt-8 flex justify-center">
    <a href="{{ route('courses') }}" class="btn-secondary">Lihat semua materi kursus <span aria-hidden="true">→</span></a>
  </div>
</section>

{{-- 7. About singkat dalam Golden Proportion (~62% Deskripsi / ~38% CTA) --}}
<section aria-labelledby="about-short-title" class="mx-auto max-w-6xl px-4 py-12 sm:px-6">
  <div class="glass golden-layout items-center p-6 sm:p-8">
    <div class="f-focal-point pl-3 sm:pl-4">
      <p class="eyebrow">Tentang UIlearn</p>
      <h2 id="about-short-title" class="mt-2 text-2xl font-semibold tracking-tight sm:text-3xl">Belajar UI/UX Tanpa Merasa Kewalahan</h2>
      <p class="muted prose-optimal mt-3 text-sm leading-relaxed sm:text-base">
        UIlearn dirancang khusus bagi pemula. Materinya padat dan berbobot, mengupas tuntas rasio matematis seperti Golden Ratio 1:1,618, komposisi Rule of Thirds, hingga latihan interaktif yang dinilai langsung secara otomatis.
      </p>
    </div>
    <div class="flex flex-col items-start gap-3 lg:items-end">
      <a href="{{ route('about') }}" class="btn-secondary">Baca Selengkapnya <span aria-hidden="true">→</span></a>
    </div>
  </div>
</section>

{{-- 8. Ajakan menjadi member (hanya untuk yang belum login) --}}
@guest
<section id="join" aria-labelledby="join-title" class="mx-auto max-w-6xl scroll-mt-24 px-4 pb-20 pt-4 sm:px-6">
  <article class="glass overflow-hidden">
    <div class="golden-layout">
      {{-- Kolom Kiri (~62%) --}}
      <div class="border-b border-[#363B6C]/10 p-6 dark:border-[#EAEDFE]/10 md:p-8 lg:border-b-0 lg:border-r">
        <p class="eyebrow">Kenapa jadi member?</p>
        <h2 id="join-title" class="mt-3 text-balance text-2xl font-semibold leading-snug tracking-tight sm:text-3xl">Buka kursus lengkap dan AI Chat.</h2>
        <p class="muted prose-optimal mt-3 text-sm leading-relaxed">
          Tanpa login Anda bisa membaca materi. Dengan akun gratis Anda bisa mengerjakan latihan dan mencoba AI Chat. Bantuan AI saat latihan tersedia di paket Free dengan batas pesan dan jeda 30 menit; paket Pro membukanya tanpa batas.
        </p>
        <div class="mt-6 flex flex-col gap-3 sm:flex-row">
          <a href="{{ route('register') }}" class="btn-primary">Daftar gratis</a>
          <a href="{{ route('login') }}" class="btn-ghost inline-flex items-center justify-center px-6 py-3 text-sm">Saya sudah punya akun</a>
        </div>
      </div>
      {{-- Kolom Kanan (~38%) --}}
      <div class="overflow-x-auto p-4 sm:p-6">
        <table class="w-full min-w-[360px] border-collapse text-left text-sm">
          <caption class="sr-only">Perbandingan akses tamu, Free, dan Pro</caption>
          <thead>
            <tr class="border-b border-[#363B6C]/10 font-mono text-[11px] uppercase tracking-wider dark:border-[#EAEDFE]/10">
              <th scope="col" class="px-3 py-2.5"><span class="sr-only">Fitur</span></th>
              <th scope="col" class="px-3 py-2.5 font-medium">Free</th>
              <th scope="col" class="bg-[#C6C9E7]/20 px-3 py-2.5 font-medium">Pro</th>
            </tr>
          </thead>
          <tbody class="[&_tr]:border-b [&_tr]:border-[#363B6C]/10 dark:[&_tr]:border-[#EAEDFE]/10 [&_tr:last-child]:border-b-0">
            <tr><th scope="row" class="px-3 py-2.5 font-semibold">Materi</th><td class="px-3 py-2.5">Lengkap</td><td class="bg-[#C6C9E7]/20 px-3 py-2.5">Lengkap</td></tr>
            <tr><th scope="row" class="px-3 py-2.5 font-semibold">Latihan</th><td class="px-3 py-2.5">10 soal/topik</td><td class="bg-[#C6C9E7]/20 px-3 py-2.5">10 soal/topik</td></tr>
            <tr><th scope="row" class="px-3 py-2.5 font-semibold">AI Chat</th><td class="px-3 py-2.5">{{ config('uilearn.plans.free.daily_ai_messages') }} pesan/hari</td><td class="bg-[#C6C9E7]/20 px-3 py-2.5">Tanpa batas</td></tr>
            <tr><th scope="row" class="px-3 py-2.5 font-semibold">AI saat latihan</th><td class="px-3 py-2.5">{{ config('uilearn.plans.free.exercise_ai_messages', 5) }} pesan, lalu jeda 30 menit</td><td class="bg-[#C6C9E7]/20 px-3 py-2.5">Tanpa batas</td></tr>
          </tbody>
        </table>
      </div>
    </div>
  </article>
</section>
@endguest
@endsection
