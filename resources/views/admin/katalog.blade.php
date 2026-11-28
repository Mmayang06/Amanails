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

  </head>
  <body>
    <a class="lq-skip" href="#main">Lewati ke konten utama</a>

    <!-- ===================== NAVBAR (Admin) ===================== -->
    <header class="lq-nav is-scrolled" data-nav>
      <div class="container">
        <a class="lq-brand" href="{{ route('admin.dashboard') }}" aria-label="Amanails Nail Bar — Dashboard Admin">
          Amanails<span class="lq-dot">.</span>
          <small>Nail Bar</small>
        </a>

        <nav class="lq-nav-desktop" aria-label="Navigasi Admin">
          <ul class="lq-nav-links">
            <li><a href="{{ url('/admin/dashboard') }}">Appointment</a></li>
            <li><a href="{{ url('/admin/pembayaran') }}">Pembayaran</a></li>
            <li><a href="{{ url('/admin/cuti') }}">Approve Cuti</a></li>
            <li><a href="{{ url('/admin/katalog') }}" class="is-active">Katalog</a></li>
          </ul>
        </nav>

        <div class="lq-nav-cta d-flex align-items-center gap-2">
          <span class="me-2" style="font-size: 0.82rem; color: var(--lq-mauve);">Halo, <strong>{{ Auth::user()->name ?? 'Admin' }}</strong></span>
          <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="lq-btn lq-btn-outline lq-btn-sm">Keluar</button>
          </form>
        </div>
      </div>
    </header>

    <main id="main">

      <!-- ===================== PAGE HEADER ===================== -->
      <section class="lq-section lq-bg-panel lq-page-offset" style="padding-bottom:3.5rem">
        <div class="container">
          <div class="row align-items-end lq-head">
            <div class="col-lg-8 reveal">
              <span class="lq-eyebrow">Katalog Layanan by Admin</span>
              <h1 class="lq-h2">Daftar Katalog by Admin</h1>
              <p class="lq-lead mb-0">Daftar model kuku dan perawatan yang diunggah oleh Admin di Amanails Nail Bar.</p>
            </div>
          </div>

          <!-- Action: Tambah Desain -->
          <div class="mt-4 mb-2">
            <button type="button" class="lq-btn lq-btn-primary lq-btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahDesain">
              + Tambah Desain
            </button>
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
                
                <div class="lq-shop-card" 
                     data-id="{{ $item['id'] }}" 
                     data-name="{{ $item['name'] }}" 
                     data-price="{{ $item['price'] }}"
                     data-duration="{{ $item['duration'] }}">
                  
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
            <p style="max-width:34ch">Modul Admin: Kelola katalog layanan, persetujuan pembayaran, dan cuti terapis.</p>
          </div>
        </div>

        <div class="lq-footer-bottom">
          <p style="margin:0">&copy; {{ date('Y') }} Amanails Nail Bar. Seluruh hak cipta dilindungi.</p>
          <p style="margin:0"><a href="#main">Kembali ke atas &uarr;</a></p>
        </div>
      </div>
    </footer>

    <!-- ===================== MODAL: TAMBAH DESAIN (Layout Template Services) ===================== -->
    <div class="modal fade" id="modalTambahDesain" tabindex="-1" aria-labelledby="modalTambahDesainLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content" style="border: none; background: transparent; border-radius: var(--lq-radius-lg); overflow: hidden; box-shadow: 0 30px 80px -20px rgba(0,0,0,0.6);">
          
          <div class="lq-booking-wrap" style="position: relative; width: 100%; margin: 0; background: var(--lq-white);">
            <!-- Tombol Tutup Modal -->
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup" 
                    style="position: absolute; top: 1.25rem; right: 1.25rem; z-index: 30; background-color: var(--lq-cream-2); border-radius: 50%; padding: 0.65rem; opacity: 0.85; transition: opacity 0.2s;"></button>

            <div class="lq-booking-grid">
              <!-- Sisi Kiri: Foto Preview Penuh (Sesuai Desain Awal Template, Tanpa Tulisan) -->
              <div class="lq-booking-side">
                <img id="previewSideImg" src="{{ asset('img/booking-side.jpg') }}" alt="Preview Model Kuku" width="720" height="900" loading="lazy" style="opacity: 1; transition: opacity 0.35s ease;">
              </div>

              <!-- Sisi Kanan: Form Reservasi Style (Template Services) -->
              <div class="lq-booking-form" style="max-height: 85vh; overflow-y: auto;">
                <form data-booking-form novalidate id="formTambahDesain">
                  <div class="lq-booking-success" data-booking-success role="status" aria-live="polite"></div>

                  <div class="lq-field">
                    <label for="ds-name">Nama Model / Desain <span class="req" aria-hidden="true">*</span></label>
                    <input class="lq-input" type="text" id="ds-name" name="name" data-required aria-required="true" placeholder="Contoh: Marble Rose Gold Custom Art">
                    <span class="lq-field-error">Silakan masukkan nama model desain.</span>
                  </div>

                  <div class="lq-field">
                    <label for="ds-category">Pilihan Kategori Layanan <span class="req" aria-hidden="true">*</span></label>
                    <select class="lq-select" id="ds-category" name="category" data-required aria-required="true">
                      <option value="">Pilih kategori perawatan&hellip;</option>
                      <option value="gel-polish">Gel Polish</option>
                      <option value="nail-art-custom">Nail Art Custom</option>
                      <option value="nail-extension">Nail Extension</option>
                    </select>
                    <span class="lq-field-error">Silakan pilih kategori layanan.</span>
                  </div>

                  <div class="lq-field-row">
                    <div class="lq-field">
                      <label for="ds-duration">Durasi Pengerjaan (Menit) <span class="req" aria-hidden="true">*</span></label>
                      <input class="lq-input" type="number" id="ds-duration" name="duration" data-required aria-required="true" placeholder="60" value="60">
                      <span class="lq-field-error">Masukkan estimasi durasi pengerjaan.</span>
                    </div>
                    <div class="lq-field">
                      <label for="ds-price">Harga Layanan (Rp) <span class="req" aria-hidden="true">*</span></label>
                      <input class="lq-input" type="number" id="ds-price" name="price" data-required aria-required="true" placeholder="Contoh: 150000" step="5000">
                      <span class="lq-field-error">Silakan tentukan harga layanan.</span>
                    </div>
                  </div>

                  <div class="lq-field">
                    <label for="ds-photo">Upload Foto Model Kuku <span class="req" aria-hidden="true">*</span></label>
                    <input class="lq-input" type="file" id="ds-photo" name="photo" accept="image/*" data-required aria-required="true" style="padding: 0.65rem 0.9rem;">
                    <span class="lq-field-error">Silakan pilih file foto model kuku.</span>
                  </div>

                  <div class="lq-field">
                    <label for="ds-desc">Deskripsi &amp; Detail Perawatan</label>
                    <textarea class="lq-textarea" id="ds-desc" name="description" placeholder="Jelaskan detail perawatan, bahan kutek gel, ornamen 3D, atau gaya lukisan..."></textarea>
                  </div>

                  <button class="lq-btn lq-btn-primary lq-btn-block" type="submit">Simpan &amp; Terbitkan Desain</button>
                  <p style="font-size:.78rem;color:var(--lq-mauve-soft);margin:1rem 0 0;text-align:center">Desain yang ditambahkan akan otomatis muncul di katalog publik Amanails Nail Bar.</p>
                </form>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- Bootstrap Bundle JS & Main Template JS -->
    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const photoInput = document.getElementById('ds-photo');
        const previewSideImg = document.getElementById('previewSideImg');
        const modalEl = document.getElementById('modalTambahDesain');

        if (photoInput && previewSideImg) {
          const defaultSrc = previewSideImg.src;

          photoInput.addEventListener('change', function () {
            const file = this.files && this.files[0];
            if (file && file.type.startsWith('image/')) {
              const reader = new FileReader();
              reader.onload = function (e) {
                previewSideImg.src = e.target.result;
                previewSideImg.style.transition = 'all 0.35s ease';
                previewSideImg.style.opacity = '1';
              };
              reader.readAsDataURL(file);
            } else {
              previewSideImg.src = defaultSrc;
              previewSideImg.style.opacity = '1';
            }
          });

          if (modalEl) {
            modalEl.addEventListener('hidden.bs.modal', function () {
              previewSideImg.src = defaultSrc;
              previewSideImg.style.opacity = '1';
              const successBox = formTambahDesain ? formTambahDesain.querySelector('[data-booking-success]') : null;
              if (successBox) {
                successBox.classList.remove('is-visible');
                successBox.innerHTML = '';
              }
            });
          }
        }

        const formTambahDesain = document.getElementById('formTambahDesain');
        if (formTambahDesain) {
          formTambahDesain.addEventListener('submit', function (e) {
            let allValid = true;
            formTambahDesain.querySelectorAll('[data-required]').forEach(function (el) {
              if (!(el.value || '').trim()) allValid = false;
            });
            if (allValid) {
              const nameInput = document.getElementById('ds-name');
              const nameVal = nameInput ? nameInput.value.trim() : 'Desain Baru';
              setTimeout(function () {
                const successBox = formTambahDesain.querySelector('[data-booking-success]');
                if (successBox) {
                  successBox.innerHTML = '<strong>Desain Berhasil Diterbitkan!</strong> Model "<em>' + nameVal + '</em>" telah disimpan dan otomatis tampil di katalog publik.';
                  successBox.classList.add('is-visible');
                }
              }, 15);
            }
          });
        }
      });
    </script>
  </body>
</html>
