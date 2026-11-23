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
        'duration' => '± 25 menit',
        'intro' => 'Tata letak (layout) adalah cara elemen-elemen di layar disusun: posisi, ukuran, jarak, dan urutannya. Tata letak yang baik membuat pengguna langsung tahu harus melihat ke mana dan melakukan apa.',
        'before' => 'Semua elemen berukuran sama, jarak acak, tidak jelas mana yang utama.',
        'after' => 'Ada hierarki jelas, elemen sejajar pada grid, dan jarak yang konsisten.',
        'sections' => [
            [
                'title' => '1. Apa itu tata letak yang baik?',
                'body' => [
                    'Tujuan tata letak bukan membuat layar terlihat ramai, melainkan membantu pengguna menyelesaikan tugasnya. Pengguna biasanya memindai (scan) halaman, bukan membacanya kata demi kata.',
                    'Tata letak yang baik punya tiga ciri: urutan perhatian yang jelas, elemen yang sejajar dan teratur, serta ruang yang cukup untuk bernapas.',
                ],
                'tip' => 'Coba picingkan mata pada desain Anda. Elemen yang masih terlihat jelas adalah yang paling menonjol.',
            ],
            [
                'title' => '2. Hierarki visual',
                'body' => [
                    'Hierarki visual mengatur mana yang dilihat pertama, kedua, dan seterusnya. Alat utamanya adalah ukuran, kontras, warna, dan posisi.',
                    'Elemen terpenting, misalnya judul atau tombol utama (call to action), dibuat paling menonjol. Elemen pendukung dibuat lebih tenang. Jika semuanya menonjol, tidak ada yang menonjol.',
                ],
                'tip' => 'Satu layar sebaiknya punya satu aksi utama.',
            ],
            [
                'title' => '3. Grid dan keselarasan',
                'body' => [
                    'Grid adalah kerangka kolom dan baris tak terlihat yang menjaga semua elemen sejajar. Grid 12 kolom populer karena mudah dibagi 2, 3, 4, dan 6.',
                    'Keselarasan (alignment) membuat desain tampak profesional. Pastikan tepi kiri teks, gambar, dan tombol berada pada garis yang sama.',
                ],
                'tip' => 'Untuk paragraf panjang, gunakan teks rata kiri. Rata tengah hanya cocok untuk teks pendek seperti judul.',
            ],
            [
                'title' => '4. Jarak dan white space',
                'body' => [
                    'White space (ruang kosong) adalah area tanpa konten di antara elemen. Ia bukan ruang terbuang, melainkan alat untuk memisahkan dan mengelompokkan.',
                    'Gunakan skala jarak yang konsisten, misalnya kelipatan 8px: 8, 16, 24, 32, 48. Prinsip kedekatan (proximity) berkata: elemen yang berhubungan didekatkan, elemen yang tidak berhubungan dijauhkan.',
                ],
                'tip' => 'Jarak antar kelompok sebaiknya lebih besar daripada jarak di dalam kelompok.',
            ],
            [
                'title' => '5. Responsif dan mobile-first',
                'body' => [
                    'Pengguna membuka situs dari ponsel, tablet, dan laptop. Tata letak harus menyesuaikan lebar layar, misalnya tiga kolom di laptop menjadi satu kolom di ponsel.',
                    'Pendekatan mobile-first berarti merancang layar kecil terlebih dahulu, lalu menambahkan kelonggaran untuk layar besar. Ini memaksa Anda memilih konten yang benar-benar penting.',
                ],
                'tip' => 'Area sentuh tombol minimal sekitar 44 x 44 px agar mudah ditekan jari.',
            ],
        ],
        'faq' => [
            ['q' => 'Apakah saya harus memakai grid 12 kolom?', 'a' => 'Tidak harus. Grid 12 kolom hanya yang paling umum dan fleksibel. Yang penting adalah konsistensi: pilih satu sistem dan pakai di seluruh halaman.'],
            ['q' => 'Berapa banyak white space yang ideal?', 'a' => 'Tidak ada angka pasti. Jika elemen terasa berdesakan atau sulit dibedakan kelompoknya, tambahkan ruang. Mulailah dari skala 8px dan sesuaikan dengan mata Anda.'],
            ['q' => 'Apa beda tata letak dengan desain visual?', 'a' => 'Tata letak mengatur struktur dan posisi elemen. Desain visual mencakup tampilan seperti warna, gaya, dan ilustrasi. Tata letak yang kuat membuat desain visual lebih efektif.'],
            ['q' => 'Perlu alat apa untuk berlatih?', 'a' => 'Cukup alat desain gratis seperti Figma. Fitur Auto Layout dan layout grid-nya sangat membantu pemula.'],
        ],
        'questions' => [
            ['level' => 'mudah', 'q' => 'Apa tujuan utama tata letak dalam desain UI?', 'options' => ['Membuat layar terlihat penuh', 'Membantu pengguna memahami dan memakai antarmuka dengan mudah', 'Memamerkan sebanyak mungkin fitur', 'Menghemat penggunaan warna'], 'answer' => 1, 'why' => 'Tata letak ada untuk membantu pengguna menyelesaikan tugas, bukan sekadar mengisi ruang.'],
            ['level' => 'mudah', 'q' => 'Ruang kosong di antara elemen desain disebut?', 'options' => ['Bleed', 'White space', 'Gradient', 'Overlay'], 'answer' => 1, 'why' => 'White space (negative space) membantu memisahkan elemen dan memberi ruang bernapas.'],
            ['level' => 'mudah', 'q' => 'Elemen yang paling penting di halaman sebaiknya dibuat bagaimana?', 'options' => ['Paling kecil agar rapi', 'Sama persis dengan elemen lain', 'Lebih menonjol lewat ukuran, kontras, atau posisi', 'Disembunyikan di footer'], 'answer' => 2, 'why' => 'Hierarki visual mengarahkan mata ke elemen yang paling penting terlebih dahulu.'],
            ['level' => 'mudah', 'q' => 'Apa manfaat utama memakai grid?', 'options' => ['Menjaga keselarasan dan konsistensi elemen', 'Membuat file desain lebih kecil', 'Menambah animasi otomatis', 'Mengganti kebutuhan akan warna'], 'answer' => 0, 'why' => 'Grid adalah kerangka yang membuat elemen sejajar dan teratur.'],
            ['level' => 'mudah', 'q' => 'Untuk paragraf teks yang panjang, perataan yang paling nyaman dibaca adalah?', 'options' => ['Rata tengah', 'Rata kanan', 'Rata kiri', 'Rata kiri-kanan dengan jarak huruf lebar'], 'answer' => 2, 'why' => 'Mata terbiasa kembali ke tepi kiri yang konsisten saat berpindah baris.'],
            ['level' => 'sedang', 'q' => 'Menurut prinsip kedekatan (proximity), dua elemen yang saling berhubungan sebaiknya diletakkan?', 'options' => ['Berjauhan agar tidak membingungkan', 'Berdekatan sehingga terbaca sebagai satu kelompok', 'Di sisi layar yang berseberangan', 'Dengan warna yang sama saja, jarak tidak penting'], 'answer' => 1, 'why' => 'Jarak yang dekat memberi sinyal bahwa elemen-elemen itu satu kelompok.'],
            ['level' => 'sedang', 'q' => 'Manakah rangkaian jarak yang konsisten pada skala kelipatan 8px?', 'options' => ['5, 11, 17, 29', '8, 16, 24, 32', '10, 15, 22, 35', '7, 14, 21, 27'], 'answer' => 1, 'why' => 'Skala kelipatan 8px (8, 16, 24, 32) membuat jarak seragam dan mudah dipakai ulang.'],
            ['level' => 'sedang', 'q' => 'Halaman landing memiliki tiga tombol dengan ukuran dan warna yang sama persis. Masalah utamanya?', 'options' => ['Tombol terlalu sedikit', 'Aksi utama tidak jelas karena hierarki tidak dibedakan', 'Warna tombol harus selalu merah', 'Tombol sebaiknya tidak boleh lebih dari satu'], 'answer' => 1, 'why' => 'Tanpa hierarki, pengguna tidak tahu aksi mana yang paling diharapkan. Bedakan tombol utama dan sekunder.'],
            ['level' => 'sedang', 'q' => 'Apa arti pendekatan mobile-first?', 'options' => ['Hanya membuat versi ponsel', 'Merancang layar kecil dulu, lalu memperluas untuk layar besar', 'Mengutamakan aplikasi dibanding situs web', 'Menyembunyikan konten di layar besar'], 'answer' => 1, 'why' => 'Mulai dari layar kecil memaksa Anda memprioritaskan konten yang paling penting.'],
            ['level' => 'sedang', 'q' => 'Pada formulir di layar sempit, penempatan label yang umumnya paling mudah dipakai adalah?', 'options' => ['Di atas kolom isian', 'Di dalam kolom saja sebagai placeholder dan hilang saat mengetik', 'Di sisi kanan layar', 'Dihilangkan agar ringkas'], 'answer' => 0, 'why' => 'Label di atas kolom tetap terlihat, hemat lebar, dan mudah dibaca di layar sempit.'],
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
