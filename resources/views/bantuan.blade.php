<!DOCTYPE html>
<html lang="id">
  <head>
    <script>document.documentElement.classList.add('js')</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pusat Bantuan &mdash; Amanails Nail Bar</title>
    <meta name="description" content="Informasi panduan pemesanan dan pertanyaan umum di Amanails Nail Bar.">

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
            <li><a href="{{ url('/katalog') }}">Katalog</a></li>
            <li><a href="{{ url('/jadwal') }}">Booking</a></li>
            <li><a href="{{ url('/services') }}">Menu Lengkap</a></li>
            <li><a href="{{ url('/bantuan') }}" class="is-active">Bantuan</a></li>
          </ul>
        </nav>

        <div class="lq-nav-cta d-flex align-items-center gap-2">
          <a class="lq-btn lq-btn-primary lq-btn-sm lq-nav-desktop" href="{{ url('/jadwal') }}">Booking Sekarang</a>
          <button class="lq-nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-controls="mobile-nav" aria-label="Buka menu navigasi">
            <span></span><span></span><span></span>
          </button>
        </div>
      </div>
    </header>

    <main id="main">
      <section class="lq-section lq-bg-panel lq-page-offset" style="padding-bottom:3.5rem">
        <div class="container">
          <div class="lq-head lq-head-center">
            <span class="lq-eyebrow lq-eyebrow-center">Panduan &amp; Bantuan Pelanggan</span>
            <h1 class="lq-h2">Pusat Tanya Jawab (FAQ)</h1>
            <p class="lq-lead" style="max-width:60ch; margin:0 auto;">Segala informasi mengenai cara reservasi online, pemilihan nail artist, serta kebijakan studio Amanails.</p>
          </div>
        </div>
      </section>

      <section class="lq-section lq-bg-cream" style="padding-top:3.5rem; padding-bottom:5rem;">
        <div class="container" style="max-width: 860px;">
          <div class="row g-4">
            <div class="col-12">
              <div class="lq-why-card">
                <div class="lq-why-ico">&#10047;</div>
                <h4>Bagaimana cara memesan jadwal perawatan?</h4>
                <p>Pilih model atau perawatan yang Anda inginkan di halaman <strong>Katalog</strong>, klik tombol "Lanjut Pilih Jadwal", lalu tentukan Nail Artist (Aurel/Mayang) dan slot jam yang berstatus <strong>Tersedia</strong>.</p>
              </div>
            </div>

            <div class="col-12">
              <div class="lq-why-card">
                <div class="lq-why-ico">&#9733;</div>
                <h4>Berapa lama ketahanan kutek gel dan nail art?</h4>
                <p>Kutek gel dan nail art di Amanails bertahan antara 3 hingga 4 minggu dengan perawatan wajar. Kami juga memberikan garansi poles ulang gratis dalam 5 hari jika terjadi kendala pada kuku Anda.</p>
              </div>
            </div>

            <div class="col-12">
              <div class="lq-why-card">
                <div class="lq-why-ico">&#9201;</div>
                <h4>Jam Operasional &amp; Lokasi Studio</h4>
                <p>Amanails buka setiap hari Selasa hingga Minggu pukul 09.00 &ndash; 20.00 WIB (Senin libur). Untuk konsultasi desain khusus langsung via WhatsApp ke CS kami di +62 812-3456-7890.</p>
              </div>
            </div>
          </div>

          <div class="text-center mt-5">
            <a href="{{ url('/katalog') }}" class="lq-btn lq-btn-primary">&larr; Kembali ke Katalog Layanan</a>
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
            <p style="max-width:34ch">Modul Pembeli (Buyer - Sela): Pusat bantuan dan tanya jawab.</p>
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
  </body>
</html>
