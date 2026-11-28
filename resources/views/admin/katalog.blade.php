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
            <li><a href="{{ url('/admin/cuti') }}">Approve Cuti <span class="adm-nav-badge {{ ($pendingCutiCount ?? 0) === 0 ? 'is-zero' : '' }}">{{ $pendingCutiCount ?? 0 }}</span></a></li>
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

          <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mt-4">
            <button type="button" class="lq-btn lq-btn-primary lq-btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahDesain">
              + Tambah Katalog
            </button>

            <div class="lq-filters mb-0" style="justify-content: flex-end;">
              @foreach($categories as $cat)
                <button type="button" class="lq-filter-btn {{ $cat['id'] === 'all' ? 'is-active' : '' }}" data-service-filter="{{ $cat['id'] }}">
                  {{ $cat['name'] }}
                </button>
              @endforeach
            </div>
          </div>
        </div>
      </section>

      <!-- ===================== SERVICE CATALOG (Shop Grid Template) ===================== -->
      <section class="lq-section lq-bg-cream" style="padding-top:3.5rem; padding-bottom:5rem;">
        <div class="container">
          @if(session('success'))
            <div id="katalogSuccessAlert" class="alert alert-success mb-4" role="alert" style="background: #eef6ee; color: #2e6930; border: 1px solid #d4ebd4; border-radius: var(--lq-radius); padding: 0.9rem 1.15rem; font-size: 0.9rem; transition: opacity 0.4s ease;">
              {{ session('success') }}
            </div>
          @endif

          @if($errors->any())
            <div class="alert alert-danger mb-4" role="alert" style="background: #fdf2f2; color: #a82323; border: 1px solid #f9d4d4; border-radius: var(--lq-radius); padding: 0.9rem 1.15rem; font-size: 0.9rem;">
              <strong>Gagal menyimpan data:</strong>
              <ul class="mb-0 mt-1 ps-3">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <div class="row g-4" id="serviceGrid">
            @foreach($services as $index => $item)
              <div class="col-md-6 col-lg-4 service-col" 
                   data-category="{{ $item['category'] }}"
                   data-service-type="{{ $item['service_type'] }}"
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

              <!-- Sisi Kanan: Form Input Layanan & Katalog (Sesuai Tabel services Database) -->
              <div class="lq-booking-form" style="max-height: 85vh; overflow-y: auto;">
                <form action="{{ route('admin.katalog.store') }}" method="POST" enctype="multipart/form-data" id="formTambahDesain">
                  @csrf

                  <div class="lq-field">
                    <label for="ds-name">Nama Model / Layanan <span class="req" aria-hidden="true">*</span></label>
                    <input class="lq-input" type="text" id="ds-name" name="name" value="{{ old('name') }}" required placeholder="Contoh: Marble Rose Gold Custom Art">
                  </div>

                  <div class="lq-field">
                    <label for="ds-category">Kategori Layanan <span class="req" aria-hidden="true">*</span></label>
                    <select class="lq-select" id="ds-category" name="category" required>
                      <option value="">Pilih kategori layanan&hellip;</option>
                      <option value="gel-polish" {{ old('category') === 'gel-polish' ? 'selected' : '' }}>Gel Polish</option>
                      <option value="nail-art-custom" {{ old('category') === 'nail-art-custom' ? 'selected' : '' }}>Nail art custom</option>
                      <option value="nail-extension" {{ old('category') === 'nail-extension' ? 'selected' : '' }}>Nail Extension</option>
                      <option value="remove" {{ old('category') === 'remove' ? 'selected' : '' }}>Remove</option>
                      <option value="addon" {{ old('category') === 'addon' ? 'selected' : '' }}>Tambahan Hari-H</option>
                      <option value="manicure" {{ old('category') === 'manicure' ? 'selected' : '' }}>Manicure</option>
                    </select>
                  </div>

                  <div class="lq-field-row">
                    <div class="lq-field">
                      <label for="ds-duration">Durasi Pengerjaan (Menit) <span class="req" aria-hidden="true">*</span></label>
                      <input class="lq-input" type="number" id="ds-duration" name="duration" min="0" required placeholder="60" value="{{ old('duration', 60) }}">
                    </div>
                    <div class="lq-field">
                      <label for="ds-price">Harga Layanan (Rp) <span class="req" aria-hidden="true">*</span></label>
                      <input class="lq-input" type="number" id="ds-price" name="price" min="0" step="5000" required placeholder="Contoh: 150000" value="{{ old('price') }}">
                    </div>
                  </div>

                  <div class="lq-field">
                    <label for="ds-photo">Upload Foto Model / Layanan <span class="req" aria-hidden="true">*</span></label>
                    <input class="lq-input" type="file" id="ds-photo" name="image" accept="image/*" required style="padding: 0.65rem 0.9rem;">
                  </div>

                  <div class="lq-field">
                    <label for="ds-desc">Deskripsi &amp; Detail Perawatan</label>
                    <textarea class="lq-textarea" id="ds-desc" name="description" placeholder="Jelaskan detail perawatan, bahan kutek gel, ornamen 3D, atau teknik pengerjaan...">{{ old('description') }}</textarea>
                  </div>

                  <button class="lq-btn lq-btn-primary lq-btn-block" type="submit">Simpan &amp; Tampilkan ke Halaman Pelanggan</button>
                  <p style="font-size:.78rem;color:var(--lq-mauve-soft);margin:1rem 0 0;text-align:center">Layanan yang ditambahkan akan tersimpan di database dan langsung tampil ke pelanggan.</p>
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
        const filterButtons = document.querySelectorAll('[data-service-filter]');
        const serviceCols = document.querySelectorAll('#serviceGrid .service-col');
        const noResultsEl = document.getElementById('noResults');

        filterButtons.forEach(function (btn) {
          btn.addEventListener('click', function () {
            const targetFilter = this.getAttribute('data-service-filter');

            filterButtons.forEach(function (b) {
              b.classList.toggle('is-active', b === btn);
            });

            let visibleCount = 0;
            serviceCols.forEach(function (col) {
              const svcType = col.getAttribute('data-service-type');
              const match = targetFilter === 'all' || svcType === targetFilter;
              col.style.display = match ? '' : 'none';
              if (match) visibleCount++;
            });

            if (noResultsEl) {
              noResultsEl.style.display = visibleCount === 0 ? 'block' : 'none';
            }
          });
        });

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
            });
          }
        }

        const successAlert = document.getElementById('katalogSuccessAlert');
        if (successAlert) {
          setTimeout(function () {
            successAlert.style.opacity = '0';
            setTimeout(function () {
              successAlert.remove();
            }, 400);
          }, 3500);
        }

      });
    </script>
  </body>
</html>
