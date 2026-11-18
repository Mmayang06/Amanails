<!DOCTYPE html>
<html lang="id">
  <head>
    <script>document.documentElement.classList.add('js')</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Layanan &amp; Reservasi &mdash; Amanails Nail Bar</title>
    <meta name="description" content="Daftar layanan lengkap Amanails Nail Bar — manikur, pedikur, kutek gel, akrilik, sambung kuku (extensions), nail art dan perawatan kuku dengan harga transparan, serta formulir reservasi online.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400;1,9..144,500&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
            <li><a href="{{ url('/') }}#services">Layanan</a></li>
            <li><a href="{{ url('/') }}#gallery">Galeri</a></li>
            <li><a href="#booking">Reservasi</a></li>
            <li><a href="{{ url('/') }}#team">Terapis</a></li>
            <li><a href="{{ url('/') }}#shop">Produk</a></li>
            <li><a href="{{ url('/services') }}" class="is-active">Menu Lengkap</a></li>
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
          <a class="lq-btn lq-btn-primary lq-btn-sm lq-nav-desktop" href="#booking">Pesan Sekarang</a>
          <button class="lq-nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-controls="mobile-nav" aria-label="Buka menu navigasi">
            <span></span><span></span><span></span>
          </button>
        </div>
      </div>
    </header>

    <!-- Drawer Menu Mobile -->
    <div class="lq-nav-mobile" id="mobile-nav" data-nav-mobile>
      <ul>
        <li><a href="{{ url('/') }}#services">Layanan</a></li>
        <li><a href="{{ url('/') }}#gallery">Galeri</a></li>
        <li><a href="#booking">Reservasi</a></li>
        <li><a href="{{ url('/') }}#team">Terapis</a></li>
        <li><a href="{{ url('/') }}#membership">Keanggotaan</a></li>
        <li><a href="{{ url('/') }}#shop">Produk</a></li>
        <li><a href="{{ url('/') }}#visit">Kunjungi Kami</a></li>
        <li><a href="{{ url('/services') }}" class="is-active">Menu Lengkap</a></li>
        @auth
          <li><span style="display:block; padding: 0.5rem 0; color: var(--lq-rose); font-size: 0.9rem;">Masuk sebagai <strong>{{ Auth::user()->name }}</strong></span></li>
        @else
          <li><a href="{{ route('login') }}">Masuk</a></li>
          <li><a href="{{ route('register') }}">Daftar Akun Baru</a></li>
        @endauth
      </ul>
      @auth
        <form action="{{ route('logout') }}" method="POST" class="mt-3">
          @csrf
          <button type="submit" class="lq-btn lq-btn-outline lq-btn-block">Keluar</button>
        </form>
      @else
        <a class="lq-btn lq-btn-primary lq-btn-block" href="#booking">Buat Janji Temu</a>
      @endauth
    </div>

    @if(session('success'))
      <div class="alert alert-success alert-dismissible fade show text-center mb-0" role="alert" style="position: fixed; top: 85px; left: 50%; transform: translateX(-50%); z-index: 9999; max-width: 520px; width: 92%; background: #ffffff; color: var(--lq-ink); border: 1px solid var(--lq-rose); box-shadow: var(--lq-shadow); border-radius: var(--lq-radius); padding: 1rem 1.5rem;">
        <span>{{ session('success') }}</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup" style="font-size: 0.75rem;"></button>
      </div>
    @endif

    <main id="main">

      <!-- ===================== PAGE HEADER ===================== -->
      <section class="lq-section lq-bg-plum lq-page-offset" style="padding-bottom:5rem">
        <div class="container">
          <div class="row align-items-end">
            <div class="col-lg-8 reveal">
              <nav aria-label="Breadcrumb" style="margin-bottom:1.25rem">
                <span style="font-size:.78rem;letter-spacing:.14em;text-transform:uppercase;color:var(--lq-mauve-soft)">
                  <a href="{{ url('/') }}" style="color:var(--lq-gold-soft)">Beranda</a> &nbsp;/&nbsp; Layanan &amp; Reservasi
                </span>
              </nav>
              <span class="lq-eyebrow">Daftar Layanan Lengkap</span>
              <h1 class="lq-display">Setiap layanan,<br>harga transparan, tanpa biaya tersembunyi.</h1>
            </div>
            <div class="col-lg-4 reveal reveal-d1">
              <p class="lq-lead ms-lg-auto">Jelajahi seluruh menu layanan Amanails Nail Bar di bawah ini &mdash; lalu tentukan jadwal reservasi Anda dalam hitungan menit. Harga sudah termasuk proses sterilisasi alat medis, konsultasi kutikula, dan perawatan pelembap tangan.</p>
              <a class="lq-btn lq-btn-gold" href="#booking" style="margin-top:1.5rem">Langsung ke Reservasi</a>
            </div>
          </div>
        </div>
      </section>

      <!-- ===================== FULL SERVICE MENU ===================== -->
      <section class="lq-section lq-bg-cream" id="menu">
        <div class="container">

          <div class="row gx-5">
            <div class="col-lg-6">
              <!-- Manikur -->
              <div class="lq-menu-group reveal">
                <h3><span class="lq-menu-ico" aria-hidden="true">&#10047;</span> Manikur</h3>
                <p class="lq-menu-note">Pembentukan kuku, perawatan kutikula, buff &amp; poles, serta pijat tangan hangat.</p>
                <ul class="lq-menu-list">
                  <li class="lq-menu-item"><span class="lq-menu-name">Express Tidy<span class="lq-menu-desc">Kikir kilat, minyak kutikula vitamin E, poles kutek 1 lapis</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">20 mnt</span><span class="lq-menu-price">Rp 120.000</span></li>
                  <li class="lq-menu-item"><span class="lq-menu-name">Manikur Klasik<span class="lq-menu-desc">Kikir, pembentukan rapi, pembersihan kutikula, kutek reguler</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">35 mnt</span><span class="lq-menu-price">Rp 180.000</span></li>
                  <li class="lq-menu-item"><span class="lq-menu-name">Spa Manikur Deluxe<span class="lq-menu-desc">Scrub eksfoliasi, rendaman parafin hangat, pijatan tangan ekstra</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">55 mnt</span><span class="lq-menu-price">Rp 260.000</span></li>
                  <li class="lq-menu-item"><span class="lq-menu-name">Manikur Khusus Pria<span class="lq-menu-desc">Pembentukan kuku, perawatan kutikula, buffing alami matte</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">30 mnt</span><span class="lq-menu-price">Rp 160.000</span></li>
                </ul>
              </div>

              <!-- Pedikur -->
              <div class="lq-menu-group reveal reveal-d1">
                <h3><span class="lq-menu-ico" aria-hidden="true">&#10047;</span> Pedikur</h3>
                <p class="lq-menu-note">Rendaman hangat di kursi pijat relaksasi, perawatan tumit, dan pijat kaki.</p>
                <ul class="lq-menu-list">
                  <li class="lq-menu-item"><span class="lq-menu-name">Express Pedikur<span class="lq-menu-desc">Rendam kaki, rapikan kuku kilat, poles kutek cepat</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">30 mnt</span><span class="lq-menu-price">Rp 190.000</span></li>
                  <li class="lq-menu-item"><span class="lq-menu-name">Pedikur Signature<span class="lq-menu-desc">Rendam kaki, scrub kapalan, masker dingin, pijat, kutek</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">50 mnt</span><span class="lq-menu-price">Rp 280.000</span></li>
                  <li class="lq-menu-item"><span class="lq-menu-name">Hot Stone Pedikur<span class="lq-menu-desc">Pedikur Signature ditambah pijatan relaksasi batu basal hangat</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">65 mnt</span><span class="lq-menu-price">Rp 360.000</span></li>
                  <li class="lq-menu-item"><span class="lq-menu-name">Perawatan Tumit Ekstra<span class="lq-menu-desc">Perawatan intensif menghaluskan telapak kaki dan tumit pecah-pecah</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">15 mnt</span><span class="lq-menu-price">Rp 80.000</span></li>
                </ul>
              </div>

              <!-- Kutek Gel -->
              <div class="lq-menu-group reveal reveal-d2 lq-mb-0">
                <h3><span class="lq-menu-ico" aria-hidden="true">&#10047;</span> Kutek Gel (Gel Polish)</h3>
                <p class="lq-menu-note">Warna tahan 2-3 minggu tanpa retak dengan kilau cermin sempurna.</p>
                <ul class="lq-menu-list">
                  <li class="lq-menu-item"><span class="lq-menu-name">Kutek Gel (Tangan / Kaki)<span class="lq-menu-desc">Aplikasi gel premium pada kuku alami yang telah disiapkan</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">40 mnt</span><span class="lq-menu-price">Rp 200.000</span></li>
                  <li class="lq-menu-item"><span class="lq-menu-name">Manikur Gel Lengkap<span class="lq-menu-desc">Manikur lengkap beserta aplikasi warna gel tahan lama</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">50 mnt</span><span class="lq-menu-price">Rp 250.000</span></li>
                  <li class="lq-menu-item"><span class="lq-menu-name">BIAB Overlay (Builder Gel)<span class="lq-menu-desc">Lapisan penguat kuku alami agar tidak mudah patah</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">60 mnt</span><span class="lq-menu-price">Rp 300.000</span></li>
                  <li class="lq-menu-item"><span class="lq-menu-name">Pelepasan &amp; Perawatan Gel<span class="lq-menu-desc">Pelepasan gel lembut tanpa merusak kuku alami</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">30 mnt</span><span class="lq-menu-price">Rp 90.000</span></li>
                </ul>
              </div>
            </div>

            <div class="col-lg-6">
              <!-- Sambung Kuku & Akrilik -->
              <div class="lq-menu-group reveal reveal-d1">
                <h3><span class="lq-menu-ico" aria-hidden="true">&#10047;</span> Akrilik &amp; Sambung Kuku (Extensions)</h3>
                <p class="lq-menu-note">Panjang dan bentuk kuku idaman yang dibentuk presisi &mdash; almond, coffin, atau square.</p>
                <ul class="lq-menu-list">
                  <li class="lq-menu-item"><span class="lq-menu-name">Akrilik Full Set<span class="lq-menu-desc">Sambung kuku akrilik dibentuk tangan + warna gel</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">90 mnt</span><span class="lq-menu-price">Rp 400.000</span></li>
                  <li class="lq-menu-item"><span class="lq-menu-name">Soft Gel Extensions<span class="lq-menu-desc">Tips soft-gel ringan, fleksibel dan tampak sangat alami</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">85 mnt</span><span class="lq-menu-price">Rp 430.000</span></li>
                  <li class="lq-menu-item"><span class="lq-menu-name">Infill &amp; Retouch<span class="lq-menu-desc">Pengisian ulang set kuku setelah 2-3 minggu pemakaian</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">60 mnt</span><span class="lq-menu-price">Rp 260.000</span></li>
                  <li class="lq-menu-item"><span class="lq-menu-name">Perbaikan Kuku Patah (1 Kuku)<span class="lq-menu-desc">Perbaikan atau pembentukan ulang satu kuku ekstensi</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">20 mnt</span><span class="lq-menu-price">Rp 65.000</span></li>
                  <li class="lq-menu-item"><span class="lq-menu-name">Pelepasan Lengkap &amp; Nutrisi Kuku<span class="lq-menu-desc">Pelepasan ekstensi aman disertai vitamin kuku intensif</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">35 mnt</span><span class="lq-menu-price">Rp 130.000</span></li>
                </ul>
              </div>

              <!-- Nail Art -->
              <div class="lq-menu-group reveal reveal-d2">
                <h3><span class="lq-menu-ico" aria-hidden="true">&#10047;</span> Nail Art</h3>
                <p class="lq-menu-note">Harga per kuku, dapat ditambahkan pada semua pilihan layanan warna.</p>
                <ul class="lq-menu-list">
                  <li class="lq-menu-item"><span class="lq-menu-name">French / Ombr&eacute; Tips<span class="lq-menu-desc">Ujung French klasik atau gradasi warna lembut, 10 kuku</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">15 mnt</span><span class="lq-menu-price">Rp 65.000</span></li>
                  <li class="lq-menu-item"><span class="lq-menu-name">Desain Lukis Tangan (Hand-Painted)<span class="lq-menu-desc">Motif bunga, garis abstrak, micro-detail &mdash; per kuku</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">mulai 5 mnt</span><span class="lq-menu-price">Rp 25.000<small>/kuku</small></span></li>
                  <li class="lq-menu-item"><span class="lq-menu-name">Kristal Swarovski &amp; Charm 3D<span class="lq-menu-desc">Aksen kristal mewah dan hiasan 3D berkilau, per kuku</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">mulai 8 mnt</span><span class="lq-menu-price">Rp 40.000<small>/kuku</small></span></li>
                  <li class="lq-menu-item"><span class="lq-menu-name">Efek Chrome / Cat-Eye<span class="lq-menu-desc">Kilau cermin metalik atau efek magnetik mata kucing</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">mulai 4 mnt</span><span class="lq-menu-price">Rp 20.000<small>/kuku</small></span></li>
                </ul>
              </div>

              <!-- Perawatan & Ekstra -->
              <div class="lq-menu-group reveal reveal-d3 lq-mb-0">
                <h3><span class="lq-menu-ico" aria-hidden="true">&#10047;</span> Perawatan &amp; Tambahan</h3>
                <p class="lq-menu-note">Sempurnakan sesi kecantikan Anda &mdash; tanyakan pada terapis kami.</p>
                <ul class="lq-menu-list">
                  <li class="lq-menu-item"><span class="lq-menu-name">Rendaman Lilin Parafin<span class="lq-menu-desc">Perawatan lilin hangat melembapkan kulit tangan/kaki secara mendalam</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">15 mnt</span><span class="lq-menu-price">Rp 75.000</span></li>
                  <li class="lq-menu-item"><span class="lq-menu-name">Pijat Tangan Ekstra<span class="lq-menu-desc">Pijatan titik relaksasi tangan dan pergelangan selama 10 menit</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">10 mnt</span><span class="lq-menu-price">Rp 55.000</span></li>
                  <li class="lq-menu-item"><span class="lq-menu-name">Amanails Cilik (Usia &le; 10 Tahun)<span class="lq-menu-desc">Kikir lembut &amp; poles warna lucu untuk si kecil</span></span><span class="lq-menu-dots" aria-hidden="true"></span><span class="lq-menu-dur">20 mnt</span><span class="lq-menu-price">Rp 90.000</span></li>
                </ul>
              </div>
            </div>
          </div>

          <p class="text-center reveal" style="margin-top:3rem;color:var(--lq-mauve-soft);font-size:.9rem;max-width:60ch;margin-left:auto;margin-right:auto">
            Semua layanan sudah termasuk sterilisasi peralatan, konsultasi kesehatan kuku, dan perawatan tangan khas kami. Harga nail art akan dikonfirmasi terlebih dahulu bersama terapis Anda sebelum proses dimulai.
          </p>
        </div>
      </section>

      <!-- ===================== HYGIENE / REASSURANCE BAND ===================== -->
      <section class="lq-section-sm lq-bg-blush">
        <div class="container">
          <div class="row g-4 text-center">
            <div class="col-md-3 col-6 reveal"><div class="lq-stat"><span class="lq-stat-num" data-count="100" data-suffix="%">0</span><small>Alat Tersterilisasi Medis</small></div></div>
            <div class="col-md-3 col-6 reveal reveal-d1"><div class="lq-stat"><span class="lq-stat-num" data-count="10" data-suffix="-free">0</span><small>Kutek Ramah &amp; Vegan</small></div></div>
            <div class="col-md-3 col-6 reveal reveal-d2"><div class="lq-stat"><span class="lq-stat-num" data-count="5" data-suffix=" Hari">0</span><small>Garansi Poles Ulang Gratis</small></div></div>
            <div class="col-md-3 col-6 reveal reveal-d3"><div class="lq-stat"><span class="lq-stat-num" data-count="7">0</span><small>Terapis Tersertifikasi</small></div></div>
          </div>
        </div>
      </section>

      <!-- ===================== BOOKING ===================== -->
      <section class="lq-section lq-bg-cream" id="booking">
        <div class="container">
          <div class="lq-head lq-head-center reveal">
            <span class="lq-eyebrow lq-eyebrow-center">Reservasi Kursi Anda</span>
            <h2 class="lq-h2">Pesan dalam tiga langkah mudah</h2>
            <p class="lq-lead">Pilih layanan, tentukan terapis favorit, dan pilih jam kunjungan yang pas. Kami akan mengonfirmasi jadwal Anda segera tanpa perlu uang muka untuk layanan standar.</p>
          </div>

          <div class="lq-booking-wrap reveal reveal-d1">
            <div class="lq-booking-grid">
              <div class="lq-booking-side">
                <img src="{{ asset('img/booking-side.jpg') }}" alt="Terapis kuku Amanails Nail Bar sedang mengaplikasikan kutek gel dengan teliti" width="720" height="900" loading="lazy">
                <div class="lq-booking-side-inner">
                  <h3>Santai &mdash; kami siapkan semuanya untuk Anda.</h3>
                  <p>Setiap kunjungan mencakup konsultasi kutikula, welcome drink gratis, dan perawatan tangan hangat yang menenangkan.</p>
                  <ul class="lq-booking-perks">
                    <li>Peralatan higienis dengan autoklaf standar rumah sakit</li>
                    <li>Garansi poles ulang gratis dalam 5 hari untuk set gel</li>
                    <li>Stempel loyalitas di setiap kunjungan Anda</li>
                  </ul>
                </div>
              </div>

              <div class="lq-booking-form">
                <form data-booking-form novalidate>
                  <div class="lq-steps" aria-hidden="true">
                    <span class="lq-step-pill is-done"><span>01</span>Layanan</span>
                    <span class="lq-step-pill is-done"><span>02</span>Terapis</span>
                    <span class="lq-step-pill is-done"><span>03</span>Jadwal</span>
                  </div>

                  <div class="lq-booking-success" data-booking-success role="status" aria-live="polite"></div>

                  <div class="lq-field">
                    <label for="bk-service">Pilihan Layanan <span class="req" aria-hidden="true">*</span></label>
                    <select class="lq-select" id="bk-service" name="service" data-required aria-required="true">
                      <option value="">Pilih jenis layanan&hellip;</option>
                      <option>Manikur Klasik &mdash; Rp 180.000</option>
                      <option>Spa Manikur Deluxe &mdash; Rp 260.000</option>
                      <option>Manikur Gel Lengkap &mdash; Rp 250.000</option>
                      <option>BIAB Overlay &mdash; Rp 300.000</option>
                      <option>Pedikur Signature &mdash; Rp 280.000</option>
                      <option>Hot Stone Pedikur &mdash; Rp 360.000</option>
                      <option>Akrilik Full Set &mdash; Rp 400.000</option>
                      <option>Soft Gel Extensions &mdash; Rp 430.000</option>
                      <option>Infill &amp; Retouch &mdash; Rp 260.000</option>
                      <option>Nail Art Tambahan</option>
                    </select>
                    <span class="lq-field-error">Silakan pilih salah satu layanan.</span>
                  </div>

                  <div class="lq-field">
                    <label for="bk-tech">Pilihan Terapis <span class="req" aria-hidden="true">*</span></label>
                    <select class="lq-select" id="bk-tech" name="technician" data-required aria-required="true">
                      <option value="">Siapa saja / Tanpa preferensi</option>
                      <option>Mia Alvarez &mdash; Nail Art Lead</option>
                      <option>Priya Nair &mdash; Spesialis Gel &amp; BIAB</option>
                      <option>Daniel Okafor &mdash; Spesialis Akrilik &amp; Ekstensi</option>
                      <option>Sofia Bianchi &mdash; Spesialis Pedikur &amp; Spa</option>
                    </select>
                    <span class="lq-field-error">Silakan pilih terapis atau "Tanpa preferensi".</span>
                  </div>

                  <div class="lq-field-row">
                    <div class="lq-field">
                      <label for="bk-date">Tanggal Kunjungan <span class="req" aria-hidden="true">*</span></label>
                      <input class="lq-input" type="date" id="bk-date" name="date" data-required aria-required="true">
                      <span class="lq-field-error">Silakan pilih tanggal kunjungan Anda.</span>
                    </div>
                    <div class="lq-field">
                      <label for="bk-people">Jumlah Tamu</label>
                      <select class="lq-select" id="bk-people" name="guests">
                        <option>1 Orang (Sendiri)</option>
                        <option>2 Orang (Kursi Berdampingan)</option>
                        <option>3&ndash;4 Orang (Rombongan)</option>
                        <option>5+ Orang (Sewa Privat)</option>
                      </select>
                    </div>
                  </div>

                  <div class="lq-field">
                    <label id="slot-label">Pilihan Jam Kunjungan <span class="req" aria-hidden="true">*</span></label>
                    <input type="hidden" name="time" data-slot-value data-required aria-required="true">
                    <div class="lq-slots" data-slots role="group" aria-labelledby="slot-label">
                      <button type="button" class="lq-slot" data-slot="10:00 WIB">10:00</button>
                      <button type="button" class="lq-slot" data-slot="11:30 WIB">11:30</button>
                      <button type="button" class="lq-slot" data-slot="13:00 WIB">13:00</button>
                      <button type="button" class="lq-slot" data-slot="14:30 WIB">14:30</button>
                      <button type="button" class="lq-slot" data-slot="16:00 WIB">16:00</button>
                      <button type="button" class="lq-slot" data-slot="17:30 WIB">17:30</button>
                      <button type="button" class="lq-slot" data-slot="19:00 WIB">19:00</button>
                    </div>
                    <span class="lq-field-error">Silakan tentukan pilihan jam kunjungan.</span>
                  </div>

                  <div class="lq-field-row">
                    <div class="lq-field">
                      <label for="bk-name">Nama Lengkap <span class="req" aria-hidden="true">*</span></label>
                      <input class="lq-input" type="text" id="bk-name" name="name" autocomplete="name" data-required aria-required="true" placeholder="Nama Anda">
                      <span class="lq-field-error">Silakan masukkan nama lengkap Anda.</span>
                    </div>
                    <div class="lq-field">
                      <label for="bk-phone">Nomor HP / WhatsApp <span class="req" aria-hidden="true">*</span></label>
                      <input class="lq-input" type="tel" id="bk-phone" name="phone" autocomplete="tel" data-required aria-required="true" placeholder="08xxxxxxxxxx">
                      <span class="lq-field-error">Kami memerlukan nomor untuk mengirimkan konfirmasi.</span>
                    </div>
                  </div>

                  <div class="lq-field">
                    <label for="bk-email">Alamat Email <span class="req" aria-hidden="true">*</span></label>
                    <input class="lq-input" type="email" id="bk-email" name="email" autocomplete="email" data-required aria-required="true" placeholder="nama@email.com">
                    <span class="lq-field-error">Silakan masukkan alamat email yang valid.</span>
                  </div>

                  <div class="lq-field">
                    <label for="bk-notes">Catatan Khusus (Opsional)</label>
                    <textarea class="lq-textarea" id="bk-notes" name="notes" placeholder="Tautan inspirasi desain, alergi kulit tertentu, atau request khusus&hellip;"></textarea>
                  </div>

                  <button class="lq-btn lq-btn-primary lq-btn-block" type="submit">Kirim Permintaan Reservasi</button>
                  <p style="font-size:.78rem;color:var(--lq-mauve-soft);margin:1rem 0 0;text-align:center">Tidak ada pembayaran di awal. Tim kami akan menghubungi Anda via WhatsApp untuk konfirmasi.</p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ===================== CTA BAND ===================== -->
      <section class="lq-section lq-cta">
        <div class="container">
          <div class="reveal">
            <span class="lq-eyebrow lq-eyebrow-center" style="justify-content:center;color:var(--lq-gold-soft)">Ada Pertanyaan Terlebih Dahulu?</span>
            <h2>Kami Siap Membantu Anda</h2>
            <p>Bingung menentukan jenis perawatan yang paling cocok untuk kondisi kuku Anda? Hubungi studio kami dan tim ahli kami akan dengan senang hati membantu.</p>
            <div class="lq-cta-actions">
              <a class="lq-btn lq-btn-gold" href="tel:+6281234567890">Hubungi (021) 555-0142</a>
              <a class="lq-btn lq-btn-outline" href="{{ url('/') }}#gallery">Lihat Galeri Inspirasi</a>
            </div>
          </div>
        </div>
      </section>

    </main>

    <!-- ===================== FOOTER ===================== -->
    <footer class="lq-footer">
      <div class="container">
        <div class="row g-4">
          <div class="col-lg-4">
            <a class="lq-brand" href="{{ url('/') }}">Amanails<span class="lq-dot">.</span><small>Nail Bar</small></a>
            <p style="margin-top:1.25rem;max-width:32ch">Boutique nail bar estetik dengan perawatan manikur ahli, kutek gel tahan lama, dan nail art lukis tangan di studio yang tenang dan higienis.</p>
            <div class="lq-footer-social">
              <a href="#" aria-label="Amanails di Instagram">Ig</a>
              <a href="#" aria-label="Amanails di Facebook">Fb</a>
              <a href="#" aria-label="Amanails di TikTok">Tk</a>
              <a href="#" aria-label="Amanails di Pinterest">Pin</a>
            </div>
          </div>
          <div class="col-6 col-lg-2">
            <h5>Jelajahi</h5>
            <ul>
              <li><a href="{{ url('/') }}#services">Layanan</a></li>
              <li><a href="{{ url('/') }}#gallery">Galeri</a></li>
              <li><a href="{{ url('/') }}#team">Terapis</a></li>
              <li><a href="{{ url('/') }}#membership">Paket Member</a></li>
              <li><a href="{{ url('/services') }}">Menu Lengkap</a></li>
            </ul>
          </div>
          <div class="col-6 col-lg-2">
            <h5>Kunjungan</h5>
            <ul>
              <li><a href="{{ url('/') }}#visit">Jam Buka</a></li>
              <li><a href="https://maps.google.com/?q=42+Cedar+Hill+Lane" target="_blank" rel="noopener">Petunjuk Lokasi</a></li>
              <li><a href="tel:+6281234567890">(021) 555-0142</a></li>
              <li><a href="mailto:halo@amanails.com">Kirim Email</a></li>
              <li><a href="#booking">Reservasi Sekarang</a></li>
            </ul>
          </div>
          <div class="col-lg-4">
            <h5>Buletin &amp; Promo</h5>
            <p style="max-width:34ch">Dapatkan info warna musiman terbaru, inspirasi nail art, dan penawaran khusus member langsung ke inbox Anda.</p>
            <form class="lq-footer-news" onsubmit="return false" aria-label="Langganan newsletter">
              <label class="visually-hidden" for="news-email">Alamat email</label>
              <input id="news-email" type="email" placeholder="nama@email.com" autocomplete="email">
              <button class="lq-btn lq-btn-gold lq-btn-sm" type="submit">Daftar</button>
            </form>
          </div>
        </div>

        <div class="lq-footer-bottom">
          <p style="margin:0">&copy; {{ date('Y') }} Amanails Nail Bar. Seluruh hak cipta dilindungi.</p>
          <p style="margin:0">Dibuat dengan Bootstrap 5 &middot; <a href="{{ url('/') }}">Kembali ke Beranda</a></p>
        </div>
      </div>
    </footer>

    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
  </body>
</html>
