<!DOCTYPE html>
<html lang="id">
  <head>
    <script>document.documentElement.classList.add('js')</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Layanan &amp; Reservasi &mdash; Amanails Nail Bar</title>
    <meta name="description" content="Reservasi online cepat dan mudah di Amanails Nail Bar.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400;1,9..144,500&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
      /* Layout 2 kolom yang proporsional: sisi kiri ringkasan tidak terlalu besar */
      .lq-booking-grid-custom {
        display: grid;
        grid-template-columns: 380px 1fr;
        background: #fff;
        border-radius: var(--lq-radius-lg);
        box-shadow: var(--lq-shadow);
        overflow: hidden;
      }
      @media (max-width: 991px) {
        .lq-booking-grid-custom {
          grid-template-columns: 1fr;
        }
      }

      /* Panel Kiri: Ringkasan Pemesanan */
      .lq-summary-panel {
        background: var(--lq-plum);
        color: #fff;
        padding: 2.25rem 1.85rem;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        gap: 1.5rem;
      }

      .lq-summary-thumb {
        position: relative;
        width: 100%;
        height: 140px;
        border-radius: var(--lq-radius);
        overflow: hidden;
        border: 1px solid rgba(255, 255, 255, 0.15);
      }
      .lq-summary-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .lq-summary-item {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding: 0.5rem 0;
        border-bottom: 1px dashed rgba(255, 255, 255, 0.18);
        font-size: 0.85rem;
      }
      .lq-summary-item:last-child {
        border-bottom: none;
      }
      .lq-summary-item .label {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.8rem;
      }
      .lq-summary-item .val {
        color: #fff;
        font-weight: 500;
        text-align: right;
        max-width: 60%;
      }

      /* Kartu Payment Split (DP 50k & Sisa Pelunasan) */
      .lq-dp-card {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: var(--lq-radius);
        padding: 1rem 1.15rem;
        margin-top: 1rem;
      }
      .lq-dp-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.35rem;
      }
      .lq-dp-row:last-child {
        margin-bottom: 0;
      }

      /* Pilihan Kategori Layanan Card & Radio */
      .lq-section-title {
        font-family: var(--lq-serif);
        font-size: 1.1rem;
        color: var(--lq-plum);
        margin: 1.5rem 0 0.75rem 0;
        padding-bottom: 0.35rem;
        border-bottom: 2px solid var(--lq-blush);
        display: flex;
        align-items: center;
        gap: 0.5rem;
      }
      .lq-section-title:first-of-type {
        margin-top: 0;
      }

      .lq-service-card-select {
        background: #fbf8f7;
        border: 1px solid var(--lq-line);
        border-radius: var(--lq-radius);
        padding: 0.75rem 1rem;
        margin-bottom: 0.5rem;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
      .lq-service-card-select:hover {
        border-color: var(--lq-rose);
        background: #fff;
      }
      .lq-service-card-select.is-selected {
        border-color: var(--lq-rose-deep);
        background: #fff;
        box-shadow: 0 2px 8px rgba(139, 58, 86, 0.12);
      }
      .lq-service-card-select input[type="radio"] {
        accent-color: var(--lq-rose-deep);
      }

      /* Tab Pilihan Desain (Katalog vs Request Sendiri) */
      .lq-design-tabs {
        display: flex;
        gap: 0.5rem;
        background: #f0e6e4;
        padding: 4px;
        border-radius: var(--lq-radius);
        margin-bottom: 1rem;
      }
      .lq-design-tab-btn {
        flex: 1;
        padding: 0.6rem 0.75rem;
        font-size: 0.85rem;
        font-weight: 500;
        border: none;
        background: transparent;
        color: var(--lq-mauve);
        border-radius: calc(var(--lq-radius) - 2px);
        cursor: pointer;
        transition: all 0.2s ease;
        text-align: center;
      }
      .lq-design-tab-btn.is-active {
        background: #fff;
        color: var(--lq-plum);
        font-weight: 600;
        box-shadow: 0 2px 6px rgba(60, 27, 44, 0.08);
      }

      /* Upload Desain Sendiri */
      .lq-upload-design-box {
        border: 2px dashed var(--lq-line);
        border-radius: var(--lq-radius);
        padding: 1.25rem;
        text-align: center;
        background: #faf7f6;
        cursor: pointer;
        transition: all 0.2s ease;
      }
      .lq-upload-design-box:hover {
        border-color: var(--lq-rose);
        background: #fff;
      }

      /* Nail Artist Bertugas - Card Informatif Tanpa Opsi Pilihan */
      .lq-artist-badge-card {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 0.9rem 1.15rem;
        background: #fbf7f5;
        border: 1px solid var(--lq-line);
        border-radius: var(--lq-radius);
      }
      .lq-artist-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        border: 2px solid var(--lq-rose);
        flex-shrink: 0;
      }
      .lq-artist-info {
        flex: 1;
      }
      .lq-artist-info h5 {
        font-family: var(--lq-serif);
        font-size: 1.05rem;
        margin: 0 0 0.15rem 0;
        color: var(--lq-plum);
        font-weight: 600;
      }
      .lq-artist-info p {
        font-size: 0.8rem;
        color: var(--lq-mauve);
        margin: 0;
        line-height: 1.35;
      }

      /* Kalender Pemilihan Tanggal */
      .amanails-calendar {
        background: #fff;
        border: 1px solid var(--lq-line);
        border-radius: var(--lq-radius);
        padding: 1.25rem;
        margin-top: 0.4rem;
      }
      .cal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
      }
      .cal-title {
        font-family: var(--lq-serif);
        font-size: 1.15rem;
        font-weight: 600;
        color: var(--lq-plum);
      }
      .cal-nav-btn {
        background: #f7ecea;
        border: 1px solid var(--lq-line);
        color: var(--lq-plum);
        border-radius: 50%;
        width: 32px;
        height: 32px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 1.1rem;
        transition: all 0.2s ease;
      }
      .cal-nav-btn:hover:not(:disabled) {
        background: var(--lq-rose-deep);
        color: #fff;
      }
      .cal-nav-btn:disabled {
        opacity: 0.35;
        cursor: not-allowed;
      }

      .cal-weekdays {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        text-align: center;
        font-size: 0.76rem;
        font-weight: 600;
        text-transform: uppercase;
        color: var(--lq-mauve);
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
      }

      .cal-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 6px;
      }

      .cal-cell {
        position: relative;
        min-height: 48px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        border: 1px solid transparent;
        background: #fff;
        font-size: 0.92rem;
        font-weight: 500;
        color: var(--lq-ink);
        cursor: pointer;
        transition: all 0.18s ease;
        user-select: none;
        padding: 4px 2px;
      }
      .cal-cell:hover:not(.is-disabled):not(.is-selected) {
        background: var(--lq-blush-soft);
        border-color: var(--lq-rose);
        color: var(--lq-rose-deep);
      }
      .cal-cell.is-selected {
        background: var(--lq-plum) !important;
        color: #fff !important;
        font-weight: 600;
        box-shadow: 0 4px 10px rgba(60, 27, 44, 0.25);
      }
      .cal-cell.is-selected .cal-subtext {
        color: var(--lq-gold-soft);
      }
      .cal-cell.is-today:not(.is-selected) {
        border-color: var(--lq-rose-deep);
        font-weight: 600;
      }
      .cal-cell.is-past {
        background: #f7f5f4;
        color: #c4b9b6;
        cursor: not-allowed;
        opacity: 0.65;
        text-decoration: none;
      }
      .cal-cell.is-full {
        background: #fdf1ef;
        color: #b58d88;
        cursor: not-allowed;
        border-color: #f3d4ce;
      }
      .cal-cell .cal-subtext {
        font-size: 0.62rem;
        line-height: 1;
        margin-top: 3px;
      }
      .cal-cell.is-full .cal-subtext {
        color: #c0392b;
        font-weight: 600;
      }
      .cal-cell-empty {
        min-height: 48px;
      }

      /* Legend Kalender */
      .cal-legend {
        display: flex;
        flex-wrap: wrap;
        gap: 1.25rem;
        font-size: 0.76rem;
        color: var(--lq-mauve);
        margin-top: 0.85rem;
        padding-top: 0.75rem;
        border-top: 1px dashed var(--lq-line);
      }
      .cal-legend-item {
        display: flex;
        align-items: center;
        gap: 0.4rem;
      }
      .cal-legend-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
      }

      /* Slot waktu */
      .lq-slot.is-booked {
        opacity: 0.45;
        background: #e6dedc;
        border-color: #d8cecc;
        cursor: not-allowed;
        text-decoration: line-through;
      }

      /* Tab Pilihan Metode Pembayaran */
      .lq-pay-tabs {
        display: flex;
        gap: 0.5rem;
        background: #f0e6e4;
        padding: 4px;
        border-radius: var(--lq-radius);
        margin-bottom: 1.25rem;
      }
      .lq-pay-tab-btn {
        flex: 1;
        padding: 0.65rem 0.75rem;
        font-size: 0.85rem;
        font-weight: 500;
        border: none;
        background: transparent;
        color: var(--lq-mauve);
        border-radius: calc(var(--lq-radius) - 2px);
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
      }
      .lq-pay-tab-btn.is-active {
        background: #fff;
        color: var(--lq-plum);
        font-weight: 600;
        box-shadow: 0 2px 6px rgba(60, 27, 44, 0.08);
      }

      /* QRIS Card */
      .lq-qris-card {
        background: #fff;
        border: 1px solid var(--lq-line);
        border-radius: var(--lq-radius);
        padding: 1.5rem 1.25rem;
        text-align: center;
      }
      .lq-qris-qr-box {
        background: #fff;
        display: inline-block;
        padding: 10px;
        border: 1px solid var(--lq-line);
        border-radius: var(--lq-radius);
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
        margin: 0.6rem 0;
      }

      /* Bank Account Cards */
      .lq-bank-card {
        background: #fff;
        border: 1px solid var(--lq-line);
        border-radius: var(--lq-radius);
        padding: 1rem 1.25rem;
        margin-bottom: 0.75rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }
      .lq-bank-badge {
        font-size: 0.75rem;
        font-weight: 700;
        padding: 3px 8px;
        border-radius: 4px;
        text-transform: uppercase;
        display: inline-block;
        margin-bottom: 0.25rem;
      }
      .lq-bank-badge-bca {
        background: #0060af;
        color: #fff;
      }
      .lq-bank-badge-mandiri {
        background: #003366;
        color: #f7a600;
      }
      .lq-bank-acc-num {
        font-family: monospace;
        font-size: 1.15rem;
        font-weight: 700;
        letter-spacing: 0.05em;
        color: var(--lq-ink);
      }

      /* Upload Dropzone */
      .lq-dropzone {
        border: 2px dashed var(--lq-line);
        border-radius: var(--lq-radius);
        padding: 1.25rem;
        text-align: center;
        background: #faf7f6;
        cursor: pointer;
        transition: all 0.2s ease;
      }
      .lq-dropzone:hover {
        border-color: var(--lq-rose);
        background: #fff;
      }
    </style>
  </head>
  <body>
    <a class="lq-skip" href="#main">Lewati ke konten utama</a>

    <!-- ===================== NAVBAR ===================== -->
    <header class="lq-nav is-scrolled" data-nav>
      <div class="container">
        <a class="lq-brand" href="{{ url('/') }}" aria-label="Amanails Nail Bar — Beranda">
          Amanails<span class="lq-dot">.</span>
          <small>Nail Bar</small>
        </a>

        <nav class="lq-nav-desktop" aria-label="Navigasi Utama">
          <ul class="lq-nav-links">
            <li><a href="{{ url('/katalog') }}">Katalog</a></li>
            <li><a href="{{ url('/jadwal') }}" class="is-active">Booking</a></li>
            <li><a href="{{ url('/services') }}">Menu Lengkap</a></li>
            <li><a href="{{ url('/bantuan') }}">Bantuan</a></li>
          </ul>
        </nav>

        <div class="lq-nav-cta d-flex align-items-center gap-2">
          @auth
            <span class="lq-nav-desktop me-2" style="font-size: 0.82rem; color: var(--lq-mauve);">Halo, <strong>{{ Auth::user()->name }}</strong></span>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="lq-btn lq-btn-outline lq-btn-sm lq-nav-desktop">Keluar</button>
            </form>
          @else
            <a class="lq-btn lq-btn-outline lq-btn-sm lq-nav-desktop" href="{{ route('login') }}">Masuk</a>
          @endauth
          <a class="lq-btn lq-btn-outline lq-btn-sm lq-nav-desktop" href="{{ url('/katalog') }}">&larr; Ubah Layanan</a>
          <button class="lq-nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-controls="mobile-nav" aria-label="Buka menu navigasi">
            <span></span><span></span><span></span>
          </button>
        </div>
      </div>
    </header>

    <!-- Drawer Menu Mobile -->
    <div class="lq-nav-mobile" id="mobile-nav" data-nav-mobile>
      <ul>
        <li><a href="{{ url('/katalog') }}">Katalog Layanan</a></li>
        <li><a href="{{ url('/jadwal') }}" class="is-active">Booking &amp; Jadwal</a></li>
        <li><a href="{{ url('/services') }}">Menu Lengkap</a></li>
        <li><a href="{{ url('/bantuan') }}">Bantuan</a></li>
      </ul>
      <a class="lq-btn lq-btn-outline lq-btn-block mt-3" href="{{ url('/katalog') }}">&larr; Ubah Layanan</a>
    </div>

    <main id="main">

      <!-- ===================== BOOKING SECTION ===================== -->
      <section class="lq-section lq-bg-cream lq-page-offset" style="padding-top:2.5rem; padding-bottom:5rem;">
        <div class="container">
          
          <div class="lq-head lq-head-center reveal mb-4">
            <span class="lq-eyebrow lq-eyebrow-center">Reservasi Kursi Anda</span>
            <h1 class="lq-h2">Pesan Dalam Tiga Langkah Mudah</h1>
            <p class="lq-lead" style="max-width: 65ch; margin: 0 auto;">Pilih kombinasi perawatan manikur, desain nail art atau upload desain sendiri, dan amankan slot kursi Anda dengan DP Rp 50.000/orang.</p>
          </div>

          <div class="reveal reveal-d1">
            <div class="lq-booking-grid-custom">

              <!-- Sisi Kiri: Ringkasan Pemesanan & Sistem 2 Kali Pembayaran -->
              <div class="lq-summary-panel">
                <div>
                  <!-- Thumbnail Model Kuku / Desain Klien -->
                  <div class="lq-summary-thumb mb-3">
                    <img id="summaryThumb" src="{{ $primaryService->image_url ?? asset('img/booking-side.jpg') }}" alt="Model Kuku Amanails">
                  </div>

                  <h3 style="font-family: var(--lq-serif); font-size: 1.35rem; color: #fff; margin-bottom: 0.35rem;">
                    Ringkasan Reservasi
                  </h3>
                  <p style="font-size: 0.82rem; color: rgba(255,255,255,0.75); margin-bottom: 1.15rem;">
                    Kombinasi layanan &amp; skema 2x pembayaran studio.
                  </p>

                  <div class="lq-summary-item">
                    <span class="label">💅 Manicure</span>
                    <span class="val" id="sumManiName">Russian Manicure</span>
                  </div>

                  <div class="lq-summary-item">
                    <span class="label">🎨 Nail Art</span>
                    <span class="val" id="sumArtName">{{ $primaryService->name }}</span>
                  </div>

                  <div class="lq-summary-item">
                    <span class="label">🧼 Remove Kuku</span>
                    <span class="val" id="sumRemoveName">Tanpa Remove</span>
                  </div>

                  <div class="lq-summary-item">
                    <span class="label">⏱️ Total Durasi</span>
                    <span class="val" id="sumDuration">135 Menit</span>
                  </div>

                  <div class="lq-summary-item">
                    <span class="label">👥 Jumlah Tamu</span>
                    <span class="val" id="sumGuestsDisplay">1 Orang</span>
                  </div>

                  <div class="lq-summary-item">
                    <span class="label">📅 Tanggal</span>
                    <span class="val" id="sumDateDisplay">Selasa, 24 Nov 2026</span>
                  </div>

                  <div class="lq-summary-item">
                    <span class="label">⏰ Waktu</span>
                    <span class="val" id="sumTimeDisplay">09:00 - 10:00 WIB</span>
                  </div>

                  <div class="lq-summary-item">
                    <span class="label">👩‍🎨 Nail Artist</span>
                    <span class="val" id="sumArtistName">{{ $timeSlots[0]['assigned_artist']['name'] }}</span>
                  </div>
                </div>

                <div>
                  <!-- Kotak Skema Pembayaran 2 Kali (DP + Pelunasan di Akhir) -->
                  <div class="lq-dp-card">
                    <div class="lq-dp-row">
                      <span style="font-size:0.78rem; color:rgba(255,255,255,0.75);">Total Estimasi Biaya</span>
                      <strong style="font-size:0.95rem; color:#fff;" id="sumSubtotal">Rp 245.000</strong>
                    </div>
                    <div class="lq-dp-row pt-2" style="border-top: 1px dashed rgba(255,255,255,0.2);">
                      <div>
                        <span style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.05em; color:var(--lq-gold-soft); display:block; font-weight:600;">⚡ DP Dibayar Sekarang</span>
                        <small style="font-size:0.68rem; color:rgba(255,255,255,0.7);" id="dpGuestRateNote">Rp 50.000 &times; 1 Orang</small>
                      </div>
                      <div style="font-family: var(--lq-serif); font-size: 1.45rem; color: var(--lq-gold-soft); font-weight:700;" id="sumDpNow">
                        Rp 50.000
                      </div>
                    </div>
                    <div class="lq-dp-row pt-2 mt-2" style="border-top: 1px solid rgba(255,255,255,0.18);">
                      <span style="font-size:0.78rem; color:rgba(255,255,255,0.75);">💵 Sisa Pelunasan di Studio</span>
                      <strong style="font-size:1.05rem; color:#fff;" id="sumRemainingBalance">Rp 195.000</strong>
                    </div>
                  </div>

                  <!-- Keunggulan Singkat -->
                  <ul class="lq-booking-perks mt-3 pt-2" style="font-size: 0.8rem; border-top: 1px dashed rgba(255,255,255,0.15);">
                    <li style="font-size: 0.8rem; padding: 0.2rem 0;">Peralatan steril autoklaf medis</li>
                    <li style="font-size: 0.8rem; padding: 0.2rem 0;">Garansi poles ulang 5 hari</li>
                    <li style="font-size: 0.8rem; padding: 0.2rem 0;">Welcome drink gratis</li>
                  </ul>
                </div>
              </div>

              <!-- Sisi Kanan: Form Reservasi Lengkap (Multi-Service & Request Design) -->
              <div class="lq-booking-form" style="padding: 2.5rem 2.25rem;">
                
                <form id="bookingForm" onsubmit="return false;">

                  <!-- ================= 1. KATEGORI MANICURE / PERAWATAN KUKU ================= -->
                  <div class="mb-4">
                    <div class="lq-section-title">
                      <span>01.</span> Perawatan Kuku &amp; Manikur
                    </div>
                    <p style="font-size:0.8rem; color:var(--lq-mauve); margin-bottom:0.75rem;">
                      Pilih perawatan dasar untuk merapikan kutikula dan kesehatan kuku Anda.
                    </p>

                    @foreach($manicureServices as $index => $mani)
                      <label class="lq-service-card-select {{ $index === 0 ? 'is-selected' : '' }}" for="mani-{{ $mani->id }}">
                        <div class="d-flex align-items-center gap-2">
                          <input type="radio" 
                                 name="manicure_service" 
                                 id="mani-{{ $mani->id }}" 
                                 value="{{ $mani->id }}" 
                                 data-name="{{ $mani->name }}"
                                 data-price="{{ $mani->price }}"
                                 data-duration="{{ $mani->duration }}"
                                 {{ $index === 0 ? 'checked' : '' }}>
                          <div>
                            <div style="font-weight:600; font-size:0.88rem; color:var(--lq-plum);">{{ $mani->name }}</div>
                            <small style="font-size:0.75rem; color:var(--lq-mauve);">{{ $mani->description }} ({{ $mani->duration }} Menit)</small>
                          </div>
                        </div>
                        <div style="font-family:var(--lq-serif); font-weight:600; font-size:0.95rem; color:var(--lq-rose-deep);">
                          {{ $mani->price > 0 ? '+ Rp ' . number_format($mani->price, 0, ',', '.') : 'Gratis / Skip' }}
                        </div>
                      </label>
                    @endforeach
                  </div>

                  <!-- ================= 2. KATEGORI NAIL ART & DESAIN ================= -->
                  <div class="mb-4">
                    <div class="lq-section-title">
                      <span>02.</span> Desain Kuku &amp; Nail Art
                    </div>
                    <p style="font-size:0.8rem; color:var(--lq-mauve); margin-bottom:0.75rem;">
                      Pilih kreasi dari katalog studio atau unggah referensi model kuku Anda sendiri.
                    </p>

                    <!-- Tab Switcher: Katalog Studio vs Request Desain Sendiri -->
                    <div class="lq-design-tabs">
                      <button type="button" class="lq-design-tab-btn is-active" id="tabDesignCatalogBtn">
                        Pilih Desain dari Katalog
                      </button>
                      <button type="button" class="lq-design-tab-btn" id="tabDesignCustomBtn">
                        ✨ Request Desain Sendiri (Upload)
                      </button>
                    </div>

                    <!-- Pilihan 2A: Katalog Studio -->
                    <div id="panelDesignCatalog">
                      <div class="lq-field mb-2">
                        <label for="bk-service">Katalog Model Kuku Amanails</label>
                        <select class="lq-select" id="bk-service" name="service">
                          @foreach($allServices as $svc)
                            <option value="{{ $svc->id }}" 
                                    data-price="{{ $svc->price }}" 
                                    data-duration="{{ $svc->duration }}"
                                    data-name="{{ $svc->name }}"
                                    data-image="{{ $svc->image_url }}"
                                    data-uploader="{{ $svc->uploaded_by }}"
                                    {{ $svc->id == $primaryService->id ? 'selected' : '' }}>
                              {{ $svc->name }} &mdash; Rp {{ number_format($svc->price, 0, ',', '.') }} (By: {{ $svc->uploaded_by }})
                            </option>
                          @endforeach
                          <option value="none" data-price="0" data-duration="0" data-name="Tanpa Nail Art" data-uploader="Aurel">
                            Tanpa Nail Art (Hanya Manicure / Pembersihan) &mdash; Rp 0
                          </option>
                        </select>
                      </div>
                    </div>

                    <!-- Pilihan 2B: Request Desain Sendiri (Upload Required) -->
                    <div id="panelDesignCustom" style="display:none; background:#fff; border:1px solid var(--lq-line); border-radius:var(--lq-radius); padding:1.25rem;" class="mb-2">
                      <div class="d-flex justify-content-between align-items-center mb-2">
                        <label class="mb-0" style="font-weight:600; font-size:0.86rem; color:var(--lq-plum);">
                          Upload Referensi Desain Kuku Anda <span class="req">*</span>
                        </label>
                        <span class="badge" style="background:var(--lq-blush); color:var(--lq-rose-deep); font-size:0.75rem;">Estimasi Rp 160.000 &bull; 90 Mnt</span>
                      </div>
                      
                      <!-- Area Upload Desain -->
                      <div class="lq-upload-design-box" id="designUploadBox" onclick="document.getElementById('customDesignFile').click();">
                        <input type="file" id="customDesignFile" accept="image/*" style="display:none;">
                        
                        <div id="customDesignPrompt">
                          <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--lq-rose)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:0.35rem;"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect><circle cx="8.5" cy="8.5" r="1.5"></circle><polyline points="21 15 16 10 5 21"></polyline></svg>
                          <div style="font-size:0.85rem; font-weight:500; color:var(--lq-plum);">Klik untuk unggah foto referensi desain (Required)</div>
                          <div style="font-size:0.74rem; color:var(--lq-mauve);">Screenshot Instagram / Pinterest (JPG, PNG)</div>
                        </div>

                        <div id="customDesignPreview" style="display:none; align-items:center; justify-content:center; gap:1rem;">
                          <img id="customDesignImg" src="" alt="Desain Kuku Klien" style="max-height:85px; border-radius:6px; border:1px solid var(--lq-line);">
                          <div class="text-start">
                            <span id="customDesignFileName" style="font-size:0.82rem; font-weight:600; display:block;">desain-kuku.jpg</span>
                            <span style="font-size:0.72rem; color:#27ae60;">✓ Foto referensi berhasil dimuat</span>
                            <button type="button" class="btn btn-link btn-sm text-danger p-0 d-block mt-1" style="font-size:0.75rem;" onclick="event.stopPropagation(); removeCustomDesignFile();">Ganti Foto</button>
                          </div>
                        </div>
                      </div>

                      <div class="mt-3">
                        <label for="customDesignNote" style="font-size:0.8rem; color:var(--lq-mauve);">Catatan Khusus Desain (Warna, aksen, bentuk kuku):</label>
                        <input type="text" class="lq-input" id="customDesignNote" placeholder="Contoh: Mau bentuk almond, warna pastel lilac dengan aksen foil emas.">
                      </div>
                      
                      <div class="mt-2 p-2" style="background:#faf5f3; border-radius:6px; font-size:0.75rem; color:var(--lq-mauve);">
                        ℹ️ <em>Karena Anda mengajukan desain khusus, sistem akan mengalokasikan Nail Artist yang bertugas dan tersedia di jam kunjungan secara acak.</em>
                      </div>
                    </div>
                  </div>

                  <!-- ================= 3. KATEGORI REMOVE NAIL ART LAMA ================= -->
                  <div class="mb-4">
                    <div class="lq-section-title">
                      <span>03.</span> Pembersihan / Remove Kuku Sebelumnya
                    </div>
                    <p style="font-size:0.8rem; color:var(--lq-mauve); margin-bottom:0.75rem;">
                      Apakah Anda memiliki kutek gel lama atau sambungan kuku yang perlu dibersihkan terlebih dahulu?
                    </p>

                    @foreach($removeServices as $index => $rem)
                      <label class="lq-service-card-select {{ $index === 0 ? 'is-selected' : '' }}" for="rem-{{ $rem->id }}">
                        <div class="d-flex align-items-center gap-2">
                          <input type="radio" 
                                 name="remove_service" 
                                 id="rem-{{ $rem->id }}" 
                                 value="{{ $rem->id }}" 
                                 data-name="{{ $rem->name }}"
                                 data-price="{{ $rem->price }}"
                                 data-duration="{{ $rem->duration }}"
                                 {{ $index === 0 ? 'checked' : '' }}>
                          <div>
                            <div style="font-weight:600; font-size:0.88rem; color:var(--lq-plum);">{{ $rem->name }}</div>
                            <small style="font-size:0.75rem; color:var(--lq-mauve);">{{ $rem->description }} ({{ $rem->duration }} Menit)</small>
                          </div>
                        </div>
                        <div style="font-family:var(--lq-serif); font-weight:600; font-size:0.95rem; color:var(--lq-rose-deep);">
                          {{ $rem->price > 0 ? '+ Rp ' . number_format($rem->price, 0, ',', '.') : 'Gratis / Tidak Perlu' }}
                        </div>
                      </label>
                    @endforeach
                  </div>

                  <!-- ================= 4. JUMLAH TAMU & SKEMA KELIPATAN DP ================= -->
                  <div class="lq-field mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                      <label for="bk-people" class="mb-0">Jumlah Tamu <span class="req">*</span></label>
                      <small style="font-size:0.75rem; color:var(--lq-rose-deep); font-weight:600;">DP Rp 50.000 / orang</small>
                    </div>
                    <select class="lq-select" id="bk-people" name="guests">
                      <option value="1" data-multiplier="1" selected>1 Orang (Sendiri) &mdash; DP Rp 50.000</option>
                      <option value="2" data-multiplier="2">2 Orang (Berdampingan) &mdash; DP Rp 100.000</option>
                      <option value="3" data-multiplier="3">3 Orang (Rombongan) &mdash; DP Rp 150.000</option>
                      <option value="4" data-multiplier="4">4 Orang (Rombongan) &mdash; DP Rp 200.000</option>
                    </select>
                    <small style="font-size:0.74rem; color:var(--lq-mauve); margin-top:0.25rem; display:block;">
                      *Uang muka (DP) berlaku kelipatan Rp 50.000 per kursi untuk reservasi slot jadwal studio.
                    </small>
                  </div>

                  {{-- NAIL ARTIST BERTUGAS (Informatif & Tanpa Dropdown) --}}
                  <div class="lq-field mb-4">
                    <label class="d-block mb-2">Nail Artist Bertugas</label>
                    <div class="lq-artist-badge-card">
                      <img src="{{ $roster[$primaryService->uploaded_by]['avatar'] ?? asset('img/tech-1.jpg') }}" 
                           id="artistAvatar" 
                           alt="Nail Artist Bertugas" 
                           class="lq-artist-avatar">
                      <div class="lq-artist-info">
                        <h5 id="artistNameDisplay">{{ $primaryService->uploaded_by ?? 'Aurel' }}</h5>
                        <p id="artistRoleDisplay">{{ $roster[$primaryService->uploaded_by]['role'] ?? 'Senior Nail Artist' }} &bull; {{ $roster[$primaryService->uploaded_by]['specialty'] ?? 'Spesialis Nail Art & Extension' }}</p>
                      </div>
                    </div>
                  </div>

                  <!-- ================= 5. TANGGAL KUNJUNGAN (KALENDER) ================= -->
                  <div class="lq-field mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                      <label class="mb-0">Tanggal Kunjungan <span class="req">*</span></label>
                      <small style="font-size:0.75rem; color:var(--lq-mauve);">Pilih tanggal yang tersedia</small>
                    </div>

                    <!-- Widget Kalender -->
                    <div class="amanails-calendar">
                      <div class="cal-header">
                        <button type="button" class="cal-nav-btn" id="btnPrevMonth" aria-label="Bulan Sebelumnya">&lsaquo;</button>
                        <span class="cal-title" id="calMonthTitle">November 2026</span>
                        <button type="button" class="cal-nav-btn" id="btnNextMonth" aria-label="Bulan Berikutnya">&rsaquo;</button>
                      </div>

                      <div class="cal-weekdays">
                        <span>Min</span><span>Sen</span><span>Sel</span><span>Rab</span><span>Kam</span><span>Jum</span><span>Sab</span>
                      </div>

                      <div class="cal-grid" id="calGrid">
                        <!-- Di-render oleh JavaScript -->
                      </div>

                      <div class="cal-legend">
                        <div class="cal-legend-item">
                          <span class="cal-legend-dot" style="background: var(--lq-plum);"></span> Terpilih
                        </div>
                        <div class="cal-legend-item">
                          <span class="cal-legend-dot" style="background: #e6dedc;"></span> Lewat / Tidak Tersedia
                        </div>
                        <div class="cal-legend-item">
                          <span class="cal-legend-dot" style="background: #fdf1ef; border: 1px solid #f3d4ce;"></span> Penuh
                        </div>
                      </div>
                    </div>

                    <!-- Hidden input penampung tanggal -->
                    <input type="hidden" id="bk-date" name="date" value="2026-11-24">
                  </div>

                  <!-- ================= 6. PILIHAN JAM KUNJUNGAN ================= -->
                  <div class="lq-field mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                      <label id="slot-label" class="mb-0">Pilihan Jam Kunjungan <span class="req">*</span></label>
                      <small style="font-size:0.75rem; color:var(--lq-mauve);" id="slotAvailabilityHint">Jadwal tersedia untuk tanggal terpilih</small>
                    </div>

                    <div class="lq-slots" id="slotsContainer" role="group" aria-labelledby="slot-label">
                      <!-- Slot waktu di-render dinamis sesuai tanggal terpilih -->
                    </div>
                  </div>

                  <!-- ================= 7. DATA DIRI PEMESAN ================= -->
                  <div class="lq-field-row mb-2">
                    <div class="lq-field">
                      <label for="bk-name">Nama Lengkap <span class="req">*</span></label>
                      <input class="lq-input" type="text" id="bk-name" name="name" value="{{ Auth::check() ? Auth::user()->name : 'Amanda' }}" placeholder="Nama Anda">
                    </div>
                    <div class="lq-field">
                      <label for="bk-phone">Nomor HP / WhatsApp <span class="req">*</span></label>
                      <input class="lq-input" type="tel" id="bk-phone" name="phone" value="{{ Auth::check() && Auth::user()->phone ? Auth::user()->phone : '0812-9876-5432' }}" placeholder="08xxxxxxxxxx">
                    </div>
                  </div>

                  <!-- TOMBOL KONFIRMASI PEMBAYARAN DP -->
                  <div class="mt-4">
                    <button type="button" class="lq-btn lq-btn-primary lq-btn-block" id="btnContinueBooking">
                      Lanjut Pembayaran DP (<span id="btnDpLabel">Rp 50.000</span>) &rarr;
                    </button>
                    <small class="text-muted text-center d-block mt-2" style="font-size:0.75rem;">
                      *Sisa pelunasan dibayarkan langsung di studio setelah sesi appointment selesai.
                    </small>
                  </div>

                </form>

              </div>

            </div>
          </div>

        </div>
      </section>

    </main>

    <!-- ===================== MODAL PEMBAYARAN DP (QRIS & BANK TRANSFER) ===================== -->
    <div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: var(--lq-radius-lg); overflow: hidden; border: 1px solid var(--lq-line); max-width: 640px; margin: 0 auto;">
          <div class="modal-header" style="background: var(--lq-plum); color: #fff; padding: 1.2rem 1.5rem;">
            <div class="d-flex align-items-center gap-2">
              <span style="font-size: 1.25rem;">✨</span>
              <h5 class="modal-title" style="font-family: var(--lq-serif); color: #fff; font-size: 1.25rem; margin: 0;">
                Pembayaran Uang Muka (DP) &amp; Reservasi
              </h5>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>

          <div class="modal-body p-4" style="background: var(--lq-cream);">
            
            <!-- Ringkasan Skema Pembayaran 2 Kali -->
            <div class="p-3 mb-3" style="background:#fff; border:1px solid var(--lq-line); border-radius:var(--lq-radius);">
              <div class="d-flex justify-content-between align-items-start mb-2">
                <div>
                  <div style="font-size:0.92rem; font-weight:600; color:var(--lq-plum);" id="modalServiceSummary">Russian Manicure + Custom Nail Art</div>
                  <div style="font-size:0.8rem; color:var(--lq-mauve); margin-top:0.15rem;" id="modalScheduleSummary">Jadwal: Selasa, 24 Nov 2026 pada 09:00 - 10:00 WIB</div>
                  <div style="font-size:0.8rem; color:var(--lq-rose-deep); font-weight:600; margin-top:0.15rem;" id="modalArtistSummary">Nail Artist: Aurel</div>
                </div>
                <div class="text-end">
                  <small style="font-size:0.7rem; text-transform:uppercase; color:var(--lq-mauve); display:block;">Total Estimasi</small>
                  <div style="font-size:1.05rem; font-weight:700; color:var(--lq-ink);" id="modalTotalSummary">Rp 245.000</div>
                </div>
              </div>

              <!-- Pembagian DP vs Pelunasan -->
              <div class="p-2 mt-2" style="background:var(--lq-blush-soft); border-radius:6px; display:flex; justify-content:space-between; align-items:center;">
                <div>
                  <span style="font-size:0.75rem; text-transform:uppercase; font-weight:700; color:var(--lq-rose-deep); display:block;">
                    ⚡ Nominal DP Dibayar Sekarang:
                  </span>
                  <small style="font-size:0.7rem; color:var(--lq-mauve);">Untuk mengamankan slot kursi studio</small>
                </div>
                <div style="font-family:var(--lq-serif); font-size:1.35rem; color:var(--lq-rose-deep); font-weight:700;" id="modalDpSummary">
                  Rp 50.000
                </div>
              </div>

              <div class="mt-2 text-end" style="font-size:0.76rem; color:var(--lq-mauve);">
                Sisa pelunasan di studio: <strong id="modalRemainingSummary">Rp 195.000</strong>
              </div>
            </div>

            <!-- Tab Pemilihan Metode Bayar (QRIS vs Transfer Bank) -->
            <label class="d-block mb-2" style="font-weight:600; font-size:0.85rem; color:var(--lq-plum);">
              Pilih Cara Pembayaran DP:
            </label>
            <div class="lq-pay-tabs">
              <button type="button" class="lq-pay-tab-btn is-active" id="tabQrisBtn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                QRIS (Scan &amp; Bayar)
              </button>
              <button type="button" class="lq-pay-tab-btn" id="tabBankBtn">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" y1="21" x2="21" y2="21"></line><line x1="3" y1="10" x2="21" y2="10"></line><polyline points="5 6 12 3 19 6"></polyline><line x1="4" y1="10" x2="4" y2="21"></line><line x1="20" y1="10" x2="20" y2="21"></line></svg>
                Transfer Bank (BCA / Mandiri)
              </button>
            </div>

            <!-- PANEL 1: QRIS -->
            <div id="panelQris" class="lq-qris-card">
              <div class="d-flex justify-content-between align-items-center mb-2 px-2">
                <div class="text-start">
                  <div style="font-weight:700; font-size:0.88rem; color:var(--lq-plum);">AMANAILS NAIL BAR</div>
                  <div style="font-size:0.7rem; color:var(--lq-mauve);">NMID: ID1024389201923</div>
                </div>
                <div style="background:#ed1c24; color:#fff; font-weight:800; font-size:0.75rem; padding:2px 8px; border-radius:4px; letter-spacing:0.05em;">
                  QRIS
                </div>
              </div>

              <!-- Box Gambar QR Code -->
              <div class="lq-qris-qr-box">
                <img id="qrisImage" 
                     src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&margin=8&data=QRIS-AMANAILS-DP-50000" 
                     alt="QRIS Pembayaran Amanails" 
                     width="200" height="200" 
                     style="display:block; max-width:100%; height:auto;"
                     onerror="this.style.display='none'; document.getElementById('qrisSvgFallback').style.display='block';">
                
                <!-- Fallback SVG QR jika koneksi internet offline -->
                <svg id="qrisSvgFallback" width="200" height="200" viewBox="0 0 100 100" style="display:none; margin:0 auto;" shape-rendering="crispEdges">
                  <rect width="100" height="100" fill="#fff"/>
                  <rect x="5" y="5" width="30" height="30" fill="#2d132c"/>
                  <rect x="10" y="10" width="20" height="20" fill="#fff"/>
                  <rect x="15" y="15" width="10" height="10" fill="#2d132c"/>
                  <rect x="65" y="5" width="30" height="30" fill="#2d132c"/>
                  <rect x="70" y="10" width="20" height="20" fill="#fff"/>
                  <rect x="75" y="15" width="10" height="10" fill="#2d132c"/>
                  <rect x="5" y="65" width="30" height="30" fill="#2d132c"/>
                  <rect x="10" y="70" width="20" height="20" fill="#fff"/>
                  <rect x="15" y="75" width="10" height="10" fill="#2d132c"/>
                  <rect x="40" y="8" width="5" height="5" fill="#2d132c"/>
                  <rect x="48" y="8" width="8" height="5" fill="#2d132c"/>
                  <rect x="40" y="18" width="5" height="10" fill="#2d132c"/>
                  <rect x="52" y="20" width="5" height="5" fill="#2d132c"/>
                  <rect x="42" y="32" width="16" height="5" fill="#2d132c"/>
                  <rect x="8" y="42" width="20" height="5" fill="#2d132c"/>
                  <rect x="32" y="42" width="6" height="16" fill="#2d132c"/>
                  <rect x="44" y="44" width="12" height="12" fill="#c46d87"/>
                  <rect x="62" y="42" width="18" height="5" fill="#2d132c"/>
                  <rect x="84" y="42" width="8" height="5" fill="#2d132c"/>
                  <rect x="68" y="52" width="10" height="10" fill="#2d132c"/>
                  <rect x="82" y="52" width="10" height="16" fill="#2d132c"/>
                  <rect x="42" y="62" width="10" height="8" fill="#2d132c"/>
                  <rect x="56" y="65" width="10" height="5" fill="#2d132c"/>
                  <rect x="42" y="76" width="18" height="6" fill="#2d132c"/>
                  <rect x="65" y="76" width="12" height="14" fill="#2d132c"/>
                  <rect x="82" y="76" width="10" height="14" fill="#2d132c"/>
                </svg>
              </div>

              <div class="mt-1">
                <small style="color:var(--lq-mauve); font-size:0.75rem; text-transform:uppercase;">Nominal DP Yang Dibayar Sekarang</small>
                <div style="font-family:var(--lq-serif); font-size:1.45rem; color:var(--lq-plum); font-weight:700;" id="qrisAmountDisplay">
                  Rp 50.000
                </div>
              </div>
              <p style="font-size:0.78rem; color:var(--lq-mauve); margin:0.4rem auto 0; max-width:380px;">
                Dapat di-scan dengan <strong>BCA Mobile, Livin' Mandiri, GoPay, OVO, Dana, ShopeePay</strong>, atau m-Banking apa pun yang berlogo QRIS.
              </p>
            </div>

            <!-- PANEL 2: TRANSFER BANK -->
            <div id="panelBank" style="display:none;">
              
              <!-- BCA -->
              <div class="lq-bank-card">
                <div>
                  <span class="lq-bank-badge lq-bank-badge-bca">Bank BCA</span>
                  <div class="lq-bank-acc-num" id="accBca">8735 0921 44</div>
                  <div style="font-size:0.78rem; color:var(--lq-mauve);">a.n. Amanails Nail Bar / Admin</div>
                </div>
                <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" onclick="copyText('8735092144', this, 'Salin No. Rek')">
                  Salin No. Rek
                </button>
              </div>

              <!-- Bank Mandiri -->
              <div class="lq-bank-card">
                <div>
                  <span class="lq-bank-badge lq-bank-badge-mandiri">Bank Mandiri</span>
                  <div class="lq-bank-acc-num" id="accMandiri">142 00 1982736 1</div>
                  <div style="font-size:0.78rem; color:var(--lq-mauve);">a.n. Amanails Nail Bar / Admin</div>
                </div>
                <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" onclick="copyText('1420019827361', this, 'Salin No. Rek')">
                  Salin No. Rek
                </button>
              </div>

              <!-- Nominal DP Box dengan Salin Nominal -->
              <div class="p-3 mb-2" style="background:#fff; border:1px dashed var(--lq-line); border-radius:var(--lq-radius); display:flex; justify-content:space-between; align-items:center;">
                <div>
                  <small style="font-size:0.72rem; color:var(--lq-mauve); text-transform:uppercase;">Nominal DP Yang Ditransfer</small>
                  <div style="font-family:var(--lq-serif); font-size:1.25rem; font-weight:700; color:var(--lq-plum);" id="bankAmountDisplay">
                    Rp 50.000
                  </div>
                </div>
                <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" id="btnCopyAmount" onclick="copyAmount(this)">
                  Salin Nominal DP
                </button>
              </div>
            </div>

            <!-- Form Upload Bukti Pembayaran DP -->
            <div class="mt-4 pt-3" style="border-top: 1px solid var(--lq-line);">
              <label class="d-block mb-1" style="font-size:0.86rem; font-weight:600; color:var(--lq-plum);">
                Upload Bukti Pembayaran DP (Transfer / QRIS) <span class="req">*</span>
              </label>
              
              <!-- Dropzone Area -->
              <div class="lq-dropzone" id="dropzoneArea" onclick="document.getElementById('receiptFileInput').click();">
                <input type="file" id="receiptFileInput" accept="image/*" style="display:none;">
                
                <div id="dropzonePrompt">
                  <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="var(--lq-rose)" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" style="margin-bottom:0.4rem;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="17 8 12 3 7 8"></polyline><line x1="12" y1="3" x2="12" y2="15"></line></svg>
                  <div style="font-size:0.85rem; font-weight:500; color:var(--lq-plum);">Klik untuk unggah struk / screenshot pembayaran DP</div>
                  <div style="font-size:0.75rem; color:var(--lq-mauve);">Format JPG, PNG (Maks. 5 MB)</div>
                </div>

                <!-- Preview Gambar Setelah Dipilih -->
                <div id="receiptPreviewBox" style="display:none; align-items:center; justify-content:center; gap:1rem;">
                  <img id="receiptPreviewImg" src="" alt="Bukti Pembayaran DP" style="max-height:90px; border-radius:6px; border:1px solid var(--lq-line);">
                  <div class="text-start">
                    <span id="receiptFileName" style="font-size:0.82rem; font-weight:600; display:block;">bukti-dp.jpg</span>
                    <span style="font-size:0.72rem; color:#27ae60; font-weight:500;">✓ Foto bukti siap diunggah</span>
                    <button type="button" class="btn btn-link btn-sm text-danger p-0 d-block mt-1" style="font-size:0.75rem;" onclick="event.stopPropagation(); removeReceiptFile();">Ganti Foto</button>
                  </div>
                </div>
              </div>

              <small class="text-muted d-block mt-2" style="font-size:0.75rem; line-height:1.4;">
                *Setelah bukti DP diunggah, <strong>Admin</strong> akan memverifikasi dan jadwal Anda otomatis tercatat di sistem studio.
              </small>
            </div>

          </div>

          <div class="modal-footer" style="background: var(--lq-cream-2); padding: 0.9rem 1.5rem;">
            <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="lq-btn lq-btn-primary lq-btn-sm" id="btnSubmitPayment">
              Kirim Bukti DP &amp; Selesaikan Reservasi &rarr;
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- ===================== FOOTER ===================== -->
    <footer class="lq-footer">
      <div class="container">
        <div class="row g-4">
          <div class="col-lg-4">
            <a class="lq-brand" href="{{ url('/') }}">Amanails<span class="lq-dot">.</span><small>Nail Bar</small></a>
            <p style="margin-top:1.25rem;max-width:32ch">Boutique nail bar estetik dengan perawatan manikur ahli, kutek gel tahan lama, dan nail art lukis tangan di studio yang tenang dan higienis.</p>
          </div>
          <div class="col-6 col-lg-2">
            <h5>Jelajahi</h5>
            <ul>
              <li><a href="{{ url('/katalog') }}">Katalog</a></li>
              <li><a href="{{ url('/jadwal') }}">Jadwal &amp; Booking</a></li>
              <li><a href="{{ url('/services') }}">Menu Lengkap</a></li>
              <li><a href="{{ url('/bantuan') }}">Bantuan</a></li>
            </ul>
          </div>
          <div class="col-6 col-lg-2">
            <h5>Kunjungan</h5>
            <ul>
              <li><a href="#">Selasa &ndash; Minggu: 09:00 - 20:00</a></li>
              <li><a href="tel:+6281234567890">(021) 555-0142</a></li>
              <li><a href="mailto:halo@amanails.com">halo@amanails.com</a></li>
            </ul>
          </div>
          <div class="col-lg-4">
            <h5>Amanails &middot; PROBIS</h5>
            <p style="max-width:34ch">Modul Pembeli (Buyer - Amanda): Reservasi online multi-layanan dan sistem pembayaran DP.</p>
          </div>
        </div>

        <div class="lq-footer-bottom">
          <p style="margin:0">&copy; {{ date('Y') }} Amanails Nail Bar. Seluruh hak cipta dilindungi.</p>
          <p style="margin:0"><a href="#main">Kembali ke atas &uarr;</a></p>
        </div>
      </div>
    </footer>

    <!-- Bootstrap Bundle JS & Main Template JS -->
    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        // Data Roster, Tanggal Penuh, dan Slot Terbooking langsung dari Database
        const rosterData = @json($roster);
        const artistList = Object.keys(rosterData).filter(n => n !== 'Admin');
        const fullyBookedDates = @json($fullyBookedDates);
        const bookedSlotsByDate = @json($bookedSlotsByDate);
        const studioSlots = @json($studioSlots);
        const todayStr = @json($today);

        const todayParts = todayStr.split('-');
        const todayYear = parseInt(todayParts[0], 10);
        const todayMonth = parseInt(todayParts[1], 10) - 1;
        const todayDate = parseInt(todayParts[2], 10);

        // State Kalender
        let currentYear = todayYear;
        let currentMonth = todayMonth;
        let selectedDateStr = todayStr;
        let selectedTimeStr = studioSlots[0] || '09:00 - 10:00 WIB';

        // State Layanan Terpilih (dari DB)
        const firstManiRadio = document.querySelector('input[name="manicure_service"]:checked');
        let currentMani = firstManiRadio ? {
          id: firstManiRadio.value,
          name: firstManiRadio.getAttribute('data-name'),
          price: parseInt(firstManiRadio.getAttribute('data-price'), 10),
          duration: parseInt(firstManiRadio.getAttribute('data-duration'), 10)
        } : { id: null, name: 'Tanpa Manicure', price: 0, duration: 0 };

        let currentArt = { 
          type: 'catalog',
          id: "{{ $primaryService->id ?? '' }}",
          name: "{{ $primaryService->name ?? 'Handpainted Custom Nail Art' }}", 
          price: {{ $primaryService->price ?? 180000 }}, 
          duration: {{ $primaryService->duration ?? 90 }}, 
          uploader: "{{ $primaryService->uploaded_by ?? 'Aurel' }}",
          image: "{{ $primaryService->image_url ?? asset('img/booking-side.jpg') }}",
          hasCustomUpload: false
        };

        const firstRemoveRadio = document.querySelector('input[name="remove_service"]:checked');
        let currentRemove = firstRemoveRadio ? {
          id: firstRemoveRadio.value,
          name: firstRemoveRadio.getAttribute('data-name'),
          price: parseInt(firstRemoveRadio.getAttribute('data-price'), 10),
          duration: parseInt(firstRemoveRadio.getAttribute('data-duration'), 10)
        } : { id: null, name: 'Tanpa Remove', price: 0, duration: 0 };

        let currentGuests = 1;
        const DP_RATE = {{ $dpPerGuest }};
        let activePaymentMethod = 'qris';

        // Elemen UI
        const calMonthTitle = document.getElementById('calMonthTitle');
        const calGrid = document.getElementById('calGrid');
        const btnPrevMonth = document.getElementById('btnPrevMonth');
        const btnNextMonth = document.getElementById('btnNextMonth');
        const slotsContainer = document.getElementById('slotsContainer');
        const bkDateInput = document.getElementById('bk-date');

        const summaryThumb = document.getElementById('summaryThumb');
        const sumManiName = document.getElementById('sumManiName');
        const sumArtName = document.getElementById('sumArtName');
        const sumRemoveName = document.getElementById('sumRemoveName');
        const sumDuration = document.getElementById('sumDuration');
        const sumGuestsDisplay = document.getElementById('sumGuestsDisplay');
        const sumDateDisplay = document.getElementById('sumDateDisplay');
        const sumTimeDisplay = document.getElementById('sumTimeDisplay');
        const sumArtistName = document.getElementById('sumArtistName');
        
        const sumSubtotal = document.getElementById('sumSubtotal');
        const sumDpNow = document.getElementById('sumDpNow');
        const sumRemainingBalance = document.getElementById('sumRemainingBalance');
        const dpGuestRateNote = document.getElementById('dpGuestRateNote');
        const btnDpLabel = document.getElementById('btnDpLabel');

        const artistAvatar = document.getElementById('artistAvatar');
        const artistNameDisplay = document.getElementById('artistNameDisplay');
        const artistRoleDisplay = document.getElementById('artistRoleDisplay');

        const btnContinueBooking = document.getElementById('btnContinueBooking');
        const modal = new bootstrap.Modal(document.getElementById('previewModal'));

        const monthNames = [
          'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
          'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];
        const dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

        function formatRupiah(number) {
          return 'Rp ' + parseInt(number, 10).toLocaleString('id-ID');
        }

        function formatDateFull(year, month, date) {
          const d = new Date(year, month, date);
          const dayName = dayNames[d.getDay()];
          const monthShort = monthNames[month].substring(0, 3);
          return `${dayName}, ${date} ${monthShort} ${year}`;
        }

        function pad(n) {
          return n < 10 ? '0' + n : n;
        }

        // ================= KALKULASI HARGA & DP MULTI-SERVICE =================
        function updateCalculations() {
          const serviceTotalPerPerson = currentMani.price + currentArt.price + currentRemove.price;
          const totalServicePrice = serviceTotalPerPerson * currentGuests;
          const totalDp = DP_RATE * currentGuests;
          const remainingBalance = Math.max(0, totalServicePrice - totalDp);
          const totalDuration = currentMani.duration + currentArt.duration + currentRemove.duration;

          // Perbarui teks di sidebar
          sumManiName.textContent = currentMani.name + (currentMani.price > 0 ? ` (${formatRupiah(currentMani.price)})` : '');
          sumArtName.textContent = currentArt.name + (currentArt.price > 0 ? ` (${formatRupiah(currentArt.price)})` : '');
          sumRemoveName.textContent = currentRemove.name + (currentRemove.price > 0 ? ` (${formatRupiah(currentRemove.price)})` : '');
          sumDuration.textContent = `${totalDuration} Menit`;
          sumGuestsDisplay.textContent = `${currentGuests} Orang`;

          sumSubtotal.textContent = formatRupiah(totalServicePrice);
          sumDpNow.textContent = formatRupiah(totalDp);
          sumRemainingBalance.textContent = formatRupiah(remainingBalance);
          dpGuestRateNote.textContent = `${formatRupiah(DP_RATE)} × ${currentGuests} Orang`;
          btnDpLabel.textContent = formatRupiah(totalDp);

          if (currentArt.image) {
            summaryThumb.src = currentArt.image;
          }
        }

        // ================= PERUBAHAN MANICURE =================
        document.querySelectorAll('input[name="manicure_service"]').forEach(radio => {
          radio.addEventListener('change', function () {
            document.querySelectorAll('input[name="manicure_service"]').forEach(r => {
              r.closest('.lq-service-card-select').classList.remove('is-selected');
            });
            this.closest('.lq-service-card-select').classList.add('is-selected');

            currentMani = {
              id: this.value,
              name: this.getAttribute('data-name'),
              price: parseInt(this.getAttribute('data-price'), 10),
              duration: parseInt(this.getAttribute('data-duration'), 10)
            };
            updateCalculations();
          });
        });

        // ================= PERUBAHAN DESAIN (KATALOG vs REQUEST SENDIRI) =================
        const tabDesignCatalogBtn = document.getElementById('tabDesignCatalogBtn');
        const tabDesignCustomBtn = document.getElementById('tabDesignCustomBtn');
        const panelDesignCatalog = document.getElementById('panelDesignCatalog');
        const panelDesignCustom = document.getElementById('panelDesignCustom');
        const bkService = document.getElementById('bk-service');

        tabDesignCatalogBtn.addEventListener('click', function () {
          tabDesignCatalogBtn.classList.add('is-active');
          tabDesignCustomBtn.classList.remove('is-active');
          panelDesignCatalog.style.display = 'block';
          panelDesignCustom.style.display = 'none';

          const opt = bkService.options[bkService.selectedIndex];
          currentArt = {
            type: 'catalog',
            id: opt.value === 'none' ? null : opt.value,
            name: opt.getAttribute('data-name'),
            price: parseInt(opt.getAttribute('data-price'), 10),
            duration: parseInt(opt.getAttribute('data-duration'), 10),
            uploader: opt.getAttribute('data-uploader') || 'Aurel',
            image: opt.getAttribute('data-image') || "{{ asset('img/booking-side.jpg') }}",
            hasCustomUpload: false
          };
          updateAssignedArtist(currentArt.uploader);
          updateCalculations();
          renderSlotsForDate(selectedDateStr, parseInt(selectedDateStr.split('-')[2], 10));
        });

        tabDesignCustomBtn.addEventListener('click', function () {
          tabDesignCustomBtn.classList.add('is-active');
          tabDesignCatalogBtn.classList.remove('is-active');
          panelDesignCatalog.style.display = 'none';
          panelDesignCustom.style.display = 'block';

          // Randomize penugasan nail artist untuk custom request
          const randomArtist = artistList[Math.floor(Math.random() * artistList.length)];

          currentArt = {
            type: 'custom',
            id: null,
            name: 'Request Desain Sendiri (Custom Request)',
            price: 160000,
            duration: 90,
            uploader: randomArtist,
            image: "{{ asset('img/booking-side.jpg') }}",
            hasCustomUpload: document.getElementById('customDesignFile').files.length > 0
          };
          updateAssignedArtist(randomArtist);
          updateCalculations();
          renderSlotsForDate(selectedDateStr, parseInt(selectedDateStr.split('-')[2], 10));
        });

        // Pilihan dropdown katalog
        bkService.addEventListener('change', function () {
          const opt = this.options[this.selectedIndex];
          currentArt = {
            type: 'catalog',
            id: opt.value === 'none' ? null : opt.value,
            name: opt.getAttribute('data-name'),
            price: parseInt(opt.getAttribute('data-price'), 10),
            duration: parseInt(opt.getAttribute('data-duration'), 10),
            uploader: opt.getAttribute('data-uploader') || 'Aurel',
            image: opt.getAttribute('data-image') || "{{ asset('img/booking-side.jpg') }}",
            hasCustomUpload: false
          };
          updateAssignedArtist(currentArt.uploader);
          updateCalculations();
          renderSlotsForDate(selectedDateStr, parseInt(selectedDateStr.split('-')[2], 10));
        });

        // Upload foto desain sendiri (Required)
        const customDesignFile = document.getElementById('customDesignFile');
        const customDesignPrompt = document.getElementById('customDesignPrompt');
        const customDesignPreview = document.getElementById('customDesignPreview');
        const customDesignImg = document.getElementById('customDesignImg');
        const customDesignFileName = document.getElementById('customDesignFileName');

        customDesignFile.addEventListener('change', function () {
          if (this.files && this.files[0]) {
            const file = this.files[0];
            const reader = new FileReader();
            reader.onload = function (e) {
              customDesignImg.src = e.target.result;
              customDesignFileName.textContent = file.name;
              customDesignPrompt.style.display = 'none';
              customDesignPreview.style.display = 'flex';
              currentArt.image = e.target.result;
              currentArt.hasCustomUpload = true;
              summaryThumb.src = e.target.result;
            };
            reader.readAsDataURL(file);
          }
        });

        window.removeCustomDesignFile = function () {
          customDesignFile.value = '';
          customDesignImg.src = '';
          customDesignPrompt.style.display = 'block';
          customDesignPreview.style.display = 'none';
          currentArt.hasCustomUpload = false;
        };

        // ================= PERUBAHAN REMOVE SERVICE =================
        document.querySelectorAll('input[name="remove_service"]').forEach(radio => {
          radio.addEventListener('change', function () {
            document.querySelectorAll('input[name="remove_service"]').forEach(r => {
              r.closest('.lq-service-card-select').classList.remove('is-selected');
            });
            this.closest('.lq-service-card-select').classList.add('is-selected');

            currentRemove = {
              id: this.value,
              name: this.getAttribute('data-name'),
              price: parseInt(this.getAttribute('data-price'), 10),
              duration: parseInt(this.getAttribute('data-duration'), 10)
            };
            updateCalculations();
          });
        });

        // ================= PERUBAHAN JUMLAH TAMU (KELIPATAN DP) =================
        const bkPeople = document.getElementById('bk-people');
        bkPeople.addEventListener('change', function () {
          currentGuests = parseInt(this.value, 10);
          updateCalculations();
        });

        // ================= RENDER KALENDER =================
        function renderCalendar(year, month) {
          calMonthTitle.textContent = `${monthNames[month]} ${year}`;
          calGrid.innerHTML = '';

          btnPrevMonth.disabled = (year === todayYear && month <= todayMonth);

          const firstDayIndex = new Date(year, month, 1).getDay();
          const lastDate = new Date(year, month + 1, 0).getDate();

          for (let i = 0; i < firstDayIndex; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.className = 'cal-cell-empty';
            calGrid.appendChild(emptyCell);
          }

          for (let day = 1; day <= lastDate; day++) {
            const dateStr = `${year}-${pad(month + 1)}-${pad(day)}`;
            const isToday = (year === todayYear && month === todayMonth && day === todayDate);
            const isPast = (new Date(year, month, day) < new Date(todayYear, todayMonth, todayDate));
            const isFull = fullyBookedDates.includes(dateStr);
            const isSelected = (dateStr === selectedDateStr);

            const cell = document.createElement('div');
            cell.className = 'cal-cell';

            if (isPast) {
              cell.classList.add('is-past', 'is-disabled');
              cell.title = 'Tanggal sudah terlewat';
              cell.innerHTML = `<span>${day}</span><span class="cal-subtext">&minus;</span>`;
            } else if (isFull) {
              cell.classList.add('is-full', 'is-disabled');
              cell.title = 'Jadwal pada tanggal ini sudah penuh';
              cell.innerHTML = `<span>${day}</span><span class="cal-subtext">Penuh</span>`;
            } else {
              if (isSelected) cell.classList.add('is-selected');
              if (isToday) cell.classList.add('is-today');

              cell.innerHTML = `<span>${day}</span><span class="cal-subtext">${isToday ? 'Hari Ini' : 'Tersedia'}</span>`;

              cell.addEventListener('click', function () {
                document.querySelectorAll('.cal-cell.is-selected').forEach(c => c.classList.remove('is-selected'));
                cell.classList.add('is-selected');

                selectedDateStr = dateStr;
                bkDateInput.value = dateStr;
                sumDateDisplay.textContent = formatDateFull(year, month, day);

                renderSlotsForDate(dateStr, day);
              });
            }

            calGrid.appendChild(cell);
          }
        }

        // ================= RENDER SLOT JAM DARI DATABASE =================
        async function renderSlotsForDate(dateStr, dayNum) {
          slotsContainer.innerHTML = '<small style="color:var(--lq-mauve);">Memuat ketersediaan jadwal...</small>';
          const targetArtist = currentArt.uploader || 'Aurel';

          let slots = [];
          try {
            const resp = await fetch(`{{ route('jadwal.availability') }}?date=${encodeURIComponent(dateStr)}&creator=${encodeURIComponent(targetArtist)}`, {
              headers: { 'Accept': 'application/json' }
            });
            if (resp.ok) {
              const data = await resp.json();
              slots = (data.slots || []).map(s => ({
                time: s.time,
                status: s.status,
                artist: s.assigned_artist ? s.assigned_artist.name : targetArtist
              }));
            }
          } catch (err) {
            // Fallback ke data bookedSlotsByDate dari server
            const bookedForDate = bookedSlotsByDate[dateStr] || [];
            slots = studioSlots.map((time, index) => {
              const isBooked = bookedForDate.includes(time);
              const fallbackName = artistList[index % Math.max(1, artistList.length)] || 'Aurel';
              return {
                time: time,
                status: isBooked ? 'booked' : 'available',
                artist: (!isBooked && (targetArtist in rosterData)) ? targetArtist : fallbackName
              };
            });
          }

          slotsContainer.innerHTML = '';
          let firstAvailableSelected = false;

          slots.forEach(slot => {
            const btn = document.createElement('button');
            btn.type = 'button';
            btn.className = 'lq-slot';

            if (slot.status === 'booked') {
              btn.classList.add('is-booked');
              btn.disabled = true;
              btn.innerHTML = `${slot.time.substring(0, 5)} <small style="font-size:0.65rem; display:block;">Penuh</small>`;
            } else {
              if (!firstAvailableSelected) {
                btn.classList.add('is-selected');
                firstAvailableSelected = true;
                selectedTimeStr = slot.time;
                sumTimeDisplay.textContent = slot.time;
                updateAssignedArtist(slot.artist);
              }

              btn.innerHTML = `${slot.time.substring(0, 5)}`;

              btn.addEventListener('click', function () {
                document.querySelectorAll('.lq-slot.is-selected').forEach(s => s.classList.remove('is-selected'));
                btn.classList.add('is-selected');

                selectedTimeStr = slot.time;
                sumTimeDisplay.textContent = slot.time;
                updateAssignedArtist(slot.artist);
              });
            }

            slotsContainer.appendChild(btn);
          });
        }

        function updateAssignedArtist(artistName) {
          const artist = rosterData[artistName] || rosterData['Aurel'];
          artistNameDisplay.textContent = artist.name;
          artistRoleDisplay.textContent = `${artist.role} • ${artist.specialty}`;
          artistAvatar.src = artist.avatar;
          artistAvatar.alt = artist.name;
          sumArtistName.textContent = artist.name;
        }

        // Navigasi bulan
        btnPrevMonth.addEventListener('click', function () {
          if (currentMonth === 0) {
            currentMonth = 11;
            currentYear--;
          } else {
            currentMonth--;
          }
          renderCalendar(currentYear, currentMonth);
        });

        btnNextMonth.addEventListener('click', function () {
          if (currentMonth === 11) {
            currentMonth = 0;
            currentYear++;
          } else {
            currentMonth++;
          }
          renderCalendar(currentYear, currentMonth);
        });

        // ================= BUKA MODAL PEMBAYARAN DP =================
        btnContinueBooking.addEventListener('click', function () {
          // Validasi jika user memilih opsi request desain sendiri tetapi belum upload foto
          if (currentArt.type === 'custom' && !currentArt.hasCustomUpload) {
            alert('Silakan unggah foto referensi desain kuku Anda terlebih dahulu sebelum melanjutkan reservasi.');
            document.getElementById('designUploadBox').scrollIntoView({ behavior: 'smooth' });
            return;
          }

          const serviceSummary = `${currentMani.name} + ${currentArt.name}` + (currentRemove.price > 0 ? ` + ${currentRemove.name}` : '');
          const totalAmount = sumSubtotal.textContent;
          const dpAmount = sumDpNow.textContent;
          const remainingAmount = sumRemainingBalance.textContent;
          const dateStr = sumDateDisplay.textContent;
          const timeStr = sumTimeDisplay.textContent;
          const artist = sumArtistName.textContent;
          const numericDp = dpAmount.replace(/[^0-9]/g, '');

          document.getElementById('modalServiceSummary').textContent = serviceSummary;
          document.getElementById('modalScheduleSummary').textContent = `Jadwal: ${dateStr} pada ${timeStr} (${currentGuests} Tamu)`;
          document.getElementById('modalArtistSummary').textContent = `Nail Artist: ${artist}`;
          document.getElementById('modalTotalSummary').textContent = totalAmount;
          document.getElementById('modalDpSummary').textContent = dpAmount;
          document.getElementById('modalRemainingSummary').textContent = remainingAmount;

          document.getElementById('qrisAmountDisplay').textContent = dpAmount;
          document.getElementById('bankAmountDisplay').textContent = dpAmount;

          const btnCopyAmt = document.getElementById('btnCopyAmount');
          if (btnCopyAmt) {
            btnCopyAmt.setAttribute('data-amount', numericDp);
          }

          // Perbarui QR Code sesuai nominal DP
          const qrisImg = document.getElementById('qrisImage');
          if (qrisImg) {
            qrisImg.src = `https://api.qrserver.com/v1/create-qr-code/?size=200x200&margin=8&data=${encodeURIComponent('QRIS-AMANAILS-DP-' + numericDp)}`;
          }

          modal.show();
        });

        // Tab Switching Pembayaran (QRIS vs Transfer Bank)
        const tabQrisBtn = document.getElementById('tabQrisBtn');
        const tabBankBtn = document.getElementById('tabBankBtn');
        const panelQris = document.getElementById('panelQris');
        const panelBank = document.getElementById('panelBank');

        tabQrisBtn.addEventListener('click', function () {
          activePaymentMethod = 'qris';
          tabQrisBtn.classList.add('is-active');
          tabBankBtn.classList.remove('is-active');
          panelQris.style.display = 'block';
          panelBank.style.display = 'none';
        });

        tabBankBtn.addEventListener('click', function () {
          activePaymentMethod = 'bank_transfer';
          tabBankBtn.classList.add('is-active');
          tabQrisBtn.classList.remove('is-active');
          panelBank.style.display = 'block';
          panelQris.style.display = 'none';
        });

        // Upload Bukti Pembayaran DP
        const receiptInput = document.getElementById('receiptFileInput');
        const dropzonePrompt = document.getElementById('dropzonePrompt');
        const receiptPreviewBox = document.getElementById('receiptPreviewBox');
        const receiptPreviewImg = document.getElementById('receiptPreviewImg');
        const receiptFileName = document.getElementById('receiptFileName');

        receiptInput.addEventListener('change', function () {
          if (this.files && this.files[0]) {
            const file = this.files[0];
            const reader = new FileReader();
            reader.onload = function (e) {
              receiptPreviewImg.src = e.target.result;
              receiptFileName.textContent = file.name;
              dropzonePrompt.style.display = 'none';
              receiptPreviewBox.style.display = 'flex';
            };
            reader.readAsDataURL(file);
          }
        });

        window.removeReceiptFile = function () {
          receiptInput.value = '';
          receiptPreviewImg.src = '';
          dropzonePrompt.style.display = 'block';
          receiptPreviewBox.style.display = 'none';
        };

        // Submit Pembayaran DP ke Database
        const btnSubmitPayment = document.getElementById('btnSubmitPayment');
        btnSubmitPayment.addEventListener('click', async function () {
          const clientName = document.getElementById('bk-name').value.trim();
          const clientPhone = document.getElementById('bk-phone').value.trim();

          if (!clientName || !clientPhone) {
            alert('Mohon lengkapi Nama Lengkap dan Nomor HP / WhatsApp Anda.');
            return;
          }

          if (!receiptInput.files || receiptInput.files.length === 0) {
            if (!confirm('Anda belum melampirkan foto struk/screenshot transfer DP. Tetap kirim reservasi?')) {
              return;
            }
          }

          const csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
          const formData = new FormData();
          formData.append('client_name', clientName);
          formData.append('client_phone', clientPhone);
          formData.append('appointment_date', selectedDateStr);
          formData.append('time_slot', selectedTimeStr);
          formData.append('guests', currentGuests);
          if (currentMani.id) formData.append('manicure_id', currentMani.id);
          formData.append('design_type', currentArt.type);
          if (currentArt.type === 'catalog' && currentArt.id) {
            formData.append('nail_art_id', currentArt.id);
          }
          if (currentRemove.id) formData.append('remove_id', currentRemove.id);
          if (currentArt.type === 'custom' && customDesignFile.files[0]) {
            formData.append('custom_design_image', customDesignFile.files[0]);
          }
          const designNote = document.getElementById('customDesignNote')?.value || '';
          if (designNote) formData.append('custom_design_note', designNote);

          formData.append('dp_payment_method', activePaymentMethod);
          if (receiptInput.files && receiptInput.files[0]) {
            formData.append('dp_payment_proof', receiptInput.files[0]);
          }

          btnSubmitPayment.disabled = true;
          btnSubmitPayment.textContent = 'Menyimpan Reservasi...';

          try {
            const response = await fetch("{{ route('booking.store') }}", {
              method: 'POST',
              headers: {
                'X-CSRF-TOKEN': csrfToken,
                'Accept': 'application/json'
              },
              body: formData
            });

            const result = await response.json();
            if (!response.ok) {
              alert(result.message || 'Gagal menyimpan reservasi. Periksa kembali data Anda.');
              btnSubmitPayment.disabled = false;
              btnSubmitPayment.innerHTML = 'Kirim Bukti DP &amp; Selesaikan Reservasi &rarr;';
              return;
            }

            alert(`Reservasi Berhasil Disimpan!\nKode Booking: ${result.booking_code}\nNail Artist: ${result.artist_name}\nDP Terbayar: ${formatRupiah(result.dp_amount)}\nSisa Pelunasan di Studio: ${formatRupiah(result.remaining_balance)}`);
            location.href = "{{ url('/katalog') }}";
          } catch (error) {
            alert('Terjadi kesalahan koneksi saat menyimpan reservasi.');
            btnSubmitPayment.disabled = false;
            btnSubmitPayment.innerHTML = 'Kirim Bukti DP &amp; Selesaikan Reservasi &rarr;';
          }
        });

        // Inisialisasi awal
        sumDateDisplay.textContent = formatDateFull(todayYear, todayMonth, todayDate);
        renderCalendar(currentYear, currentMonth);
        renderSlotsForDate(selectedDateStr, todayDate);
        updateCalculations();
      });

      // Fungsi Salin Rekening & Nominal ke Clipboard
      window.copyText = function (text, btnElement, defaultLabel) {
        const originalContent = btnElement.innerHTML;
        const doSuccess = () => {
          btnElement.innerHTML = '✓ Tersalin!';
          btnElement.style.background = 'var(--lq-rose-deep)';
          btnElement.style.color = '#fff';
          btnElement.style.borderColor = 'var(--lq-rose-deep)';
          setTimeout(() => {
            btnElement.innerHTML = defaultLabel;
            btnElement.style.background = '';
            btnElement.style.color = '';
            btnElement.style.borderColor = '';
          }, 2000);
        };

        if (navigator.clipboard && window.isSecureContext) {
          navigator.clipboard.writeText(text).then(doSuccess).catch(() => fallbackCopy(text, doSuccess));
        } else {
          fallbackCopy(text, doSuccess);
        }
      };

      window.copyAmount = function (btnElement) {
        const amt = btnElement.getAttribute('data-amount') || '50000';
        window.copyText(amt, btnElement, 'Salin Nominal DP');
      };

      function fallbackCopy(text, onSuccess) {
        const ta = document.createElement('textarea');
        ta.value = text;
        ta.style.position = 'fixed';
        ta.style.left = '-9999px';
        document.body.appendChild(ta);
        ta.focus();
        ta.select();
        try {
          document.execCommand('copy');
          onSuccess();
        } catch (e) {
          alert('Salin manual: ' + text);
        }
        document.body.removeChild(ta);
      }
    </script>
  </body>
</html>
