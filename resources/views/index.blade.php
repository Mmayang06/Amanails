<!DOCTYPE html>
<html lang="id">
  <head>
    <script>document.documentElement.classList.add('js')</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Amanails &mdash; Boutique Nail Salon &amp; Nail Bar</title>
    <meta name="description" content="Amanails Nail Bar adalah salon kuku butik modern — menu manikur & pedikur lengkap, galeri nail art lukis tangan, reservasi online cepat, terapis tersertifikasi, dan produk ramah lingkungan.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400;1,9..144,500&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  </head>
  <body>
    <a class="lq-skip" href="#main">Lewati ke konten utama</a>

    <!-- ===================== NAVBAR ===================== -->
    <header class="lq-nav" data-nav>
      <div class="container">
        <a class="lq-brand" href="{{ url('/') }}" aria-label="Amanails Nail Bar — Beranda">
          Amanails<span class="lq-dot">.</span>
          <small>Nail Bar</small>
        </a>

        <nav class="lq-nav-desktop" aria-label="Navigasi Utama">
          <ul class="lq-nav-links">
            <li><a href="#services">Layanan</a></li>
            <li><a href="#gallery">Galeri</a></li>
            <li><a href="#booking">Reservasi</a></li>
            <li><a href="#team">Terapis</a></li>
            <li><a href="#shop">Produk</a></li>
            <li><a href="{{ url('/services') }}">Menu Lengkap</a></li>
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
        <li><a href="#services">Layanan</a></li>
        <li><a href="#gallery">Galeri</a></li>
        <li><a href="#booking">Reservasi</a></li>
        <li><a href="#team">Terapis</a></li>
        <li><a href="#membership">Keanggotaan</a></li>
        <li><a href="#shop">Produk</a></li>
        <li><a href="#visit">Kunjungi Kami</a></li>
        <li><a href="{{ url('/services') }}">Menu Lengkap</a></li>
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

      <!-- ===================== HERO ===================== -->
      <section class="lq-hero" id="home">
        <div class="lq-hero-media">
          <img src="{{ asset('img/hero.jpg') }}" alt="Kuku berkilau cantik dan rapi hasil perawatan di Amanails Nail Bar" width="1920" height="1280" fetchpriority="high">
        </div>
        <div class="container">
          <div class="lq-hero-inner">
            <span class="lq-eyebrow">Boutique Nail Bar &middot; Sejak 2014</span>
            <h1>Saat jemari indah Anda<br>menjadi <span class="lq-serif-accent">sentuhan sempurna.</span></h1>
            <p class="lq-hero-sub">Salon kuku butik yang tenang, bersih, dan higienis. Manikur ahli, kutek gel tahan lama, nail art lukis tangan eksklusif, serta minuman relaksasi gratis saat Anda menikmati perawatan terbaik.</p>
            <div class="lq-hero-actions">
              <a class="lq-btn lq-btn-primary" href="#booking">Buat Janji Temu</a>
              <a class="lq-btn lq-btn-outline" href="#services" style="color:#fff;border-color:rgba(255,255,255,.4)">Lihat Layanan</a>
            </div>
            <div class="lq-hero-meta">
              <div><span>4.9&#9733;</span><small>1.200+ ulasan puas</small></div>
              <div><span>12</span><small>Tahun melayani</small></div>
              <div><span>7</span><small>Terapis bersertifikat</small></div>
            </div>
          </div>
        </div>
        <div class="lq-hero-card">
          <div class="lq-stars" aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
          <h4>Walk-in selalu disambut</h4>
          <p>Buka hingga pukul 20.00 di hari kerja. Retouch kutek gel di hari yang sama selalu tersedia &mdash; silakan hubungi kami terlebih dahulu.</p>
        </div>
      </section>

      <!-- ===================== SERVICES / PRICING ===================== -->
      <section class="lq-section lq-bg-cream" id="services">
        <div class="container">
          <div class="row align-items-end lq-head">
            <div class="col-lg-7 reveal">
              <span class="lq-eyebrow">Layanan &amp; Harga</span>
              <h2 class="lq-h2">Menu perawatan untuk<br>kuku sehat, rapi, dan tahan lama.</h2>
            </div>
            <div class="col-lg-5 reveal reveal-d1">
              <p class="lq-lead">Harga transparan, estimasi waktu terukur, serta produk berstandar salon internasional. Setiap sesi diawali konsultasi kesehatan kutikula dan diakhiri dengan pijat tangan hangat. Layanan tambahan lengkap dapat dilihat di menu kami.</p>
            </div>
          </div>

          <div class="row gx-5">
            <div class="col-lg-6">
              <!-- Manikur -->
              <div class="lq-menu-group reveal">
                <h3><span class="lq-menu-ico" aria-hidden="true">&#10047;</span> Manikur</h3>
                <p class="lq-menu-note">Pembentukan kuku, perawatan kutikula, buff &amp; poles, serta pijat tangan hangat.</p>
                <ul class="lq-menu-list">
                  <li class="lq-menu-item">
                    <span class="lq-menu-name">Manikur Klasik<span class="lq-menu-desc">Kikir kuku, rapikan kutikula, poles kutek reguler</span></span>
                    <span class="lq-menu-dots" aria-hidden="true"></span>
                    <span class="lq-menu-dur">35 mnt</span>
                    <span class="lq-menu-price">Rp 180.000</span>
                  </li>
                  <li class="lq-menu-item">
                    <span class="lq-menu-name">Spa Manikur Deluxe<span class="lq-menu-desc">Scrub eksfoliasi, rendaman parafin hangat, pijatan tangan ekstra</span></span>
                    <span class="lq-menu-dots" aria-hidden="true"></span>
                    <span class="lq-menu-dur">55 mnt</span>
                    <span class="lq-menu-price">Rp 260.000</span>
                  </li>
                  <li class="lq-menu-item">
                    <span class="lq-menu-name">Express Tidy<span class="lq-menu-desc">Kikir cepat, vitamin minyak kutikula, poles kutek 1 lapis</span></span>
                    <span class="lq-menu-dots" aria-hidden="true"></span>
                    <span class="lq-menu-dur">20 mnt</span>
                    <span class="lq-menu-price">Rp 120.000</span>
                  </li>
                </ul>
              </div>

              <!-- Pedikur -->
              <div class="lq-menu-group reveal reveal-d1">
                <h3><span class="lq-menu-ico" aria-hidden="true">&#10047;</span> Pedikur</h3>
                <p class="lq-menu-note">Rendaman hangat di kursi pijat relaksasi, perawatan tumit, dan pijat kaki.</p>
                <ul class="lq-menu-list">
                  <li class="lq-menu-item">
                    <span class="lq-menu-name">Pedikur Signature<span class="lq-menu-desc">Rendam kaki, bersihkan kapalan, masker dingin, pijat, kutek</span></span>
                    <span class="lq-menu-dots" aria-hidden="true"></span>
                    <span class="lq-menu-dur">50 mnt</span>
                    <span class="lq-menu-price">Rp 280.000</span>
                  </li>
                  <li class="lq-menu-item">
                    <span class="lq-menu-name">Hot Stone Pedikur<span class="lq-menu-desc">Pedikur signature ditambah pijatan relaksasi batu basal hangat</span></span>
                    <span class="lq-menu-dots" aria-hidden="true"></span>
                    <span class="lq-menu-dur">65 mnt</span>
                    <span class="lq-menu-price">Rp 360.000</span>
                  </li>
                  <li class="lq-menu-item">
                    <span class="lq-menu-name">Express Pedikur<span class="lq-menu-desc">Rendam kaki, rapikan kuku kilat, poles kutek cepat</span></span>
                    <span class="lq-menu-dots" aria-hidden="true"></span>
                    <span class="lq-menu-dur">30 mnt</span>
                    <span class="lq-menu-price">Rp 190.000</span>
                  </li>
                </ul>
              </div>
            </div>

            <div class="col-lg-6">
              <!-- Kutek Gel -->
              <div class="lq-menu-group reveal reveal-d2">
                <h3><span class="lq-menu-ico" aria-hidden="true">&#10047;</span> Kutek Gel (Gel Polish)</h3>
                <p class="lq-menu-note">Warna awet 2-3 minggu tanpa retak dengan kilau cermin tahan lama.</p>
                <ul class="lq-menu-list">
                  <li class="lq-menu-item">
                    <span class="lq-menu-name">Manikur Gel Lengkap<span class="lq-menu-desc">Manikur lengkap beserta aplikasi warna gel tahan lama</span></span>
                    <span class="lq-menu-dots" aria-hidden="true"></span>
                    <span class="lq-menu-dur">50 mnt</span>
                    <span class="lq-menu-price">Rp 250.000</span>
                  </li>
                  <li class="lq-menu-item">
                    <span class="lq-menu-name">Pelepasan &amp; Perawatan Gel<span class="lq-menu-desc">Pelepasan gel lembut tanpa merusak kuku alami</span></span>
                    <span class="lq-menu-dots" aria-hidden="true"></span>
                    <span class="lq-menu-dur">30 mnt</span>
                    <span class="lq-menu-price">Rp 90.000</span>
                  </li>
                  <li class="lq-menu-item">
                    <span class="lq-menu-name">BIAB Overlay (Builder Gel)<span class="lq-menu-desc">Lapisan penguat kuku alami agar tidak mudah patah</span></span>
                    <span class="lq-menu-dots" aria-hidden="true"></span>
                    <span class="lq-menu-dur">60 mnt</span>
                    <span class="lq-menu-price">Rp 300.000</span>
                  </li>
                </ul>
              </div>

              <!-- Akrilik & Ekstensi -->
              <div class="lq-menu-group reveal reveal-d3">
                <h3><span class="lq-menu-ico" aria-hidden="true">&#10047;</span> Akrilik &amp; Sambung Kuku</h3>
                <p class="lq-menu-note">Panjang dan bentuk kuku idaman dibentuk presisi &mdash; almond, coffin, atau square.</p>
                <ul class="lq-menu-list">
                  <li class="lq-menu-item">
                    <span class="lq-menu-name">Akrilik Full Set<span class="lq-menu-desc">Sambung kuku akrilik dibentuk tangan + warna gel</span></span>
                    <span class="lq-menu-dots" aria-hidden="true"></span>
                    <span class="lq-menu-dur">90 mnt</span>
                    <span class="lq-menu-price">Rp 400.000</span>
                  </li>
                  <li class="lq-menu-item">
                    <span class="lq-menu-name">Soft Gel Extensions<span class="lq-menu-desc">Tips soft-gel ringan, fleksibel dan tampak sangat alami</span></span>
                    <span class="lq-menu-dots" aria-hidden="true"></span>
                    <span class="lq-menu-dur">85 mnt</span>
                    <span class="lq-menu-price">Rp 430.000</span>
                  </li>
                  <li class="lq-menu-item">
                    <span class="lq-menu-name">Infill &amp; Retouch<span class="lq-menu-desc">Pengisian ulang set kuku setelah 2-3 minggu pemakaian</span></span>
                    <span class="lq-menu-dots" aria-hidden="true"></span>
                    <span class="lq-menu-dur">60 mnt</span>
                    <span class="lq-menu-price">Rp 260.000</span>
                  </li>
                </ul>
              </div>

              <!-- Nail art -->
              <div class="lq-menu-group reveal reveal-d3 lq-mb-0">
                <h3><span class="lq-menu-ico" aria-hidden="true">&#10047;</span> Nail Art</h3>
                <p class="lq-menu-note">Dihitung per kuku dan dapat ditambahkan ke setiap layanan warna.</p>
                <ul class="lq-menu-list">
                  <li class="lq-menu-item">
                    <span class="lq-menu-name">Desain Lukis Tangan<span class="lq-menu-desc">French tips, gradasi ombr&eacute;, motif bunga, chrome &mdash; per kuku</span></span>
                    <span class="lq-menu-dots" aria-hidden="true"></span>
                    <span class="lq-menu-dur">mulai 5 mnt</span>
                    <span class="lq-menu-price">Rp 25.000<small>/kuku</small></span>
                  </li>
                  <li class="lq-menu-item">
                    <span class="lq-menu-name">Kristal Swarovski &amp; Aksesoris 3D<span class="lq-menu-desc">Aksen permata berkilau dan hiasan 3D elegan</span></span>
                    <span class="lq-menu-dots" aria-hidden="true"></span>
                    <span class="lq-menu-dur">mulai 8 mnt</span>
                    <span class="lq-menu-price">Rp 40.000<small>/kuku</small></span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <div class="text-center reveal" style="margin-top:3rem">
            <a class="lq-btn lq-btn-outline" href="{{ url('/services') }}">Lihat Menu Lengkap &amp; Perawatan Ekstra</a>
          </div>
        </div>
      </section>

      <!-- ===================== GALLERY ===================== -->
      <section class="lq-section lq-bg-blush" id="gallery">
        <div class="container">
          <div class="lq-head lq-head-center reveal">
            <span class="lq-eyebrow lq-eyebrow-center">Galeri Lookbook</span>
            <h2 class="lq-h2">Karya seni kuku dari kursi salon kami</h2>
            <p class="lq-lead">Karya asli dari para terapis di studio kami. Filter berdasarkan gaya favorit Anda, lalu klik desain mana saja untuk melihat detail lebih dekat.</p>
          </div>

          <div data-gallery>
            <div class="lq-filters reveal" role="group" aria-label="Filter galeri berdasarkan gaya">
              <button class="lq-filter-btn is-active" data-filter="all" aria-pressed="true">Semua</button>
              <button class="lq-filter-btn" data-filter="classic" aria-pressed="false">Klasik</button>
              <button class="lq-filter-btn" data-filter="gel" aria-pressed="false">Gel</button>
              <button class="lq-filter-btn" data-filter="art" aria-pressed="false">Art</button>
              <button class="lq-filter-btn" data-filter="seasonal" aria-pressed="false">Musiman</button>
            </div>

            <div class="lq-gallery reveal reveal-d1">
              <button class="lq-gallery-item" type="button" data-style="classic" data-lightbox data-full="{{ asset('img/gallery-1.jpg') }}" data-caption="Ujung French abadi dengan dasar ivory lembut">
                <img src="{{ asset('img/gallery-1.jpg') }}" alt="Manikur French dengan ujung putih rapi di atas dasar merah muda alami" width="600" height="600" loading="lazy">
                <span class="lq-gallery-cap"><span>Klasik</span><strong>Modern French</strong></span>
              </button>
              <button class="lq-gallery-item" type="button" data-style="gel" data-lightbox data-full="{{ asset('img/gallery-2.jpg') }}" data-caption="Kutek gel cherry-red glossy tinggi, bentuk almond">
                <img src="{{ asset('img/gallery-2.jpg') }}" alt="Kuku gel warna merah cherry glossy dalam bentuk almond" width="600" height="600" loading="lazy">
                <span class="lq-gallery-cap"><span>Gel</span><strong>Red Carpet Gel</strong></span>
              </button>
              <button class="lq-gallery-item" type="button" data-style="art" data-lightbox data-full="{{ asset('img/gallery-3.jpg') }}" data-caption="Detail bunga liar yang dilukis tangan di atas dasar sheer">
                <img src="{{ asset('img/gallery-3.jpg') }}" alt="Nail art motif bunga liar lukis tangan elegan" width="600" height="600" loading="lazy">
                <span class="lq-gallery-cap"><span>Art</span><strong>Pressed Florals</strong></span>
              </button>
              <button class="lq-gallery-item" type="button" data-style="seasonal" data-lightbox data-full="{{ asset('img/gallery-4.jpg') }}" data-caption="Set bernuansa tembaga hangat dan amber musim gugur">
                <img src="{{ asset('img/gallery-4.jpg') }}" alt="Set kuku bernuansa tembaga hangat musim gugur" width="600" height="600" loading="lazy">
                <span class="lq-gallery-cap"><span>Musiman</span><strong>Amber Autumn</strong></span>
              </button>
              <button class="lq-gallery-item" type="button" data-style="gel" data-lightbox data-full="{{ asset('img/gallery-5.jpg') }}" data-caption="Gel milky nude dengan efek glazed donut berkilau">
                <img src="{{ asset('img/gallery-5.jpg') }}" alt="Kuku gel nude dengan kilau glazed berkilau halus" width="600" height="600" loading="lazy">
                <span class="lq-gallery-cap"><span>Gel</span><strong>Glazed Nude</strong></span>
              </button>
              <button class="lq-gallery-item" type="button" data-style="art" data-lightbox data-full="{{ asset('img/gallery-6.jpg') }}" data-caption="Finishing mirror-chrome dalam rona rose-gold mewah">
                <img src="{{ asset('img/gallery-6.jpg') }}" alt="Nail art kilau chrome cermin warna rose gold" width="600" height="600" loading="lazy">
                <span class="lq-gallery-cap"><span>Art</span><strong>Rose Chrome</strong></span>
              </button>
              <button class="lq-gallery-item" type="button" data-style="seasonal" data-lightbox data-full="{{ asset('img/gallery-7.jpg') }}" data-caption="Glitter perak dingin memukau untuk suasana pesta">
                <img src="{{ asset('img/gallery-7.jpg') }}" alt="Kuku pesta bertabur glitter perak berkilau" width="600" height="600" loading="lazy">
                <span class="lq-gallery-cap"><span>Musiman</span><strong>Frost &amp; Sparkle</strong></span>
              </button>
              <button class="lq-gallery-item" type="button" data-style="classic" data-lightbox data-full="{{ asset('img/gallery-8.jpg') }}" data-caption="Merah muda blush lembut, pilihan harian yang manis">
                <img src="{{ asset('img/gallery-8.jpg') }}" alt="Manikur glossy merah muda blush lembut harian" width="600" height="600" loading="lazy">
                <span class="lq-gallery-cap"><span>Klasik</span><strong>Blush Everyday</strong></span>
              </button>
              <button class="lq-gallery-item" type="button" data-style="art" data-lightbox data-full="{{ asset('img/gallery-9.jpg') }}" data-caption="Pusaran marmer abu-abu putih dengan serpihan emas">
                <img src="{{ asset('img/gallery-9.jpg') }}" alt="Nail art efek marmer elegan dengan aksen serpihan emas" width="600" height="600" loading="lazy">
                <span class="lq-gallery-cap"><span>Art</span><strong>Marble Swirl</strong></span>
              </button>
            </div>
          </div>
        </div>
      </section>

      <!-- Lightbox modal -->
      <div class="lq-lightbox" data-lightbox-modal role="dialog" aria-modal="true" aria-label="Pratinjau nail art" aria-hidden="true">
        <button class="lq-lb-btn lq-lb-close" type="button" data-lb-close aria-label="Tutup pratinjau">&times;</button>
        <button class="lq-lb-btn lq-lb-prev" type="button" data-lb-prev aria-label="Desain sebelumnya">&#8249;</button>
        <img data-lb-img src="{{ asset('img/gallery-1.jpg') }}" alt="">
        <button class="lq-lb-btn lq-lb-next" type="button" data-lb-next aria-label="Desain berikutnya">&#8250;</button>
        <p class="lq-lightbox-cap" data-lb-cap></p>
      </div>

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
                      <label for="bk-name">Nama Lengkap <span class="req">*</span></label>
                      <input class="lq-input" type="text" id="bk-name" name="name" autocomplete="name" data-required aria-required="true" placeholder="Nama Anda">
                      <span class="lq-field-error">Silakan masukkan nama lengkap Anda.</span>
                    </div>
                    <div class="lq-field">
                      <label for="bk-phone">Nomor HP / WhatsApp <span class="req">*</span></label>
                      <input class="lq-input" type="tel" id="bk-phone" name="phone" autocomplete="tel" data-required aria-required="true" placeholder="08xxxxxxxxxx">
                      <span class="lq-field-error">Kami memerlukan nomor untuk mengirimkan konfirmasi.</span>
                    </div>
                  </div>

                  <div class="lq-field">
                    <label for="bk-email">Alamat Email <span class="req">*</span></label>
                    <input class="lq-input" type="email" id="bk-email" name="email" autocomplete="email" data-required aria-required="true" placeholder="nama@email.com">
                    <span class="lq-field-error">Silakan masukkan alamat email yang valid.</span>
                  </div>

                  <button class="lq-btn lq-btn-primary lq-btn-block" type="submit">Kirim Permintaan Reservasi</button>
                  <p style="font-size:.78rem;color:var(--lq-mauve-soft);margin:1rem 0 0;text-align:center">Tidak ada pembayaran di awal. Tim kami akan menghubungi Anda via WhatsApp untuk konfirmasi.</p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ===================== TECHNICIANS ===================== -->
      <section class="lq-section lq-bg-panel" id="team">
        <div class="container">
          <div class="row align-items-end lq-head">
            <div class="col-lg-8 reveal">
              <span class="lq-eyebrow">Kenali Tim Kami</span>
              <h2 class="lq-h2">Tangan terampil di balik kilau kuku Anda</h2>
            </div>
            <div class="col-lg-4 text-lg-end reveal reveal-d1">
              <p class="lq-lead ms-lg-auto">Tersertifikasi, berdedikasi tinggi, dan ramah. Pilih terapis favorit Anda saat melakukan pemesanan.</p>
            </div>
          </div>

          <div class="row g-4">
            <div class="col-6 col-lg-3 reveal">
              <div class="lq-tech-card">
                <div class="lq-tech-photo">
                  <img src="{{ asset('img/tech-1.jpg') }}" alt="Foto Mia Alvarez, Nail Art Lead di Amanails Nail Bar" width="400" height="400" loading="lazy">
                  <div class="lq-tech-social"><a href="#gallery">Karya</a><a href="#booking">Pesan</a></div>
                </div>
                <h4>Mia Alvarez</h4>
                <p class="lq-tech-role">Nail Art Lead</p>
                <p class="lq-tech-spec">Lukis bunga bebas, efek chrome &amp; mikro-detail</p>
              </div>
            </div>
            <div class="col-6 col-lg-3 reveal reveal-d1">
              <div class="lq-tech-card">
                <div class="lq-tech-photo">
                  <img src="{{ asset('img/tech-2.jpg') }}" alt="Foto Priya Nair, Spesialis Gel & BIAB di Amanails Nail Bar" width="400" height="400" loading="lazy">
                  <div class="lq-tech-social"><a href="#gallery">Karya</a><a href="#booking">Pesan</a></div>
                </div>
                <h4>Priya Nair</h4>
                <p class="lq-tech-role">Spesialis Gel &amp; BIAB</p>
                <p class="lq-tech-spec">Lapisan penguat kuku, nutrisi kuku alami</p>
              </div>
            </div>
            <div class="col-6 col-lg-3 reveal reveal-d2">
              <div class="lq-tech-card">
                <div class="lq-tech-photo">
                  <img src="{{ asset('img/tech-3.jpg') }}" alt="Foto Daniel Okafor, Terapis Akrilik dan Ekstensi di Amanails Nail Bar" width="400" height="400" loading="lazy">
                  <div class="lq-tech-social"><a href="#gallery">Karya</a><a href="#booking">Pesan</a></div>
                </div>
                <h4>Daniel Okafor</h4>
                <p class="lq-tech-role">Spesialis Akrilik &amp; Ekstensi</p>
                <p class="lq-tech-spec">Struktur panjang presisi, bentuk coffin &amp; almond</p>
              </div>
            </div>
            <div class="col-6 col-lg-3 reveal reveal-d3">
              <div class="lq-tech-card">
                <div class="lq-tech-photo">
                  <img src="{{ asset('img/tech-4.jpg') }}" alt="Foto Sofia Bianchi, Spesialis Pedikur dan Spa di Amanails Nail Bar" width="400" height="400" loading="lazy">
                  <div class="lq-tech-social"><a href="#gallery">Karya</a><a href="#booking">Pesan</a></div>
                </div>
                <h4>Sofia Bianchi</h4>
                <p class="lq-tech-role">Spesialis Pedikur &amp; Spa</p>
                <p class="lq-tech-spec">Terapi batu hangat, perawatan tumit &amp; kapalan</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ===================== WHY US ===================== -->
      <section class="lq-section lq-bg-cream" id="why">
        <div class="container">
          <div class="lq-head lq-head-center reveal">
            <span class="lq-eyebrow lq-eyebrow-center">Mengapa Amanails</span>
            <h2 class="lq-h2">Perawatan butik mewah, tanpa kompromi</h2>
          </div>

          <div class="row g-4">
            <div class="col-md-6 col-lg-3 reveal">
              <div class="lq-why-card">
                <div class="lq-why-ico" aria-hidden="true">&#9855;</div>
                <h4>Higienis Standar Medis</h4>
                <p>Seluruh peralatan disterilkan menggunakan autoklaf sebelum setiap sesi dan kikir kuku sekali pakai. Kesehatan Anda adalah prioritas utama.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 reveal reveal-d1">
              <div class="lq-why-card">
                <div class="lq-why-ico" aria-hidden="true">&#10047;</div>
                <h4>Formula Produk Ramah</h4>
                <p>Kami menggunakan kutek 10-free, cruelty-free, dan gel vegan &mdash; aman dan lembut untuk kesehatan kuku alami Anda.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 reveal reveal-d2">
              <div class="lq-why-card">
                <div class="lq-why-ico" aria-hidden="true">&#9200;</div>
                <h4>Walk-in Selalu Disambut</h4>
                <p>Jadwal penuh? Kami selalu mencadangkan kursi khusus untuk pelanggan langsung (walk-in) dan perawatan kilat setiap hari.</p>
              </div>
            </div>
            <div class="col-md-6 col-lg-3 reveal reveal-d3">
              <div class="lq-why-card">
                <div class="lq-why-ico" aria-hidden="true">&#9733;</div>
                <h4>Hadiah Poin Loyalitas</h4>
                <p>Kumpulkan stempel di setiap kunjungan. Layanan ke-10 Anda kami traktir, dan member mendapatkan keuntungan ganda sepanjang musim.</p>
              </div>
            </div>
          </div>

          <div class="row g-3 reveal" style="margin-top:3.5rem">
            <div class="col-6 col-lg-3"><div class="lq-stat"><span class="lq-stat-num" data-count="12">0</span><small>Tahun melayani</small></div></div>
            <div class="col-6 col-lg-3"><div class="lq-stat"><span class="lq-stat-num" data-count="38000" data-suffix="+">0</span><small>Set kuku dipercantik</small></div></div>
            <div class="col-6 col-lg-3"><div class="lq-stat"><span class="lq-stat-num" data-count="4.9">0</span><small>Rating kepuasan ulasan</small></div></div>
            <div class="col-6 col-lg-3"><div class="lq-stat"><span class="lq-stat-num" data-count="60" data-suffix="+">0</span><small>Pilihan warna gel</small></div></div>
          </div>
        </div>
      </section>

      <!-- ===================== MEMBERSHIP ===================== -->
      <section class="lq-section lq-bg-plum" id="membership">
        <div class="container">
          <div class="lq-head lq-head-center reveal">
            <span class="lq-eyebrow lq-eyebrow-center">Keanggotaan &amp; Paket Hemat</span>
            <h2 class="lq-h2">Hemat di setiap kunjungan bersama paket Amanails</h2>
            <p class="lq-lead">Paket prabayar dan keanggotaan bulanan eksklusif untuk pelanggan setia. Jeda atau batalkan kapan saja &mdash; kuota kunjungan berlaku 60 hari.</p>
          </div>

          <div class="lq-pkg reveal reveal-d1">
            <div class="lq-pkg-card">
              <h3>Polish Pass</h3>
              <p class="lq-pkg-sub">Untuk perawatan rutin bulanan</p>
              <div class="lq-pkg-price">Rp 290rb<small>/bln</small></div>
              <ul class="lq-pkg-list">
                <li>1x Manikur klasik setiap bulan</li>
                <li>Diskon 10% untuk nail art &amp; ekstra</li>
                <li>Prioritas reservasi di hari kerja</li>
                <li>Gratis upgrade gel di bulan ulang tahun</li>
              </ul>
              <a class="lq-btn lq-btn-outline lq-btn-block" href="#booking">Pilih Polish Pass</a>
            </div>

            <div class="lq-pkg-card is-featured">
              <span class="lq-pkg-tag">Paling Populer</span>
              <h3>Gel Devotee</h3>
              <p class="lq-pkg-sub">Kuku gel selalu segar tiap 2 minggu</p>
              <div class="lq-pkg-price">Rp 490rb<small>/bln</small></div>
              <ul class="lq-pkg-list">
                <li>2x Manikur gel setiap bulan</li>
                <li>Gratis pelepasan gel lama &amp; retouch</li>
                <li>Diskon 15% untuk produk ritel &amp; ekstensi</li>
                <li>Poin loyalitas stempel ganda</li>
                <li>Gratis tambahan rendaman parafin hangat</li>
              </ul>
              <a class="lq-btn lq-btn-gold lq-btn-block" href="#booking">Pilih Gel Devotee</a>
            </div>

            <div class="lq-pkg-card">
              <h3>The Full Set</h3>
              <p class="lq-pkg-sub">Perawatan menyeluruh tangan &amp; kaki</p>
              <div class="lq-pkg-price">Rp 690rb<small>/bln</small></div>
              <ul class="lq-pkg-list">
                <li>2x Manikur gel + 1x Pedikur lengkap</li>
                <li>Bebas perapian kilat tanpa batas</li>
                <li>Diskon 20% untuk nail art &amp; produk salon</li>
                <li>1x Guest pass untuk mengajak teman tiap bulan</li>
              </ul>
              <a class="lq-btn lq-btn-outline lq-btn-block" href="#booking">Pilih The Full Set</a>
            </div>
          </div>

          <p class="text-center reveal" style="margin-top:2rem;color:var(--lq-mauve-soft);font-size:.9rem">Lebih menyukai tanpa langganan? Tanyakan kartu voucher 5x kunjungan kami &mdash; bayar 4 dapat 5 sesi.</p>
        </div>
      </section>

      <!-- ===================== SHOP ===================== -->
      <section class="lq-section lq-bg-cream" id="shop">
        <div class="container">
          <div class="row align-items-end lq-head">
            <div class="col-lg-7 reveal">
              <span class="lq-eyebrow">Toko Produk Amanails</span>
              <h2 class="lq-h2">Bawa pulang perawatan standar salon</h2>
            </div>
            <div class="col-lg-5 reveal reveal-d1">
              <p class="lq-lead ms-lg-auto">Koleksi kutek dan produk perawatan kuku yang sama dengan yang kami gunakan di studio kami. Masukkan ke tas belanja dan ambil di meja resepsionis saat berkunjung.
                <span class="lq-bag-count" data-bag-count hidden>0</span>
              </p>
            </div>
          </div>

          <div class="row g-4">
            <div class="col-6 col-lg-3 reveal">
              <div class="lq-shop-card">
                <div class="lq-shop-media">
                  <span class="lq-shop-badge">Favorit</span>
                  <img src="{{ asset('img/shop-1.jpg') }}" alt="Botol kutek merah muda blush dari Amanails Nail Bar" width="480" height="360" loading="lazy">
                </div>
                <div class="lq-shop-body">
                  <p class="lq-shop-cat">Kutek Signature</p>
                  <h4>Cedar Hill Blush</h4>
                  <p class="lq-shop-desc">Rona mawar lembut khas kami &mdash; formula vegan dan 10-free.</p>
                  <div class="lq-shop-foot">
                    <span class="lq-shop-price">Rp 140.000</span>
                    <button class="lq-bag-btn" type="button" data-bag-add data-label="Beli">+ Tas Belanja</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6 col-lg-3 reveal reveal-d1">
              <div class="lq-shop-card">
                <div class="lq-shop-media">
                  <img src="{{ asset('img/shop-2.jpg') }}" alt="Minyak kutikula bernutrisi Amanails" width="480" height="360" loading="lazy">
                </div>
                <div class="lq-shop-body">
                  <p class="lq-shop-cat">Nutrisi Kuku</p>
                  <h4>Restore Cuticle Oil</h4>
                  <p class="lq-shop-desc">Formula jojoba &amp; vitamin E agar kuku lentur dan sehat.</p>
                  <div class="lq-shop-foot">
                    <span class="lq-shop-price">Rp 180.000</span>
                    <button class="lq-bag-btn" type="button" data-bag-add data-label="Beli">+ Tas Belanja</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6 col-lg-3 reveal reveal-d2">
              <div class="lq-shop-card">
                <div class="lq-shop-media">
                  <img src="{{ asset('img/shop-3.jpg') }}" alt="Krim tangan shea butter bertekstur lembut" width="480" height="360" loading="lazy">
                </div>
                <div class="lq-shop-body">
                  <p class="lq-shop-cat">Perawatan Tangan</p>
                  <h4>Velvet Hand Cream</h4>
                  <p class="lq-shop-desc">Krim shea butter lembut aroma mawar &mdash; cepat meresap.</p>
                  <div class="lq-shop-foot">
                    <span class="lq-shop-price">Rp 160.000</span>
                    <button class="lq-bag-btn" type="button" data-bag-add data-label="Beli">+ Tas Belanja</button>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-6 col-lg-3 reveal reveal-d3">
              <div class="lq-shop-card">
                <div class="lq-shop-media">
                  <span class="lq-shop-badge">Baru</span>
                  <img src="{{ asset('img/shop-4.jpg') }}" alt="Paket perawatan kuku mandiri di rumah" width="480" height="360" loading="lazy">
                </div>
                <div class="lq-shop-body">
                  <p class="lq-shop-cat">Paket Lengkap</p>
                  <h4>Between-Visits Kit</h4>
                  <p class="lq-shop-desc">Kikir kaca, buffer, minyak kutikula &amp; top coat dalam 1 set.</p>
                  <div class="lq-shop-foot">
                    <span class="lq-shop-price">Rp 390.000</span>
                    <button class="lq-bag-btn" type="button" data-bag-add data-label="Beli">+ Tas Belanja</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ===================== TESTIMONIALS ===================== -->
      <section class="lq-section lq-bg-plum" id="reviews">
        <div class="container">
          <div class="lq-head lq-head-center reveal">
            <span class="lq-eyebrow lq-eyebrow-center">Ulasan Pelanggan</span>
            <h2 class="lq-h2">Dicintai oleh para pelanggan setia kami</h2>
          </div>

          <div class="lq-testi reveal reveal-d1" data-testi>
            <div class="lq-testi-track">
              <div class="lq-testi-slide is-active" data-testi-slide>
                <div class="lq-testi-stars" aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                <p class="lq-testi-quote">&ldquo;Tiga minggu dan kutek gel saya masih tampak berkilau sempurna seperti baru selesai. Lukisan bunga dari Mia sangat memukau &mdash; banyak yang menanyakan salon saya.&rdquo;</p>
                <div class="lq-testi-person">
                  <img src="{{ asset('img/client-1.jpg') }}" alt="Foto Elena, pelanggan setia Amanails" width="52" height="52" loading="lazy">
                  <div><strong>Elena R.</strong><span>Member Gel Devotee</span></div>
                </div>
              </div>
              <div class="lq-testi-slide" data-testi-slide>
                <div class="lq-testi-stars" aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                <p class="lq-testi-quote">&ldquo;Studio sangat higienis, semua peralatan disterilkan, dan mereka benar-benar peduli dengan kesehatan kuku alami saya. Kuku saya jauh lebih kuat dibanding sebelumnya.&rdquo;</p>
                <div class="lq-testi-person">
                  <img src="{{ asset('img/client-2.jpg') }}" alt="Foto Hannah, pelanggan rutin Amanails" width="52" height="52" loading="lazy">
                  <div><strong>Hannah T.</strong><span>Pelanggan Rutin Mingguan</span></div>
                </div>
              </div>
              <div class="lq-testi-slide" data-testi-slide>
                <div class="lq-testi-stars" aria-hidden="true">&#9733;&#9733;&#9733;&#9733;&#9733;</div>
                <p class="lq-testi-quote">&ldquo;Memesan untuk rombongan pengantin beranggotakan enam orang dan pelayanan mereka luar biasa dengan sajian minuman hangat. Kuku tahan sempurna hingga bulan madu usai.&rdquo;</p>
                <div class="lq-testi-person">
                  <img src="{{ asset('img/client-3.jpg') }}" alt="Foto Marcus, pelanggan Amanails" width="52" height="52" loading="lazy">
                  <div><strong>Marcus &amp; Tim Bridal</strong><span>Sewa Studio Privat</span></div>
                </div>
              </div>
            </div>
            <div class="lq-testi-nav" role="tablist" aria-label="Pilih ulasan">
              <button class="lq-testi-dot is-active" type="button" data-testi-dot role="tab" aria-selected="true" aria-label="Ulasan 1"></button>
              <button class="lq-testi-dot" type="button" data-testi-dot role="tab" aria-selected="false" aria-label="Ulasan 2"></button>
              <button class="lq-testi-dot" type="button" data-testi-dot role="tab" aria-selected="false" aria-label="Ulasan 3"></button>
            </div>
          </div>
        </div>
      </section>

      <!-- ===================== VISIT / HOURS ===================== -->
      <section class="lq-section lq-bg-cream" id="visit">
        <div class="container">
          <div class="row g-5 align-items-stretch">
            <div class="col-lg-5 reveal">
              <span class="lq-eyebrow">Jam Buka &amp; Lokasi</span>
              <h2 class="lq-h2">Kunjungi Studio Kami</h2>
              <p class="lq-lead">Terletak strategis di pusat Riverside District. Tersedia parkir luas di depan studio; stasiun dan halte hanya berjarak 2 menit jalan kaki.</p>

              <ul class="lq-hours-list">
                <li><span class="lq-hours-day">Senin &ndash; Jumat</span><span class="lq-hours-time">09:00 &ndash; 20:00 WIB</span></li>
                <li><span class="lq-hours-day">Sabtu</span><span class="lq-hours-time">09:00 &ndash; 18:00 WIB</span></li>
                <li><span class="lq-hours-day">Minggu</span><span class="lq-hours-time lq-hours-closed">Khusus dengan Janji Temu</span></li>
              </ul>

              <div style="margin-top:2rem">
                <div class="lq-contact-line">
                  <span class="lq-ci" aria-hidden="true">&#9906;</span>
                  <div><strong>Alamat Studio</strong>Jl. Melati Indah No. 42, Riverside District</div>
                </div>
                <div class="lq-contact-line">
                  <span class="lq-ci" aria-hidden="true">&#9742;</span>
                  <div><strong>Telepon / WhatsApp</strong><a href="tel:+6281234567890">(021) 555-0142</a></div>
                </div>
                <div class="lq-contact-line">
                  <span class="lq-ci" aria-hidden="true">&#9993;</span>
                  <div><strong>Email</strong><a href="mailto:halo@amanails.com">halo@amanails.com</a></div>
                </div>
              </div>
            </div>

            <div class="col-lg-7 reveal reveal-d1">
              <div class="lq-map">
                <img src="{{ asset('img/map.jpg') }}" alt="Peta lokasi Amanails Nail Bar" width="900" height="600" loading="lazy">
                <div class="lq-map-pin">
                  <a class="lq-btn lq-btn-gold" href="https://maps.google.com/?q=42+Cedar+Hill+Lane" target="_blank" rel="noopener">Buka di Google Maps</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ===================== FAQ ===================== -->
      <section class="lq-section lq-bg-panel" id="faq">
        <div class="container">
          <div class="row g-5">
            <div class="col-lg-4 reveal">
              <span class="lq-eyebrow">Informasi Penting</span>
              <h2 class="lq-h2">Pertanyaan Umum (FAQ)</h2>
              <p class="lq-lead">Masih memiliki pertanyaan? Kirim pesan ke WhatsApp kami di <a href="tel:+6281234567890">(021) 555-0142</a> dan tim kami akan segera membantu Anda.</p>
            </div>
            <div class="col-lg-8 reveal reveal-d1">
              <div class="accordion lq-faq" id="faqAccordion">
                <div class="accordion-item">
                  <h3 class="accordion-header" id="faq1h">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1" aria-expanded="false" aria-controls="faq1">Apakah saya harus membuat janji temu, atau bisa langsung datang (walk-in)?</button>
                  </h3>
                  <div id="faq1" class="accordion-collapse collapse" aria-labelledby="faq1h" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">Keduanya bisa. Kami selalu menyediakan dua kursi khusus untuk layanan langsung (walk-in) dan perawatan kilat setiap hari. Namun, untuk akhir pekan dan jam sibuk sore hari, memesan lebih awal sangat disarankan agar Anda mendapatkan slot pasti dan terapis favorit Anda.</div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h3 class="accordion-header" id="faq2h">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2" aria-expanded="false" aria-controls="faq2">Berapa lama kutek gel bertahan?</button>
                  </h3>
                  <div id="faq2" class="accordion-collapse collapse" aria-labelledby="faq2h" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">Dengan pemakaian normal sehari-hari, kutek gel soak-off kami dapat bertahan dengan kilau tinggi selama dua hingga tiga minggu tanpa terkelupas. Jika ada kuku yang terangkat dalam 5 hari pertama setelah kunjungan Anda, silakan kembali dan kami akan memperbaikinya secara gratis.</div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h3 class="accordion-header" id="faq3h">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3" aria-expanded="false" aria-controls="faq3">Bagaimana standar kebersihan dan higienitas di studio?</button>
                  </h3>
                  <div id="faq3" class="accordion-collapse collapse" aria-labelledby="faq3h" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">Higienitas adalah prioritas utama kami. Peralatan logam disterilkan menggunakan autoklaf standar rumah sakit sebelum setiap pelanggan, kikir dan buffer kuku selalu sekali pakai, dan meja perawatan selalu didisinfeksi menyeluruh. Kami juga menggunakan produk kutek yang aman, ramah vegan, dan bebas bahan kimia keras.</div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h3 class="accordion-header" id="faq4h">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4" aria-expanded="false" aria-controls="faq4">Bolehkah saya membawa foto referensi nail art sendiri?</button>
                  </h3>
                  <div id="faq4" class="accordion-collapse collapse" aria-labelledby="faq4h" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">Tentu saja boleh &mdash; tangkapan layar (screenshot) dari Instagram atau Pinterest adalah cara terbaik untuk menunjukkan gaya yang Anda inginkan. Untuk desain lukisan tangan yang rumit, kami menyarankan memesan dengan Mia dan menyisihkan waktu ekstra. Biaya nail art akan kami informasikan di awal sebelum proses pengerjaan dimulai.</div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h3 class="accordion-header" id="faq5h">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5" aria-expanded="false" aria-controls="faq5">Apakah melayani pemesanan rombongan, pesta, atau bridal shower?</button>
                  </h3>
                  <div id="faq5" class="accordion-collapse collapse" aria-labelledby="faq5h" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">Tentu saja. Anda dapat memilih opsi "Rombongan" atau "Sewa Privat" saat reservasi, dan kami akan menyiapkan kursi berdampingan, minuman penyegar khusus, dan tim terapis khusus. Untuk lima orang atau lebih, silakan hubungi kami untuk merencanakan paket perayaan yang berkesan.</div>
                  </div>
                </div>
                <div class="accordion-item">
                  <h3 class="accordion-header" id="faq6h">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq6" aria-expanded="false" aria-controls="faq6">Bagaimana kebijakan pembatalan atau perubahan jadwal?</button>
                  </h3>
                  <div id="faq6" class="accordion-collapse collapse" aria-labelledby="faq6h" data-bs-parent="#faqAccordion">
                    <div class="accordion-body">Jika ada agenda mendesak, cukup beri tahu kami paling lambat 4 jam sebelum jadwal untuk pembatalan atau perubahan tanpa dikenakan biaya. Untuk reservasi privat rombongan, kami meminta konfirmasi minimal 48 jam sebelumnya.</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- ===================== CTA BAND ===================== -->
      <section class="lq-section lq-cta">
        <div class="container">
          <div class="reveal">
            <span class="lq-eyebrow lq-eyebrow-center" style="justify-content:center;color:var(--lq-gold-soft)">Siap Kapan Saja</span>
            <h2>Jadwalkan Janji Temu Anda</h2>
            <p>Kuku indah terawat hanya selangkah lagi. Reservasi online dalam satu menit, atau hubungi studio kami untuk memesan kursi Anda.</p>
            <div class="lq-cta-actions">
              <a class="lq-btn lq-btn-gold" href="#booking">Reservasi Online</a>
              <a class="lq-btn lq-btn-outline" href="tel:+6281234567890">Hubungi (021) 555-0142</a>
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
              <li><a href="#services">Layanan</a></li>
              <li><a href="#gallery">Galeri</a></li>
              <li><a href="#team">Terapis</a></li>
              <li><a href="#membership">Paket Member</a></li>
              <li><a href="{{ url('/services') }}">Menu Lengkap</a></li>
            </ul>
          </div>
          <div class="col-6 col-lg-2">
            <h5>Kunjungan</h5>
            <ul>
              <li><a href="#visit">Jam Buka</a></li>
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
          <p style="margin:0">Dibuat dengan Bootstrap 5 &middot; <a href="#home">Kembali ke atas &uarr;</a></p>
        </div>
      </div>
    </footer>

    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
  </body>
</html>
