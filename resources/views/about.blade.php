@extends('layouts.app')

@section('title', 'About — UIlearn')

@section('content')
<div class="mx-auto max-w-6xl space-y-12 px-4 py-10 sm:px-6 sm:py-14">
  {{-- 1. Hero dengan Divine Proportion (Golden Ratio 61.8% Konten / 38.2% Visual) --}}
  <section aria-labelledby="about-title" class="glass overflow-hidden p-6 sm:p-10 lg:p-12">
    <div class="golden-layout items-center">
      {{-- Area Utama: Fokus Sudut Kiri Atas (F-Pattern) --}}
      <div class="f-focal-point pl-3 sm:pl-4">
        <p class="eyebrow">Tentang UIlearn</p>
        <h1 id="about-title" class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl lg:text-5xl">
          U Learn, <span class="accent font-mono font-medium">I Learn</span>
        </h1>
        <p class="muted prose-optimal mt-4 text-base leading-relaxed sm:text-lg">
          UIlearn adalah platform edukasi desain web antarmuka (UI/UX) yang dirancang untuk pemula. Kami percaya bahwa desain yang efektif tidak berakar pada selera subjektif semata, melainkan berpijak pada rasio harmonis alami dan psikologi persepsi visual.
        </p>
        <div class="mt-6 flex flex-wrap gap-2 text-xs">
          <span class="badge badge-pro">Divine Proportion (1 : 1,618)</span>
          <span class="badge">Rule of Thirds (3×3)</span>
          <span class="badge">Keterbacaan 60–80 Karakter</span>
        </div>
      </div>

      {{-- Area Samping: Visualisasi Rasio Spasial --}}
      <div class="glass-recessed p-5 text-xs">
        <p class="eyebrow">Proporsi Harmonis</p>
        <div class="mt-3 aspect-[1.618/1] rounded-lg border border-dashed border-[#C6C9E7]/60 bg-[#363B6C]/5 p-3 dark:bg-[#EAEDFE]/5">
          <div class="grid h-full grid-cols-[1.618fr_1fr] gap-2">
            <div class="flex flex-col justify-between rounded bg-[#363B6C] p-2 text-[#EAEDFE] dark:bg-[#C6C9E7] dark:text-[#363B6C]">
              <span class="font-mono text-[10px]">Konten Utama</span>
              <span class="font-mono text-sm font-bold">~61,8%</span>
            </div>
            <div class="flex flex-col justify-between rounded border border-[#363B6C]/20 p-2 dark:border-[#EAEDFE]/20">
              <span class="font-mono text-[10px]">Sidebar</span>
              <span class="font-mono text-sm font-bold">~38,2%</span>
            </div>
          </div>
        </div>
        <p class="muted mt-3 text-[11px] leading-relaxed">
          Proporsi 1 : 1,618 diadopsi dari alam semesta dan diaplikasikan dalam tata letak web digital.
        </p>
      </div>
    </div>
  </section>

  {{-- 2. Ciri Desain Web yang Baik (Rule of Thirds: 3 Kolom) --}}
  <section aria-labelledby="web-features-title">
    <div class="mb-6 max-w-2xl">
      <p class="eyebrow">Standar Kualitas</p>
      <h2 id="web-features-title" class="mt-2 text-2xl font-bold tracking-tight sm:text-3xl">Ciri Desain Web yang Baik</h2>
      <p class="muted prose-optimal mt-2 text-sm sm:text-base">
        Desain antarmuka yang berhasil selalu memiliki karakteristik fundamental yang konsisten:
      </p>
    </div>

    <div class="rule-of-thirds-grid">
      <article class="glass p-6">
        <div class="flex items-center gap-3">
          <span class="flex h-9 w-9 items-center justify-center rounded-md bg-[#363B6C] font-mono text-sm font-bold text-[#EAEDFE] dark:bg-[#C6C9E7] dark:text-[#363B6C]">1</span>
          <h3 class="text-lg font-semibold">Jelas dan Intuitif</h3>
        </div>
        <p class="muted prose-optimal mt-3 text-sm leading-relaxed">
          Desain yang efektif tidak harus selalu penuh warna atau terlihat cantik, melainkan mudah dipahami dan memberikan rasa keteraturan serta kenyamanan alami bagi pengunjung.
        </p>
      </article>

      <article class="glass p-6">
        <div class="flex items-center gap-3">
          <span class="flex h-9 w-9 items-center justify-center rounded-md bg-[#363B6C] font-mono text-sm font-bold text-[#EAEDFE] dark:bg-[#C6C9E7] dark:text-[#363B6C]">2</span>
          <h3 class="text-lg font-semibold">Keterbacaan Optimal</h3>
        </div>
        <p class="muted prose-optimal mt-3 text-sm leading-relaxed">
          Ukuran tata letak yang proporsional akan membantu menjaga panjang baris teks tetap ideal, yaitu sekitar <strong>60 hingga 80 karakter per baris</strong>, sehingga nyaman dibaca tanpa membuat mata cepat lelah.
        </p>
      </article>

      <article class="glass p-6">
        <div class="flex items-center gap-3">
          <span class="flex h-9 w-9 items-center justify-center rounded-md bg-[#363B6C] font-mono text-sm font-bold text-[#EAEDFE] dark:bg-[#C6C9E7] dark:text-[#363B6C]">3</span>
          <h3 class="text-lg font-semibold">Keseimbangan Struktural</h3>
        </div>
        <p class="muted prose-optimal mt-3 text-sm leading-relaxed">
          Meskipun tidak selalu mengikuti rasio matematis secara kaku, tata letak yang menjaga proporsi konsisten antara blok utama dan ruang kosong (white space) di sekitarnya akan terasa seimbang dan rapi.
        </p>
      </article>
    </div>
  </section>

  {{-- 3. Dua Pilar Penerapan: Golden Ratio & Rule of Thirds --}}
  <section aria-labelledby="math-principles-title" class="glass p-6 sm:p-8">
    <p class="eyebrow">Dua Pilar Penerapan</p>
    <h2 id="math-principles-title" class="mt-2 text-2xl font-bold tracking-tight sm:text-3xl">Penerapan Matematis &amp; Komposisi</h2>
    
    <div class="golden-layout mt-6 items-stretch gap-6">
      {{-- Pilar 1: Divine Proportion --}}
      <div class="glass-recessed flex flex-col justify-between p-5 sm:p-6">
        <div>
          <h3 class="text-xl font-semibold tracking-tight">1. Penerapan Divine Proportion (Golden Ratio)</h3>
          <p class="muted prose-optimal mt-2 text-sm leading-relaxed">
            Prinsip ini menggunakan rasio <strong>1 : 1,618</strong> (sering dibulatkan menjadi <strong>1,62</strong> atau rasio cepat <strong>5 : 3</strong>) untuk menentukan ukuran elemen tata letak agar terasa harmonis secara alami.
          </p>
          <div class="mt-4 space-y-2 text-xs">
            <p><strong>Cara menghitung lebar kolom:</strong> Bagi total lebar tata letak dengan 1,62 untuk mendapatkan ukuran area konten utama, lalu sisanya digunakan untuk sidebar.</p>
            <div class="rounded border border-[#363B6C]/10 bg-[#EAEDFE]/50 p-3 font-mono dark:border-[#EAEDFE]/10 dark:bg-[#363B6C]/40">
              Contoh pada lebar 960px:<br>
              • Konten utama: 960px / 1,62 ≈ <strong>593px</strong><br>
              • Sidebar: 960px - 593px = <strong>367px</strong>
            </div>
          </div>
        </div>
        <div class="mt-4 border-t border-[#363B6C]/10 pt-3 text-xs dark:border-[#EAEDFE]/10">
          <span class="muted">Alat bantu online: </span>
          <a href="https://www.thismanslife.co.uk/phiculator" target="_blank" rel="noopener noreferrer" class="underline hover:text-[#363B6C]/60 dark:hover:text-[#C6C9E7]">Phiculator</a> &amp;
          <a href="https://www.atrise.com/golden-section/" target="_blank" rel="noopener noreferrer" class="underline hover:text-[#363B6C]/60 dark:hover:text-[#C6C9E7]">Golden Section Ratio Design Tool</a>
        </div>
      </div>

      {{-- Pilar 2: Rule of Thirds --}}
      <div class="glass-recessed flex flex-col justify-between p-5 sm:p-6">
        <div>
          <h3 class="text-xl font-semibold tracking-tight">2. Penerapan Rule of Thirds</h3>
          <p class="muted prose-optimal mt-2 text-sm leading-relaxed">
            Aturan ini adalah versi sederhana dari Golden Ratio untuk menonjolkan elemen terpenting tanpa perlu banyak perhitungan rumit.
          </p>
          <ul class="mt-4 space-y-2.5 text-xs leading-relaxed">
            <li><strong>Membagi bidang menjadi 9 bagian:</strong> Tarik dua garis horizontal dan dua garis vertikal dengan jarak yang sama pada area tata letak.</li>
            <li><strong>Menempatkan elemen kunci:</strong> Letakkan pesan utama, navigasi penting, atau fitur unggulan di empat titik perpotongan garis tersebut.</li>
            <li><strong>Fokus pada sudut kiri atas:</strong> Titik potong di bagian kiri atas merupakan area terkuat karena pengguna cenderung memindai halaman web mengikuti <strong>pola huruf "F" (F-pattern)</strong>.</li>
          </ul>
        </div>
        <div class="mt-4 border-t border-[#363B6C]/10 pt-3 text-xs dark:border-[#EAEDFE]/10">
          <span class="muted">Tujuan: Memastikan mata pengunjung langsung menangkap aksi penting pertama kali.</span>
        </div>
      </div>
    </div>
  </section>

  {{-- 4. Kompetensi yang Dicapai --}}
  <section aria-labelledby="skills-title">
    <div class="mb-6 max-w-2xl">
      <p class="eyebrow">Capaian Pembelajaran</p>
      <h2 id="skills-title" class="mt-2 text-2xl font-bold tracking-tight">Kompetensi yang Dapat Dicapai</h2>
    </div>
    
    <div class="rule-of-thirds-grid">
      @php
        $skills = [
          'tata-letak' => [
            'Menghitung dan membagi layout dengan Golden Ratio 1:1,618 (62% konten : 38% sidebar).',
            'Menerapkan Rule of Thirds 9 kotak & menempatkan pesan utama pada titik kiri atas.',
            'Menjaga panjang baris teks 60–80 karakter untuk kenyamanan membaca optimal.',
          ],
          'warna' => [
            'Membangun palet dengan aturan 60-30-10 dan skema warna dasar.',
            'Memeriksa kontras teks agar memenuhi pedoman keterbacaan WCAG AA.',
            'Memakai warna secara konsisten dan tidak hanya mengandalkan warna untuk informasi.',
          ],
          'typography' => [
            'Memilih dan memasangkan satu sampai dua font dengan tepat.',
            'Membuat hierarki dan skala tipografi yang harmonis.',
            'Mengatur line-height dan letter-spacing secara proporsional.',
          ],
        ];
      @endphp
      @foreach ($courses as $slug => $c)
        <article class="glass flex flex-col p-6">
          <div class="flex items-center justify-between">
            <span class="accent font-mono text-2xl" aria-hidden="true">{{ $c['icon'] }}</span>
            <span class="badge">{{ $c['duration'] }}</span>
          </div>
          <h3 class="mt-3 text-xl font-semibold tracking-tight">{{ $c['title'] }}</h3>
          <ul class="mt-4 flex-1 list-disc space-y-2 pl-4 text-xs leading-relaxed text-[#363B6C]/85 dark:text-[#EAEDFE]/85">
            @foreach ($skills[$slug] as $s)
              <li>{{ $s }}</li>
            @endforeach
          </ul>
          <a href="{{ route('lesson', $slug) }}" class="accent mt-5 inline-block font-mono text-xs font-semibold underline underline-offset-2">Pelajari materinya →</a>
        </article>
      @endforeach
    </div>
  </section>

  {{-- 5. Cara Belajar --}}
  <section aria-labelledby="how-title">
    <div class="mb-6 max-w-2xl">
      <p class="eyebrow">Metode Edukasi</p>
      <h2 id="how-title" class="mt-2 text-2xl font-bold tracking-tight">Cara Belajar di UIlearn</h2>
    </div>
    <ol class="rule-of-thirds-grid">
      @foreach ([
        ['01', 'Baca Materi Ringkas', 'Konsep tata letak, Golden Ratio, Rule of Thirds, dan tipografi disajikan padat dan jelas.'],
        ['02', 'Kerjakan Latihan', '10 soal terstruktur (5 mudah & 5 sedang) langsung dinilai dengan pembahasan komprehensif.'],
        ['03', 'Konsultasi dengan AI', 'Bingung soal komposisi atau kontras warna? AI Chat siap membimbing langkah demi langkah.']
      ] as [$n, $t, $d])
        <li class="glass p-6">
          <p class="accent font-mono text-sm font-bold">{{ $n }}</p>
          <h3 class="mt-2 text-lg font-semibold tracking-tight">{{ $t }}</h3>
          <p class="muted prose-optimal mt-2 text-sm leading-relaxed">{{ $d }}</p>
        </li>
      @endforeach
    </ol>
  </section>

  {{-- Tombol Aksi Akhir --}}
  <div class="flex flex-col gap-3 sm:flex-row">
    <a href="{{ route('courses') }}" data-ripple class="btn-primary">Mulai Belajar Sekarang <span aria-hidden="true">→</span></a>
    <a href="{{ route('subscription') }}" class="btn-secondary">Lihat Paket Free &amp; Pro</a>
  </div>
</div>
@endsection
