<?php

return [
    'ai' => [
        'key' => env('ANTHROPIC_API_KEY'),
        'model' => env('UILEARN_AI_MODEL', 'claude-sonnet-5-5'),
        'max_tokens' => (int) env('UILEARN_AI_MAX_TOKENS', 900),
        'history' => 20,
    ],

    // Batas pesan AI per hari. null = tanpa batas.
    'plans' => [
        'free' => ['label' => 'Free', 'daily_ai_messages' => (int) env('UILEARN_FREE_DAILY_AI', 5), 'exercise_ai' => false],
        'pro' => ['label' => 'Pro', 'daily_ai_messages' => null, 'exercise_ai' => true],
    ],

    'price_pro' => 'Rp49.000 / bulan',

    // Pertanyaan preset untuk demo AI di Dashboard (tanpa login) dan chip di AI Chat.
    'presets' => [
        'kontras' => [
            'q' => 'Kenapa teks di desain saya susah dibaca?',
            'a' => "Penyebab paling umum adalah **kontras yang kurang** antara teks dan latar.\n\n- Targetkan rasio kontras minimal **4,5:1** untuk teks biasa (WCAG AA).\n- Hindari abu-abu muda di atas putih.\n- Naikkan ukuran font ke 16px atau lebih untuk teks isi.\n\nCoba uji warna Anda dengan alat pemeriksa kontras sebelum finalisasi.",
            'keywords' => ['kontras', 'susah dibaca', 'sulit dibaca', 'terbaca', 'readable', 'contrast'],
        ],
        'tata-letak' => [
            'q' => 'Bagaimana membuat tata letak terlihat rapi?',
            'a' => "Rapi itu soal **keteraturan**, bukan banyaknya hiasan.\n\n- Pakai grid (misalnya 12 kolom) supaya elemen sejajar.\n- Pakai jarak berskala, misalnya kelipatan 8px (8, 16, 24, 32).\n- Kelompokkan elemen yang berkaitan, beri ruang kosong di antara kelompok.\n\nRuang kosong (white space) bukan pemborosan, ia membantu mata beristirahat.",
            'keywords' => ['rapi', 'tata letak', 'layout', 'grid', 'sejajar', 'jarak', 'spasi', 'white space'],
        ],
        'warna' => [
            'q' => 'Bagaimana memilih palet warna untuk pemula?',
            'a' => "Mulai sederhana dengan aturan **60-30-10**.\n\n- 60% warna dominan (biasanya netral, untuk latar).\n- 30% warna sekunder (untuk area penting seperti kartu atau header).\n- 10% warna aksen (untuk tombol utama dan penekanan).\n\nPilih satu warna utama dulu, lalu turunkan variasinya (lebih terang dan lebih gelap) agar tetap harmonis.",
            'keywords' => ['palet', 'warna', 'color', 'kombinasi', '60-30-10', 'aksen'],
        ],
        'typography' => [
            'q' => 'Berapa jenis font yang sebaiknya dipakai?',
            'a' => "Cukup **satu sampai dua** jenis font.\n\n- Satu font untuk judul dan satu untuk isi, atau satu keluarga font dengan beberapa ketebalan.\n- Bangun hierarki lewat ukuran dan ketebalan, bukan lewat banyak font.\n- Tinggi baris (line-height) 1,4 sampai 1,6 membuat paragraf nyaman dibaca.",
            'keywords' => ['font', 'typography', 'tipografi', 'huruf', 'hierarki', 'line height', 'line-height'],
        ],
    ],

    'fallback_answer' => "Saya asisten UI/UX untuk pemula. Saya paling bisa membantu soal **tata letak**, **warna**, dan **typography**.\n\nCoba tanyakan hal seperti:\n- \"Bagaimana membuat tata letak terlihat rapi?\"\n- \"Bagaimana memilih palet warna?\"\n- \"Berapa font yang sebaiknya dipakai?\"\n- \"Kenapa teks saya susah dibaca?\"",
];
