<?php

/*
 * Konten kursus UIlearn. Tiga topik, masing-masing berisi:
 * materi (sections), faq, dan 10 soal latihan (5 mudah lalu 5 sedang).
 * 'answer' adalah indeks opsi yang benar (mulai dari 0).
 */

return [

    'tata-letak' => [
        'title' => 'Tata Letak',
        'icon' => '▦',
        'tagline' => 'Susun elemen agar mudah dipahami dan nyaman dipakai.',
        'duration' => '± 30 menit',
        'intro' => 'Tata letak (layout) adalah cara elemen-elemen di layar disusun: posisi, ukuran, proporsi, jarak, dan urutannya. Desain yang baik bersifat jelas, intuitif, menjaga keterbacaan optimal 60-80 karakter, dan seimbang secara struktural.',
        'before' => 'Semua elemen berukuran sama, jarak acak, tidak proporsional, dan sulit dipindai.',
        'after' => 'Harmonis dengan Golden Ratio (1:1,618), Rule of Thirds (fokus kiri atas), dan baris teks 60-80 karakter.',
        'sections' => [
            [
                'title' => '1. Ciri Desain Web yang Baik',
                'body' => [
                    'Jelas dan intuitif: Desain yang efektif tidak harus selalu penuh warna atau terlihat cantik, melainkan mudah dipahami dan memberikan rasa keteraturan serta kenyamanan alami bagi pengunjung.',
                    'Keterbacaan optimal: Ukuran tata letak yang proporsional akan membantu menjaga panjang baris teks tetap ideal, yaitu sekitar 60 hingga 80 karakter per baris, sehingga nyaman dibaca dan tidak melelahkan mata.',
                    'Keseimbangan struktural: Meskipun tidak selalu mengikuti rasio matematis secara kaku, tata letak yang menjaga proporsi konsisten antara blok utama dan ruang kosong di sekitarnya akan terasa seimbang dan rapi.',
                ],
                'tip' => 'Desain yang baik berfokus pada kejelasan fungsi dan kenyamanan membaca, bukan sekadar dekorasi visual.',
            ],
            [
                'title' => '2. Penerapan Divine Proportion (Golden Ratio)',
                'body' => [
                    'Prinsip ini menggunakan rasio 1 : 1,618 (sering dibulatkan menjadi 1,62 atau rasio cepat 5 : 3) untuk menentukan ukuran elemen tata letak agar terasa harmonis secara alami.',
                    'Cara menghitung lebar kolom: Bagi total lebar tata letak dengan 1,62 untuk mendapatkan ukuran area konten utama, lalu sisanya digunakan untuk sidebar.',
                    'Contoh pada lebar 960px: Lebar konten utama adalah 960px / 1,62 ≈ 593px, dan sisa lebar untuk sidebar adalah 960px - 593px = 367px.',
                    'Alat bantu yang direkomendasikan: Phiculator (https://www.thismanslife.co.uk/phiculator) dan Golden Section Ratio Design Tool (https://www.atrise.com/golden-section/) untuk menghitung ukuran proporsional secara otomatis.',
                ],
                'tip' => 'Untuk tata letak cepat 2 kolom, gunakan perbandingan 5 : 3 (atau ~62% untuk konten utama dan ~38% untuk sidebar).',
            ],
            [
                'title' => '3. Penerapan Rule of Thirds',
                'body' => [
                    'Aturan ini adalah versi sederhana dari Golden Ratio untuk menonjolkan elemen terpenting tanpa perlu banyak perhitungan rumit.',
                    'Membagi bidang menjadi 9 bagian: Tarik dua garis horizontal dan dua garis vertikal dengan jarak yang sama pada area tata letak.',
                    'Menempatkan elemen kunci: Letakkan pesan utama, navigasi penting, atau fitur unggulan di empat titik perpotongan garis tersebut.',
                    'Fokus pada sudut kiri atas: Titik potong di bagian kiri atas merupakan area terkuat karena pengguna cenderung memindai halaman web mengikuti pola huruf "F".',
                ],
                'tip' => 'Letakkan logo, headline utama, dan CTA terpenting di dekat titik potong kiri atas untuk tangkapan perhatian maksimal.',
            ],
            [
                'title' => '4. Hierarki Visual dan Keselarasan Grid',
                'body' => [
                    'Hierarki visual mengatur mana yang dilihat pertama, kedua, dan seterusnya melalui kontras ukuran, ketebalan, dan warna.',
                    'Grid (seperti grid 12 kolom atau grid 3 kolom Rule of Thirds) adalah kerangka tak terlihat yang menjaga semua elemen sejajar dan terstruktur rapi.',
                ],
                'tip' => 'Pastikan tepi kiri elemen sejajar pada grid untuk memperkuat pola pemindaian mata pembaca.',
            ],
            [
                'title' => '5. Jarak, White Space, dan Responsif',
                'body' => [
                    'White space (ruang kosong) bukan ruang terbuang, melainkan alat untuk memberi ruang bernapas dan menyeimbangkan blok utama konten.',
                    'Gunakan skala jarak konsisten (misalnya kelipatan 8px: 8, 16, 24, 32, 48px). Pada layar ponsel, tata letak proporsional Golden Ratio menyesuaikan menjadi 1 kolom vertikal (mobile-first).',
                ],
                'tip' => 'Jarak antar kelompok selalu lebih besar daripada jarak di dalam satu kelompok konten.',
            ],
        ],
        'faq' => [
            ['q' => 'Mengapa panjang baris teks dibatasi 60 hingga 80 karakter?', 'a' => 'Jika baris terlalu panjang (lebih dari 80 karakter), mata pembaca kesulitan melompat kembali ke baris berikutnya. Jika terlalu pendek (kurang dari 45 karakter), ritme membaca terputus-putus. Rentang 60-80 karakter terbukti paling optimal.'],
            ['q' => 'Bagaimana cara cepat menerapkan Golden Ratio pada CSS?', 'a' => 'Gunakan grid CSS dengan perbandingan fraksi 1.618fr 1fr (atau rasio 5:3 / 62% dan 38%). Total lebar dibagi 1.62 untuk konten utama, sisanya untuk sidebar.'],
            ['q' => 'Apa keuntungan Rule of Thirds dibanding Golden Ratio?', 'a' => 'Rule of Thirds adalah aproksimasi cepat dari Golden Ratio. Cukup bagi bidang jadi 3x3 dan letakkan elemen kunci di 4 titik perpotongan, khususnya sudut kiri atas mengikuti pola F-pattern.'],
            ['q' => 'Alat bantu apa yang bisa dipakai untuk menghitung Golden Ratio?', 'a' => 'Gunakan Phiculator atau Golden Section Ratio Design Tool untuk menghitung ukuran proporsional secara presisi dan instan.'],
        ],
        'questions' => [
            ['level' => 'mudah', 'q' => 'Berapa rasio matematis yang digunakan pada Divine Proportion (Golden Ratio)?', 'options' => ['1 : 1,414', '1 : 1,618 (atau dibulatkan 1,62 / 5 : 3)', '1 : 2,000', '1 : 3,141'], 'answer' => 1, 'why' => 'Divine Proportion (Golden Ratio) menggunakan rasio 1 : 1,618 (atau pembulatan 1,62 / rasio cepat 5:3) untuk menghasilkan proporsi alami.'],
            ['level' => 'mudah', 'q' => 'Berapa panjang baris teks yang ideal untuk menjaga keterbacaan optimal?', 'options' => ['10 hingga 25 karakter', '30 hingga 40 karakter', '60 hingga 80 karakter per baris', '120 hingga 150 karakter'], 'answer' => 2, 'why' => 'Panjang 60 hingga 80 karakter per baris menjaga ritme membaca tetap nyaman dan tidak membuat mata lelah.'],
            ['level' => 'mudah', 'q' => 'Pada Rule of Thirds, bidang tata letak dibagi menjadi berapa bagian sama besar?', 'options' => ['4 bagian', '6 bagian', '9 bagian (3x3)', '12 bagian'], 'answer' => 2, 'why' => 'Rule of Thirds membagi bidang menjadi 9 bagian dengan 2 garis horizontal dan 2 garis vertikal berjarak sama.'],
            ['level' => 'mudah', 'q' => 'Pada Rule of Thirds, titik perpotongan mana yang merupakan area terkuat bagi pandangan mata?', 'options' => ['Sudut kanan bawah', 'Sudut kiri atas (mengikuti pola huruf F)', 'Tepat di tengah layar', 'Sudut kanan atas'], 'answer' => 1, 'why' => 'Titik potong kiri atas adalah area terkuat karena mata pengguna cenderung memindai halaman mengikuti pola huruf F.'],
            ['level' => 'mudah', 'q' => 'Ruang kosong di sekitar blok utama yang menjaga keseimbangan struktural disebut?', 'options' => ['Negative space / White space', 'Bleed', 'Drop shadow', 'Gradient'], 'answer' => 0, 'why' => 'White space menjaga proporsi seimbang antara blok konten utama dan area sekitarnya.'],
            ['level' => 'sedang', 'q' => 'Pada lebar tata letak 960px, berapa ukuran konten utama jika dihitung dengan rasio 1,62?', 'options' => ['480px', '593px (960px / 1,62)', '720px', '367px'], 'answer' => 1, 'why' => 'Total lebar dibagi 1,62: 960px / 1,62 ≈ 593px untuk konten utama, sisanya 367px untuk sidebar.'],
            ['level' => 'sedang', 'q' => 'Jika area konten utama selebar 593px pada total layout 960px, berapakah sisa lebar untuk sidebar?', 'options' => ['250px', '300px', '367px', '420px'], 'answer' => 2, 'why' => 'Sisa lebar sidebar dihitung dari total dikurangi konten utama: 960px - 593px = 367px.'],
            ['level' => 'sedang', 'q' => 'Manakah dua alat bantu yang direkomendasikan untuk menghitung ukuran proporsional Golden Ratio otomatis?', 'options' => ['Phiculator dan Golden Section Ratio Design Tool', 'Photoshop dan Notepad', 'Excel dan Calculator Windows', 'Canva dan Word'], 'answer' => 0, 'why' => 'Phiculator dan Golden Section Ratio Design Tool adalah alat bantu populer untuk menghitung Golden Ratio secara otomatis.'],
            ['level' => 'sedang', 'q' => 'Apa ciri utama desain web yang efektif dan baik?', 'options' => ['Selalu penuh warna dan banyak animasi bergerak', 'Jelas dan intuitif, mudah dipahami, serta memberi rasa keteraturan', 'Memuat sebanyak mungkin teks dalam satu baris penuh', 'Menggunakan font berbeda di setiap paragraf'], 'answer' => 1, 'why' => 'Desain yang efektif tidak harus selalu penuh warna atau ramai, melainkan jelas, intuitif, dan teratur.'],
            ['level' => 'sedang', 'q' => 'Di manakah sebaiknya menempatkan pesan utama, navigasi penting, atau fitur unggulan pada Rule of Thirds?', 'options' => ['Di area pinggir layar paling bawah', 'Di empat titik perpotongan garis pemisah bidang', 'Di belakang latar belakang', 'Secara acak tanpa pola'], 'answer' => 1, 'why' => 'Empat titik perpotongan garis Rule of Thirds adalah area kekuatan visual untuk menempatkan elemen kunci.'],
        ],
    ],

    'warna' => [
        'title' => 'Warna',
        'icon' => '◐',
        'tagline' => 'Pilih dan padukan warna agar menarik sekaligus mudah dibaca.',
        'duration' => '± 25 menit',
        'intro' => 'Warna memengaruhi perasaan, perhatian, dan keterbacaan. Memilih warna bukan soal selera semata, ada prinsip yang bisa dipelajari dan diterapkan secara bertahap.',
        'before' => 'Banyak warna terang bersaing, teks abu muda di latar putih, tombol sulit dikenali.',
        'after' => 'Palet terbatas, satu warna aksen jelas, dan teks berkontras cukup.',
        'sections' => [
            [
                'title' => '1. Dasar warna: hue, saturation, brightness',
                'body' => [
                    'Setiap warna bisa dijelaskan dengan tiga atribut: hue (jenis warna, misalnya biru atau merah), saturation (seberapa pekat), dan brightness (seberapa terang).',
                    'Dengan mengubah saturation dan brightness dari satu hue, Anda bisa membuat banyak variasi yang tetap selaras.',
                ],
                'tip' => 'Mulai dari satu hue utama, lalu buat versi lebih terang dan lebih gelap darinya.',
            ],
            [
                'title' => '2. Membangun palet warna',
                'body' => [
                    'Aturan 60-30-10 adalah titik awal yang aman: 60% warna dominan (sering netral, untuk latar), 30% warna sekunder, dan 10% warna aksen untuk tombol utama atau penekanan.',
                    'Skema yang umum dipakai: monokromatik (satu hue), analogus (hue bersebelahan di roda warna, terasa tenang), dan komplementer (hue berseberangan, terasa kontras dan energik).',
                ],
                'tip' => 'Batasi palet: satu warna utama, satu aksen, dan beberapa netral sudah cukup untuk sebagian besar produk.',
            ],
            [
                'title' => '3. Kontras dan aksesibilitas',
                'body' => [
                    'Teks harus terbaca jelas di atas latarnya. Pedoman WCAG AA menetapkan rasio kontras minimal 4,5:1 untuk teks biasa dan 3:1 untuk teks besar.',
                    'Jangan hanya mengandalkan warna untuk menyampaikan informasi. Sebagian pengguna tidak dapat membedakan warna tertentu, jadi tambahkan ikon atau teks, misalnya pada pesan error.',
                ],
                'tip' => 'Gunakan alat pemeriksa kontras sebelum finalisasi desain.',
            ],
            [
                'title' => '4. Makna, konsistensi, dan mode gelap',
                'body' => [
                    'Warna membawa makna: merah sering berarti bahaya atau error, hijau berarti berhasil, kuning berarti peringatan. Pakai makna itu secara konsisten di seluruh produk.',
                    'Pada mode gelap, hindari hitam pekat dan putih murni. Gunakan latar abu gelap, teks putih lembut, dan kurangi saturasi agar tidak menyilaukan mata.',
                ],
                'tip' => 'Tentukan warna sebagai variabel (token) sehingga mudah diganti untuk mode terang dan gelap.',
            ],
        ],
        'faq' => [
            ['q' => 'Saya tidak punya selera warna, bagaimana memulai?', 'a' => 'Mulai dari palet yang sudah teruji (misalnya dari Coolors atau palet bawaan Tailwind), lalu terapkan aturan 60-30-10. Selera terlatih lewat praktik.'],
            ['q' => 'Berapa warna maksimal yang boleh dipakai?', 'a' => 'Tidak ada batas mutlak, tetapi untuk pemula, satu warna utama, satu aksen, dan beberapa netral sudah cukup dan lebih mudah dijaga konsistensinya.'],
            ['q' => 'Apakah hitam dan putih termasuk warna?', 'a' => 'Dalam desain UI, keduanya dan abu-abu disebut warna netral. Netral sangat penting untuk latar, teks, dan garis pembatas.'],
            ['q' => 'Bagaimana cara mengecek kontras?', 'a' => 'Gunakan alat pemeriksa kontras (misalnya plugin kontras di Figma atau situs pemeriksa WCAG). Masukkan warna teks dan latar, lalu lihat rasionya.'],
        ],
        'questions' => [
            ['level' => 'mudah', 'q' => 'Tiga atribut dasar warna dalam model HSB adalah?', 'options' => ['Hue, saturation, brightness', 'Red, green, blue', 'Cyan, magenta, yellow', 'Tint, tone, texture'], 'answer' => 0, 'why' => 'HSB = Hue (jenis warna), Saturation (kepekatan), Brightness (keterangan).'],
            ['level' => 'mudah', 'q' => 'Dalam aturan 60-30-10, angka 10 merujuk pada?', 'options' => ['Warna dominan', 'Warna sekunder', 'Warna aksen', 'Jumlah font'], 'answer' => 2, 'why' => '10% dipakai untuk aksen, misalnya tombol utama atau penekanan penting.'],
            ['level' => 'mudah', 'q' => 'Warna komplementer adalah warna yang?', 'options' => ['Bersebelahan di roda warna', 'Berseberangan di roda warna', 'Sama-sama abu-abu', 'Selalu hangat'], 'answer' => 1, 'why' => 'Komplementer berada berseberangan di roda warna dan menghasilkan kontras kuat.'],
            ['level' => 'mudah', 'q' => 'Manakah yang termasuk kelompok warna hangat?', 'options' => ['Biru, hijau, ungu', 'Merah, oranye, kuning', 'Abu-abu, hitam, putih', 'Biru tua, nila, toska'], 'answer' => 1, 'why' => 'Merah, oranye, dan kuning dikenal sebagai warna hangat.'],
            ['level' => 'mudah', 'q' => 'Mengapa sebaiknya tidak memakai terlalu banyak warna pada satu desain?', 'options' => ['Karena warna mahal', 'Karena membingungkan dan sulit dijaga konsistensinya', 'Karena layar tidak mampu menampilkannya', 'Karena hanya boleh satu warna'], 'answer' => 1, 'why' => 'Terlalu banyak warna bersaing merebut perhatian dan membuat desain tidak konsisten.'],
            ['level' => 'sedang', 'q' => 'Berapa rasio kontras minimal WCAG AA untuk teks biasa?', 'options' => ['2:1', '3:1', '4,5:1', '10:1'], 'answer' => 2, 'why' => 'WCAG AA mensyaratkan 4,5:1 untuk teks biasa dan 3:1 untuk teks besar.'],
            ['level' => 'sedang', 'q' => 'Pesan error hanya ditandai dengan warna merah, tanpa ikon atau teks penjelas. Apa masalahnya?', 'options' => ['Merah tidak boleh dipakai untuk error', 'Pengguna yang sulit membedakan warna bisa melewatkan informasinya', 'Pesan error harus selalu biru', 'Tidak ada masalah'], 'answer' => 1, 'why' => 'Informasi penting jangan hanya mengandalkan warna. Tambahkan ikon atau teks.'],
            ['level' => 'sedang', 'q' => 'Skema warna analogus memakai warna yang?', 'options' => ['Berseberangan di roda warna', 'Bersebelahan di roda warna sehingga terasa harmonis', 'Semuanya sangat pekat', 'Dipilih acak'], 'answer' => 1, 'why' => 'Warna bersebelahan menghasilkan kesan tenang dan menyatu.'],
            ['level' => 'sedang', 'q' => 'Praktik yang baik untuk mode gelap adalah?', 'options' => ['Hitam pekat dengan putih murni dan warna sangat jenuh', 'Latar abu gelap, teks putih lembut, saturasi dikurangi', 'Memakai warna terang yang sama persis dengan mode terang', 'Menghilangkan semua warna aksen'], 'answer' => 1, 'why' => 'Kontras ekstrem dan warna terlalu jenuh membuat mata lelah di mode gelap.'],
            ['level' => 'sedang', 'q' => 'Teks abu muda (#BBBBBB) di atas latar putih memiliki rasio kontras sekitar 1,9:1. Kesimpulannya?', 'options' => ['Sudah lolos WCAG AA', 'Terlalu rendah, teks sulit dibaca dan perlu digelapkan', 'Cocok untuk teks isi utama', 'Hanya masalah di mode gelap'], 'answer' => 1, 'why' => '1,9:1 jauh di bawah batas 4,5:1, sehingga teks perlu dibuat lebih gelap.'],
        ],
    ],

    'typography' => [
        'title' => 'Typography',
        'icon' => 'Aa',
        'tagline' => 'Pilih dan atur huruf agar teks jelas, enak dibaca, dan berkarakter.',
        'duration' => '± 25 menit',
        'intro' => 'Sebagian besar antarmuka berisi teks. Typography adalah seni memilih dan mengatur huruf agar pesan tersampaikan dengan jelas, nyaman dibaca, dan sesuai karakter produk.',
        'before' => 'Banyak jenis font, ukuran seragam, baris sangat panjang dan rapat.',
        'after' => 'Satu atau dua font, hierarki ukuran jelas, baris lega dan nyaman dibaca.',
        'sections' => [
            [
                'title' => '1. Istilah dasar',
                'body' => [
                    'Serif adalah huruf berkait kecil di ujungnya (misalnya Times), sering terasa klasik dan formal. Sans-serif tanpa kait (misalnya Inter, Geist), terasa modern dan bersih di layar.',
                    'Selain jenis, ada ukuran (size), ketebalan (weight), tinggi baris (line-height), dan jarak antarhuruf (letter-spacing). Kombinasi inilah yang membentuk kesan teks.',
                ],
                'tip' => 'Untuk antarmuka digital, font sans-serif adalah pilihan aman bagi pemula.',
            ],
            [
                'title' => '2. Hierarki dan skala tipografi',
                'body' => [
                    'Hierarki tipografi menunjukkan urutan kepentingan: judul besar dan tebal, subjudul sedang, teks isi biasa. Bangun hierarki dengan ukuran dan ketebalan, bukan dengan menambah jenis font.',
                    'Skala tipografi (type scale) memakai rasio tetap antar ukuran, misalnya 1,25. Dari 16px menjadi 20px, 25px, dan 31px. Rasio yang konsisten membuat ukuran terasa harmonis.',
                ],
                'tip' => 'Batasi diri pada sekitar empat sampai enam ukuran font dalam satu produk.',
            ],
            [
                'title' => '3. Keterbacaan',
                'body' => [
                    'Ukuran teks isi di web sebaiknya sekitar 16px atau lebih. Tinggi baris yang nyaman untuk paragraf adalah 1,4 sampai 1,6 kali ukuran font.',
                    'Panjang baris ideal sekitar 45 sampai 75 karakter. Baris yang terlalu panjang membuat mata sulit menemukan awal baris berikutnya. Hindari paragraf panjang yang seluruhnya huruf kapital.',
                ],
                'tip' => 'Pastikan kontras teks cukup, lihat materi Warna.',
            ],
            [
                'title' => '4. Memasangkan font (font pairing)',
                'body' => [
                    'Cukup satu sampai dua jenis font. Pasangan klasik adalah font serif untuk judul dengan sans-serif untuk isi, atau satu keluarga font yang punya banyak ketebalan.',
                    'Pilih dua font yang jelas berbeda karakternya, bukan dua font yang mirip tapi tidak sama, karena perbedaan tipis terlihat seperti kesalahan.',
                ],
                'tip' => 'Jika ragu, pakai satu keluarga font dan variasikan weight serta ukuran.',
            ],
        ],
        'faq' => [
            ['q' => 'Dari mana saya bisa mendapatkan font gratis?', 'a' => 'Google Fonts adalah sumber paling populer dan bebas dipakai untuk proyek pribadi maupun komersial. Periksa selalu lisensi setiap font.'],
            ['q' => 'Berapa ukuran font minimum yang aman?', 'a' => 'Untuk teks isi di web, pakai sekitar 16px. Teks pendukung seperti keterangan boleh lebih kecil, tetapi usahakan tidak di bawah 12px dan tetap berkontras cukup.'],
            ['q' => 'Apakah boleh memakai lebih dari dua font?', 'a' => 'Boleh, tetapi sulit dikendalikan. Pemula lebih aman membatasi diri pada satu sampai dua font dan memainkan weight serta ukuran.'],
            ['q' => 'Apa beda font dan typeface?', 'a' => 'Typeface adalah rancangan keluarga huruf (misalnya Inter). Font adalah varian spesifiknya, seperti Inter Bold 16px. Dalam percakapan sehari-hari keduanya sering dipakai bergantian.'],
        ],
        'questions' => [
            ['level' => 'mudah', 'q' => 'Font tanpa kait di ujung hurufnya disebut?', 'options' => ['Serif', 'Sans-serif', 'Script', 'Monospace'], 'answer' => 1, 'why' => 'Sans-serif berarti tanpa serif (kait kecil di ujung huruf).'],
            ['level' => 'mudah', 'q' => 'Fungsi utama hierarki tipografi adalah?', 'options' => ['Memperbanyak jenis huruf', 'Menunjukkan urutan kepentingan teks', 'Menghemat memori', 'Menghilangkan judul'], 'answer' => 1, 'why' => 'Hierarki membantu pembaca tahu mana yang utama dan mana yang pendukung.'],
            ['level' => 'mudah', 'q' => 'Ukuran teks isi yang umum dan nyaman di web adalah sekitar?', 'options' => ['8px', '10px', '16px', '40px'], 'answer' => 2, 'why' => '16px adalah ukuran dasar yang nyaman dibaca di sebagian besar layar.'],
            ['level' => 'mudah', 'q' => 'Line-height pada tipografi berarti?', 'options' => ['Ketebalan huruf', 'Jarak antar baris teks', 'Lebar kolom', 'Jenis font'], 'answer' => 1, 'why' => 'Line-height (tinggi baris) mengatur kelegaan jarak antar baris.'],
            ['level' => 'mudah', 'q' => 'Untuk pemula, berapa jenis font yang sebaiknya dipakai dalam satu desain?', 'options' => ['Sebanyak mungkin', 'Satu sampai dua', 'Minimal lima', 'Sepuluh'], 'answer' => 1, 'why' => 'Terlalu banyak font membuat tampilan berantakan dan tidak konsisten.'],
            ['level' => 'sedang', 'q' => 'Panjang baris yang ideal untuk teks isi adalah sekitar?', 'options' => ['10 sampai 20 karakter', '45 sampai 75 karakter', '120 sampai 150 karakter', 'Tidak ada pengaruhnya'], 'answer' => 1, 'why' => 'Baris 45 sampai 75 karakter nyaman bagi mata, tidak terlalu pendek dan tidak terlalu panjang.'],
            ['level' => 'sedang', 'q' => 'Tinggi baris yang nyaman untuk paragraf umumnya?', 'options' => ['1,0 kali ukuran font', '1,4 sampai 1,6 kali ukuran font', '3 kali ukuran font', 'Selalu 0'], 'answer' => 1, 'why' => 'Rentang 1,4 sampai 1,6 memberi ruang cukup tanpa membuat baris terputus.'],
            ['level' => 'sedang', 'q' => 'Manakah pendekatan font pairing yang aman?', 'options' => ['Dua font serif yang mirip tetapi tidak sama', 'Serif untuk judul dan sans-serif untuk isi, atau satu keluarga dengan weight berbeda', 'Lima font berbeda agar kreatif', 'Font dekoratif untuk seluruh paragraf'], 'answer' => 1, 'why' => 'Kontras yang jelas atau satu keluarga yang konsisten menghasilkan tampilan harmonis.'],
            ['level' => 'sedang', 'q' => 'Mengapa paragraf panjang yang seluruhnya huruf kapital sebaiknya dihindari?', 'options' => ['Karena melanggar hukum', 'Karena bentuk kata menjadi seragam sehingga lebih lambat dibaca', 'Karena font kapital lebih mahal', 'Karena tidak bisa dicetak'], 'answer' => 1, 'why' => 'Huruf kapital membuat bentuk kata sama-sama kotak, sehingga membaca melambat.'],
            ['level' => 'sedang', 'q' => 'Skala tipografi dengan rasio 1,25 dan ukuran dasar 16px menghasilkan urutan?', 'options' => ['16, 20, 25, 31', '16, 17, 18, 19', '16, 32, 64, 128', '16, 18, 22, 40'], 'answer' => 0, 'why' => '16 x 1,25 = 20; 20 x 1,25 = 25; 25 x 1,25 = 31,25 (dibulatkan 31).'],
        ],
    ],
];
