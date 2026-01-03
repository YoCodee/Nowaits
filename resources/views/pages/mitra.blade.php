@extends('layouts.app')

@section('title', 'Mitra - NoWaits')

@section('content')
    @include('components.home.navbar')
<style>
    /* =========================================
       1. COLOR PALETTE & VARIABLES
       ========================================= */
    :root {
        --palet-dark: #082f25;
        --palet-olive: #9cab4a;
        --palet-light: #f4f4f4;
    }

    /* Wrapper Utama agar konten rapi di tengah */
    .mitra-wrapper {
        max-width: 1200px;
        margin: 0 auto;
        padding: 60px 20px 100px 20px;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    /* =========================================
       2. UI COMPONENTS (TYPOGRAPHY & BUTTONS)
       ========================================= */

    .text-center { text-align: center; }
    .mb-4 { margin-bottom: 1.5rem; }
    .mb-5 { margin-bottom: 3rem; }
    .mt-2 { margin-top: 0.5rem; }
    .mt-5 { margin-top: 3rem; }
    .pt-5 { padding-top: 3rem; }

    /* Judul Besar */
    .mitra-title {
        color: var(--palet-dark);
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
    }

    /* Sub-judul */
    .mitra-subtitle {
        color: #666;
        font-size: 1.1rem;
        line-height: 1.6;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Tombol Registrasi */
    .btn-mitra-register {
        background-color: var(--palet-dark);
        color: white;
        border-radius: 50px;
        padding: 14px 50px;
        font-weight: 700;
        text-decoration: none;
        display: inline-block;
        border: 2px solid var(--palet-dark);
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
        cursor: pointer;
    }
    .btn-mitra-register:hover {
        background-color: var(--palet-olive);
        border-color: var(--palet-olive);
        color: white;
        transform: translateY(-3px);
    }

    /* Gambar Hero (Bulat) */
    .hero-img-rounded {
        width: 100%;
        max-width: 900px;
        height: auto;
        border-radius: 50px; /* Sudut sangat bulat */
        box-shadow: 0 10px 30px rgba(0,0,0,0.15);
        display: block;
        margin: 0 auto;
    }

    /* =========================================
       3. GRID SYSTEM (PERBAIKAN UTAMA DI SINI)
       ========================================= */

    /* Grid untuk Fitur (2 Kolom x 2 Baris) */
    .mitra-grid-2col {
        display: grid;
        /* PAKSA JADI 2 KOLOM SAMA BESAR (1fr 1fr) */
        grid-template-columns: 1fr 1fr;
        gap: 30px;
        margin-bottom: 50px;
    }

    /* Grid untuk Info Bawah (3 Kolom) */
    .mitra-grid-3col {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
        margin-bottom: 50px;
    }

    /* Responsif untuk HP (Layar kecil jadi 1 kolom semua) */
    @media (max-width: 768px) {
        .mitra-grid-2col, .mitra-grid-3col {
            grid-template-columns: 1fr;
        }
        .hero-img-rounded {
            border-radius: 20px; /* Di HP radius dikecilkan dikit biar pas */
        }
    }

    /* =========================================
       4. FEATURE CARDS (KOTAK ATAS)
       ========================================= */
    .feature-box {
        background-color: #fff;
        border: 2px solid var(--palet-light);
        border-radius: 16px;
        padding: 40px 30px;
        text-align: center;
        transition: all 0.3s ease;
        height: 100%;
        box-sizing: border-box; /* Agar padding tidak merusak ukuran */
    }
    .feature-box:hover {
        border-color: var(--palet-olive);
        box-shadow: 0 15px 30px rgba(0,0,0,0.08);
        transform: translateY(-5px);
    }

    .icon-circle {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 32px;
        margin: 0 auto 20px auto;
        background-color: rgba(156, 171, 74, 0.15); /* Olive Transparan */
        color: var(--palet-dark);
    }
    .feature-title {
        color: var(--palet-dark);
        font-weight: 700;
        margin-bottom: 10px;
        font-size: 1.25rem;
        margin-top: 0;
    }
    .feature-desc {
        color: #777;
        font-size: 0.95rem;
        margin: 0;
        line-height: 1.5;
    }

    /* =========================================
       5. INFO CARDS (DETAIL BAWAH)
       ========================================= */
    .info-card {
        background-color: var(--palet-light);
        border-radius: 20px;
        padding: 40px;
        transition: 0.3s;
        height: 100%;
        box-sizing: border-box;
        border: 1px solid transparent;
    }
    .info-card:hover {
        background-color: #fff;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        border: 1px solid var(--palet-olive);
        transform: translateY(-5px);
    }
    .info-icon {
        font-size: 2.5rem;
        margin-bottom: 20px;
        display: block;
    }

    /* Checklist Style */
    .check-list {
        list-style: none;
        padding: 0;
        text-align: left;
        margin-top: 20px;
    }
    .check-list li {
        margin-bottom: 12px;
        color: #555;
        position: relative;
        padding-left: 28px;
        font-size: 0.95rem;
        line-height: 1.4;
    }
    .check-list li::before {
        content: "✔";
        color: var(--palet-olive);
        font-weight: 900;
        position: absolute;
        left: 0;
        top: 0;
    }

    /* Garis Pemisah */
    .divider {
        border-top: 1px solid #eee;
        margin: 80px 0;
    }
</style>

<div class="mitra-wrapper">

    {{-- BAGIAN 1: HERO SECTION --}}
    <div class="text-center mb-5">
        <h1 class="mitra-title">Mengapa Bermitra dengan Kami?</h1>
        <p class="mitra-subtitle mb-4">
            Akses langsung ke jaringan petani untuk mendapatkan buah <em>off-grade</em> berkualitas.
            Solusi cerdas menekan biaya produksi dan menyelamatkan lingkungan.
        </p>

        <a href="{{ url('/register') }}" class="btn-mitra-register mb-5">
            Registrasi Mitra
        </a>

        <div class="mt-2">
            <img src="{{ asset('images/buah_reject.jpg') }}"
                 class="hero-img-rounded"
                 alt="Buah reject">
        </div>
    </div>

    {{-- BAGIAN 2: GRID FITUR UTAMA (2 KOLOM) --}}
    <div class="mitra-grid-2col">

        <div class="feature-box">
            <div class="icon-circle">🔍</div>
            <h3 class="feature-title">Pencarian Spesifik</h3>
            <p class="feature-desc">Cari buah berdasarkan kriteria kerusakan yang bisa Anda terima.</p>
        </div>

        <div class="feature-box">
            <div class="icon-circle">🏷️</div>
            <h3 class="feature-title">Harga Hemat</h3>
            <p class="feature-desc">Dapatkan bahan baku dengan harga jauh di bawah pasar reguler.</p>
        </div>

        <div class="feature-box">
            <div class="icon-circle">🌱</div>
            <h3 class="feature-title">Lingkungan</h3>
            <p class="feature-desc">Kurangi limbah makanan dengan menyelamatkan buah dari pembusukan.</p>
        </div>

        <div class="feature-box">
            <div class="icon-circle">🛡️</div>
            <h3 class="feature-title">Terverifikasi</h3>
            <p class="feature-desc">Kualitas sortiran dan petani dijamin telah melalui proses verifikasi.</p>
        </div>
    </div>

    <div class="divider"></div>

    {{-- BAGIAN 3: INFO LEBIH LANJUT (3 KOLOM) --}}
    <div class="text-center pt-5">
        <h2 class="mitra-title" style="font-size: 2rem;">Keuntungan Eksklusif Mitra</h2>
        <p class="mitra-subtitle mb-5">
            Nilai tambah nyata yang akan dirasakan bisnis Anda saat bergabung dengan ekosistem No Waits.
        </p>

        <div class="mitra-grid-3col">

            <div class="info-card">
                <span class="info-icon">💰</span>
                <h3 class="feature-title">Efisiensi Biaya Produksi</h3>
                <p class="feature-desc">
                    Pangkas HPP produk Anda secara signifikan dengan beralih ke bahan baku off-grade.
                </p>
                <ul class="check-list">
                    <li>Harga <strong>lebih murah</strong> dari pasar.</li>
                    <li>Tanpa mark-up perantara.</li>
                    <li>Diskon volume kontrak rutin.</li>
                </ul>
            </div>

            <div class="info-card">
                <span class="info-icon">⚙️</span>
                <h3 class="feature-title">Kustomisasi Spesifikasi</h3>
                <p class="feature-desc">
                    "Rusak" menurut pasar belum tentu rusak bagi mesin Anda. Tentukan standar sendiri.
                </p>
                <ul class="check-list">
                    <li>Pilih jenis cacat (Visual vs Bentuk).</li>
                    <li>Request tingkat kematangan.</li>
                </ul>
            </div>

            <div class="info-card">
                <span class="info-icon">🌍</span>
                <h3 class="feature-title">Branding Keberlanjutan</h3>
                <p class="feature-desc">
                    Tingkatkan citra brand Anda di mata konsumen modern yang peduli lingkungan.
                </p>
                <ul class="check-list">
                    <li>Hak klaim "Upcycled Ingredients".</li>
                    <li>Laporan dampak lingkungan (ESG).</li>
                    <li>Kontribusi kesejahteraan petani.</li>
                </ul>
            </div>

        </div>

        <div class="text-center mt-5">
            <p class="mitra-subtitle" style="font-weight: bold; margin-bottom: 20px;">
                Siap mengoptimalkan biaya produksi Anda?
            </p>
            <a href="{{ url('/register') }}" class="btn-mitra-register">
                Daftar Sekarang
            </a>
        </div>
    </div>

</div>

@endsection
