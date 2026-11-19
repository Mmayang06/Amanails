<!DOCTYPE html>
<html lang="id">
  <head>
    <script>document.documentElement.classList.add('js')</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Katalog Layanan &mdash; Amanails Nail Bar</title>
    <meta name="description" content="Katalog menu layanan manikur, kutek gel, sambung kuku dan nail art eksklusif di Amanails Nail Bar.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400;1,9..144,500&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
      /* State aktif untuk kartu layanan yang dipilih */
      .lq-shop-card.is-selected {
        border-color: var(--lq-rose);
        box-shadow: 0 16px 40px -15px rgba(183, 110, 121, 0.45);
        background: var(--lq-blush-soft);
      }
      .lq-shop-card.is-selected .btn-select-card {
        background: var(--lq-rose-deep);
        border-color: var(--lq-rose-deep);
        color: #fff;
      }

      /* Floating Bottom Bar bergaya template Plum/Gold */
      .lq-floating-summary {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 1050;
        background: var(--lq-plum-deep);
        border-top: 1px solid var(--lq-gold);
        padding: 1rem 0;
        box-shadow: 0 -10px 30px rgba(36, 24, 32, 0.4);
      }
      body {
        padding-bottom: 95px;
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
            <li><a href="{{ url('/katalog') }}" class="is-active">Katalog</a></li>
            <li><a href="{{ url('/jadwal') }}">Booking</a></li>
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
          <a class="lq-btn lq-btn-primary lq-btn-sm lq-nav-desktop" href="{{ url('/jadwal') }}">Booking Sekarang</a>
          <button class="lq-nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-controls="mobile-nav" aria-label="Buka menu navigasi">
            <span></span><span></span><span></span>
          </button>
        </div>
      </div>
    </header>

    <!-- Drawer Menu Mobile -->
    <div class="lq-nav-mobile" id="mobile-nav" data-nav-mobile>
      <ul>
        <li><a href="{{ url('/katalog') }}" class="is-active">Katalog Layanan</a></li>
        <li><a href="{{ url('/jadwal') }}">Booking &amp; Jadwal</a></li>
        <li><a href="{{ url('/services') }}">Menu Lengkap</a></li>
        <li><a href="{{ url('/bantuan') }}">Bantuan</a></li>
        @auth
          <li><span style="display:block; padding: 0.5rem 0; color: var(--lq-rose); font-size: 0.9rem;">Masuk sebagai <strong>{{ Auth::user()->name }}</strong></span></li>
        @else
          <li><a href="{{ route('login') }}">Masuk</a></li>
          <li><a href="{{ route('register') }}">Daftar Akun Baru</a></li>
        @endauth
      </ul>
      <a class="lq-btn lq-btn-primary lq-btn-block mt-3" href="{{ url('/jadwal') }}">Booking Sekarang</a>
    </div>

    <main id="main">

      <!-- ===================== PAGE HEADER ===================== -->
      <section class="lq-section lq-bg-panel lq-page-offset" style="padding-bottom:3.5rem">
        <div class="container">
          <div class="row align-items-end lq-head">
            <div class="col-lg-7 reveal">
              <span class="lq-eyebrow">Pilihan Perawatan &middot; Sela (Buyer)</span>
              <h1 class="lq-h2">Pilih Jasa &amp; Layanan</h1>
              <p class="lq-lead mb-0">Model kuku diunggah oleh Nail Artist &amp; Admin. Pilih model favorit Anda untuk memeriksa jadwal ketersediaan jam.</p>
            </div>
            <div class="col-lg-5 reveal reveal-d1 mt-4 mt-lg-0">
              <div class="lq-field mb-0">
                <label for="searchInput" style="font-size:0.75rem; letter-spacing:0.12em; text-transform:uppercase; color:var(--lq-mauve);">Cari Perawatan</label>
                <input class="lq-input" type="text" id="searchInput" placeholder="Cari nama atau model nail art..." autocomplete="off">
              </div>
            </div>
          </div>

          <!-- Filter Pills (Menggunakan Class Asli Template .lq-filter-btn) -->
          <div class="lq-gallery-filter mt-4 mb-2">
            @foreach($categories as $cat)
              <button type="button" class="lq-filter-btn {{ $cat['id'] === 'all' ? 'is-active' : '' }}" data-category="{{ $cat['id'] }}">
                {{ $cat['name'] }}
              </button>
            @endforeach
          </div>
        </div>
      </section>

      <!-- ===================== SERVICE CATALOG (Shop Grid Template) ===================== -->
      <section class="lq-section lq-bg-cream" style="padding-top:3.5rem; padding-bottom:5rem;">
        <div class="container">
          <div class="row g-4" id="serviceGrid">
            @foreach($services as $index => $item)
              <div class="col-md-6 col-lg-4 service-col" 
                   data-category="{{ $item['category'] }}"
                   data-name="{{ strtolower($item['name']) }}"
                   data-desc="{{ strtolower($item['description']) }}">
                
                <div class="lq-shop-card {{ $index === 2 ? 'is-selected' : '' }}" 
                     data-id="{{ $item['id'] }}" 
                     data-name="{{ $item['name'] }}" 
                     data-price="{{ $item['price'] }}"
                     data-duration="{{ $item['duration'] }}"
                     style="cursor: pointer;">
                  
                  <div class="lq-shop-media">
                    <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" loading="lazy">
                    <span class="lq-shop-badge">{{ $item['category_label'] }}</span>
                  </div>

                  <div class="lq-shop-body">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                      <span class="lq-shop-cat mb-0">&#9201; {{ $item['duration'] }} Menit</span>
                      <span style="font-size:0.75rem; color:var(--lq-rose-deep); font-weight:600;">
                        By: {{ $item['uploaded_by'] }}
                      </span>
                    </div>

                    <h4 style="margin-bottom: 0.35rem;">{{ $item['name'] }}</h4>
                    <p class="lq-shop-desc">{{ $item['description'] }}</p>
                    
                    <div class="lq-shop-foot">
                      <span class="lq-shop-price">Rp {{ number_format($item['price'], 0, ',', '.') }}</span>
                      <button type="button" class="lq-btn {{ $index === 2 ? 'lq-btn-primary' : 'lq-btn-outline' }} lq-btn-sm btn-select-card">
                        {{ $index === 2 ? '✓ Dipilih' : 'Pilih Layanan' }}
                      </button>
                    </div>
                  </div>

                </div>
              </div>
            @endforeach
          </div>

          <div id="noResults" class="text-center py-5" style="display: none;">
            <span class="lq-menu-ico" style="font-size:2rem; color:var(--lq-rose);">&#10047;</span>
            <h4 class="mt-3">Layanan Tidak Ditemukan</h4>
            <p style="color:var(--lq-mauve);">Silakan gunakan kata kunci lain atau klik filter <strong>Semua</strong>.</p>
          </div>
        </div>
      </section>

    </main>

    <!-- ===================== STICKY BOTTOM SUMMARY (Wireframe CTA in Template Style) ===================== -->
    <div class="lq-floating-summary">
      <div class="container d-flex flex-column flex-sm-row justify-content-between align-items-center gap-3">
        <div>
          <span style="font-size: 0.76rem; letter-spacing: 0.14em; text-transform: uppercase; color: var(--lq-gold-soft); display: block;">
            Layanan Terpilih
          </span>
          <div style="color: #fff; font-size: 1.05rem;">
            <strong id="selectedCountText">1 layanan dipilih</strong> &nbsp;&middot;&nbsp; 
            <span style="font-family: var(--lq-serif); color: var(--lq-gold); font-size: 1.25rem;" id="selectedPriceText">Rp 180.000</span>
          </div>
        </div>

        <div>
          <a href="{{ url('/jadwal?services=3') }}" id="btnNextSchedule" class="lq-btn lq-btn-gold lq-btn-sm">
            Lanjut Pilih Jadwal &rarr;
          </a>
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
            <p style="max-width:34ch">Modul Pembeli (Buyer - Sela): Melihat katalog dan memeriksa jadwal ketersediaan jam.</p>
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
        const cards = document.querySelectorAll('.lq-shop-card');
        const filterBtns = document.querySelectorAll('.lq-filter-btn');
        const searchInput = document.getElementById('searchInput');
        const serviceCols = document.querySelectorAll('.service-col');
        const noResults = document.getElementById('noResults');
        
        const selectedCountText = document.getElementById('selectedCountText');
        const selectedPriceText = document.getElementById('selectedPriceText');
        const btnNextSchedule = document.getElementById('btnNextSchedule');

        // State awal (default id 3: Handpainted Custom Nail Art di-upload oleh Aurel)
        let selectedServices = [
          { id: '3', name: 'Handpainted Custom Nail Art', price: 180000 }
        ];

        function formatRupiah(number) {
          return 'Rp ' + number.toLocaleString('id-ID');
        }

        function updateBottomBar() {
          const count = selectedServices.length;
          const total = selectedServices.reduce((sum, item) => sum + item.price, 0);

          if (count === 0) {
            selectedCountText.textContent = 'Belum ada layanan dipilih';
            selectedPriceText.textContent = 'Rp 0';
            btnNextSchedule.style.opacity = '0.4';
            btnNextSchedule.style.pointerEvents = 'none';
            btnNextSchedule.href = '#';
          } else {
            selectedCountText.textContent = `${count} layanan dipilih`;
            selectedPriceText.textContent = formatRupiah(total);
            btnNextSchedule.style.opacity = '1';
            btnNextSchedule.style.pointerEvents = 'auto';
            const ids = selectedServices.map(s => s.id).join(',');
            btnNextSchedule.href = `{{ url('/jadwal') }}?services=${ids}`;
          }
        }

        cards.forEach(card => {
          card.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const price = parseInt(this.getAttribute('data-price'), 10);
            const btn = this.querySelector('.btn-select-card');

            const existingIndex = selectedServices.findIndex(s => s.id === id);

            if (existingIndex > -1) {
              selectedServices.splice(existingIndex, 1);
              this.classList.remove('is-selected');
              btn.classList.remove('lq-btn-primary');
              btn.classList.add('lq-btn-outline');
              btn.textContent = 'Pilih Layanan';
            } else {
              selectedServices.push({ id, name, price });
              this.classList.add('is-selected');
              btn.classList.remove('lq-btn-outline');
              btn.classList.add('lq-btn-primary');
              btn.textContent = '✓ Dipilih';
            }

            updateBottomBar();
          });
        });

        filterBtns.forEach(btn => {
          btn.addEventListener('click', function () {
            filterBtns.forEach(b => b.classList.remove('is-active'));
            this.classList.add('is-active');
            applyFilterAndSearch();
          });
        });

        searchInput.addEventListener('input', function () {
          applyFilterAndSearch();
        });

        function applyFilterAndSearch() {
          const activeCategory = document.querySelector('.lq-filter-btn.is-active').getAttribute('data-category');
          const query = searchInput.value.toLowerCase().trim();
          let visibleCount = 0;

          serviceCols.forEach(col => {
            const category = col.getAttribute('data-category');
            const name = col.getAttribute('data-name');
            const desc = col.getAttribute('data-desc');

            const matchesCategory = (activeCategory === 'all' || category === activeCategory);
            const matchesQuery = (name.includes(query) || desc.includes(query));

            if (matchesCategory && matchesQuery) {
              col.style.display = 'block';
              visibleCount++;
            } else {
              col.style.display = 'none';
            }
          });

          noResults.style.display = (visibleCount === 0) ? 'block' : 'none';
        }

        updateBottomBar();
      });
    </script>
  </body>
</html>
