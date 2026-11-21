<!DOCTYPE html>
<html lang="id">
  <head>
    <script>document.documentElement.classList.add('js')</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Portofolio Terapis &mdash; Amanails Nail Bar</title>
    <meta name="description" content="Koleksi portofolio karya nail art dan perawatan kuku terapis Amanails Nail Bar.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400;1,9..144,500&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
      .lq-terapis-header {
        background: var(--lq-white);
        border-bottom: 1px solid var(--lq-line-soft);
        padding: 1.15rem 0;
        position: sticky;
        top: 0;
        z-index: 100;
      }
      .lq-eyebrow::before,
      .lq-eyebrow::after {
        display: none !important;
      }
      .lq-karya-card {
        background: var(--lq-white);
        border-radius: var(--lq-radius-lg);
        overflow: hidden;
        border: 1px solid var(--lq-line-soft);
        height: 100%;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s var(--lq-ease), box-shadow 0.3s var(--lq-ease);
      }
      .lq-karya-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--lq-shadow);
      }
      .lq-karya-media {
        position: relative;
        height: 220px;
        background: var(--lq-cream-2);
        overflow: hidden;
      }
      .lq-karya-media img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s var(--lq-ease);
      }
      .lq-karya-card:hover .lq-karya-media img {
        transform: scale(1.04);
      }
      .lq-shape-pill {
        display: inline-block;
        padding: 0.3rem 0.65rem;
        border-radius: 9999px;
        font-size: 0.68rem;
        font-weight: 500;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        background: var(--lq-cream-2);
        color: var(--lq-plum-deep);
        border: 1px solid var(--lq-line-soft);
      }
      .lq-shape-radio {
        display: none;
      }
      .lq-shape-label {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.4rem 0.85rem;
        border-radius: var(--lq-radius);
        border: 1px solid var(--lq-line-soft);
        background: var(--lq-white);
        font-size: 0.8rem;
        font-weight: 500;
        color: var(--lq-ink);
        cursor: pointer;
        transition: all 0.2s ease;
      }
      .lq-shape-radio:checked + .lq-shape-label {
        background: var(--lq-plum);
        color: #fff;
        border-color: var(--lq-plum);
        box-shadow: 0 2px 6px rgba(58,40,48,0.25);
      }
    </style>
  </head>
  <body style="background: var(--lq-cream); min-height: 100vh;">

    <!-- ===================== TOPBAR ===================== -->
    <header class="lq-terapis-header">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <!-- Logo & Nav Kembali -->
          <div class="d-flex align-items-center gap-3">
            <a class="lq-brand" href="{{ route('terapis.dashboard') }}" style="font-size: 1.45rem;">
              Amanails<span class="lq-dot">.</span>
              <small style="font-size: 0.65rem;">Nail Bar</small>
            </a>
            <span style="color: var(--lq-line-soft);">|</span>
            <span style="font-size: 0.84rem; font-weight: 500; color: var(--lq-mauve);">Lookbook Portofolio</span>
          </div>

          <!-- Tombol Aksi Topbar (Kembali ke Dashboard) -->
          <div class="d-flex align-items-center gap-2">
            <a href="{{ route('terapis.dashboard') }}" class="lq-btn lq-btn-outline lq-btn-sm">
              &larr; Kembali ke Dashboard
            </a>
            <button type="button" class="lq-btn lq-btn-primary lq-btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahKarya">
              + Tambah Foto Karya
            </button>
          </div>
        </div>
      </div>
    </header>

    <!-- ===================== MAIN CONTENT ===================== -->
    <main class="py-4 py-lg-5">
      <div class="container">

        <!-- Header Section (Judul: Portofolio Terapis) -->
        <div class="mb-4">
          <span class="lq-eyebrow" style="font-size: 0.72rem; margin-bottom: 0.35rem; display: block;">Galeri Terapis</span>
          <h1 style="font-family: var(--lq-serif); font-size: 2.2rem; color: var(--lq-ink); margin-bottom: 0.35rem;">
            Portofolio Terapis
          </h1>
          <p style="color: var(--lq-mauve); margin-bottom: 0; font-size: 0.95rem;">
            Dokumentasi karya dari <strong>{{ $terapis['nama'] }}</strong> &middot; {{ $terapis['role'] }} ({{ $terapis['meja_kerja'] }}).
          </p>
        </div>

        <!-- Filter Tab Kategori Bentuk Kuku -->
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4 pb-2" style="border-bottom: 1px solid var(--lq-line-soft);">
          <div class="d-flex align-items-center gap-1 flex-wrap">
            <span style="font-size: 0.8rem; color: var(--lq-mauve); margin-right: 0.5rem; font-weight: 500;">Filter Bentuk:</span>
            <button type="button" class="lq-filter-btn is-active" style="padding: 0.35rem 0.8rem; font-size: 0.75rem;" onclick="filterKarya('semua', this)">Semua</button>
            @foreach($nailShapes as $shape)
              <button type="button" class="lq-filter-btn" style="padding: 0.35rem 0.8rem; font-size: 0.75rem;" onclick="filterKarya('{{ strtolower($shape) }}', this)">{{ $shape }}</button>
            @endforeach
          </div>
          <span style="font-size: 0.82rem; color: var(--lq-mauve);" id="karyaCountLabel">
            Menampilkan {{ count($karyaTerapis) }} karya
          </span>
        </div>

        <!-- Grid Galeri Karya Terapis -->
        <div class="row g-4" id="karyaGrid">
          @foreach($karyaTerapis as $karya)
            <div class="col-sm-6 col-lg-3 karya-item" data-shape="{{ strtolower($karya['nail_shape']) }}">
              <div class="lq-karya-card">
                <!-- Foto Karya -->
                <div class="lq-karya-media">
                  <img src="{{ $karya['img'] }}" alt="{{ $karya['judul'] }}">
                  <div style="position: absolute; top: 0.85rem; right: 0.85rem;">
                    <span class="lq-shape-pill" style="background: rgba(250,245,242,0.92); backdrop-filter: blur(4px);">
                      {{ $karya['nail_shape'] }}
                    </span>
                  </div>
                </div>

                <!-- Konten Kartu -->
                <div class="p-3 d-flex flex-column justify-content-between flex-grow-1">
                  <div>
                    <div class="d-flex justify-content-between align-items-center mb-1">
                      <span style="font-size: 0.72rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--lq-rose-deep); font-weight: 500;">
                        {{ $karya['gaya'] }}
                      </span>
                      <small style="font-size: 0.75rem; color: var(--lq-mauve-soft);">{{ $karya['tanggal'] }}</small>
                    </div>
                    <h4 style="font-family: var(--lq-serif); font-size: 1.18rem; color: var(--lq-ink); margin-bottom: 0.35rem;">
                      {{ $karya['judul'] }}
                    </h4>
                    <p style="font-size: 0.82rem; color: var(--lq-mauve); line-height: 1.45; margin-bottom: 0.75rem;">
                      {{ $karya['deskripsi'] }}
                    </p>
                  </div>

                  <div class="d-flex justify-content-between align-items-center pt-2" style="border-top: 1px solid var(--lq-line-soft);">
                    <div class="d-flex align-items-center gap-2">
                      <span style="font-size: 0.78rem; color: var(--lq-rose-deep); font-weight: 500;">
                        &hearts; {{ $karya['suka'] }} suka
                      </span>
                      <span style="font-size: 0.75rem; color: var(--lq-mauve);">·</span>
                      <span style="font-size: 0.75rem; color: var(--lq-mauve); font-weight: 500;">⏱ {{ $karya['durasi'] ?? '60 Menit' }}</span>
                    </div>
                    <button type="button" class="btn btn-sm btn-link p-0 text-decoration-none" style="font-size: 0.78rem; color: var(--lq-mauve);" onclick="alert('Model: {{ $karya['judul'] }}\nBentuk Kuku: {{ $karya['nail_shape'] }}\nEstimasi Waktu: {{ $karya['durasi'] ?? '60 Menit' }}\nTeknik: {{ $karya['deskripsi'] }}')">
                      Detail &rarr;
                    </button>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>

      </div>
    </main>

    <!-- ===================== MODAL TAMBAH FOTO KARYA ===================== -->
    <div class="modal fade" id="modalTambahKarya" tabindex="-1" aria-labelledby="modalTambahKaryaLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: var(--lq-radius-lg); border: 1px solid var(--lq-line-soft); box-shadow: var(--lq-shadow); background: var(--lq-white);">
          <div class="modal-header" style="background: var(--lq-cream); border-bottom: 1px solid var(--lq-line-soft); padding: 1.5rem 1.8rem;">
            <div>
              <span class="lq-eyebrow" style="font-size: 0.68rem; margin-bottom: 2px;">Lookbook Terapis</span>
              <h4 class="modal-title" id="modalTambahKaryaLabel" style="font-family: var(--lq-serif); font-size: 1.45rem; color: var(--lq-ink); margin: 0;">Tambah Foto Karya Baru</h4>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body" style="padding: 1.8rem;">
            <form id="formKarya" onsubmit="event.preventDefault(); submitKarya();">
              <div class="lq-field mb-3">
                <label for="judulKarya">Nama / Model Karya <span class="req">*</span></label>
                <input type="text" class="lq-input" id="judulKarya" placeholder="Contoh: Glazed Nude Shimmer, Aurora Cat Eye..." required>
              </div>

              <div class="row g-3 mb-3">
                <div class="col-md-7">
                  <div class="lq-field mb-0">
                    <label for="kategoriKarya">Kategori Nail Art <span class="req">*</span></label>
                    <select class="lq-select" id="kategoriKarya" required>
                      <option value="">Pilih kategori nail art...</option>
                      <option value="Hand-painted Nail Art">Nail Art Lukis Tangan (Hand-painted)</option>
                      <option value="Chrome & Metallic">Chrome, Glazed & Metallic</option>
                      <option value="Cat Eye & Velvet">Cat Eye & Velvet Finish</option>
                      <option value="Gel Extension & BIAB">Gel Extension / BIAB Overlay</option>
                      <option value="Classic & French">Classic French / Minimalist</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-5">
                  <div class="lq-field mb-0">
                    <label for="durasiKarya">Estimasi Pengerjaan <span class="req">*</span></label>
                    <select class="lq-select" id="durasiKarya" required>
                      <option value="45 Menit">45 Menit</option>
                      <option value="60 Menit" selected>60 Menit</option>
                      <option value="75 Menit">75 Menit</option>
                      <option value="90 Menit">90 Menit</option>
                      <option value="105 Menit">105 Menit</option>
                      <option value="120 Menit">120 Menit (2 Jam)</option>
                    </select>
                  </div>
                </div>
              </div>

              <!-- NAIL SHAPE SELECTOR (7 BENTUK KUKU) -->
              <div class="lq-field mb-3">
                <label style="margin-bottom: 0.4rem;">Pilih Bentuk Kuku (Nail Shape) <span class="req">*</span></label>
                <div class="d-flex flex-wrap gap-2">
                  @foreach($nailShapes as $index => $shape)
                    <div>
                      <input type="radio" class="lq-shape-radio" name="nail_shape" id="shape_{{ strtolower($shape) }}" value="{{ $shape }}" {{ $index === 0 ? 'checked' : '' }} required>
                      <label class="lq-shape-label" for="shape_{{ strtolower($shape) }}">
                        {{ $shape }}
                      </label>
                    </div>
                  @endforeach
                </div>
              </div>

              <div class="lq-field mb-3">
                <label for="inputFotoKarya">Unggah File Foto Karya <span class="req">*</span></label>
                <input type="file" class="lq-input" id="inputFotoKarya" accept="image/*" onchange="previewKarya(event)" required>
              </div>

              <!-- Preview Foto Unggahan -->
              <div id="boxPreviewKarya" class="mb-3 text-center" style="display: none;">
                <div style="position: relative; width: 100%; height: 180px; border-radius: var(--lq-radius); overflow: hidden; border: 1px solid var(--lq-line-soft);">
                  <img id="imgPreviewKarya" src="" alt="Preview Foto" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <small style="font-size: 0.75rem; color: var(--lq-mauve); display: block; margin-top: 4px;">Foto karya yang akan diunggah</small>
              </div>

              <div class="lq-field mb-0">
                <label for="deskripsiKarya">Catatan Bahan / Shade Warna (Opsional)</label>
                <textarea class="lq-textarea" id="deskripsiKarya" placeholder="Nomor shade kutek, merek base/top coat, teknik kuas..." style="min-height: 70px;"></textarea>
              </div>

              <div class="d-flex justify-content-end gap-2 pt-3 mt-3" style="border-top: 1px solid var(--lq-line-soft);">
                <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="lq-btn lq-btn-primary lq-btn-sm">Simpan ke Portofolio</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer -->
    <footer style="padding: 1.8rem 0; border-top: 1px solid var(--lq-line-soft); text-align: center; font-size: 0.82rem; color: var(--lq-mauve); background: var(--lq-cream);">
      &copy; {{ date('Y') }} Amanails Nail Bar &middot; Khusus Akses Internal Terapis
    </footer>

    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script>
      var uploadedKaryaImgUrl = '';

      function previewKarya(event) {
        var file = event.target.files[0];
        if (file) {
          var reader = new FileReader();
          reader.onload = function(e) {
            uploadedKaryaImgUrl = e.target.result;
            document.getElementById('imgPreviewKarya').src = uploadedKaryaImgUrl;
            document.getElementById('boxPreviewKarya').style.display = 'block';
          };
          reader.readAsDataURL(file);
        }
      }

      function submitKarya() {
        var judul = document.getElementById('judulKarya').value.trim();
        var kategori = document.getElementById('kategoriKarya').value;
        var durasi = document.getElementById('durasiKarya').value || '60 Menit';
        var deskripsi = document.getElementById('deskripsiKarya').value.trim() || 'Aplikasi teknik salon butik Amanails.';
        
        var shapeChecked = document.querySelector('input[name="nail_shape"]:checked');
        var shape = shapeChecked ? shapeChecked.value : 'Almond';

        if (!judul || !kategori) {
          alert('Silakan lengkapi nama dan kategori karya.');
          return;
        }

        var imgSrc = uploadedKaryaImgUrl || '{{ asset('img/gallery-4.jpg') }}';

        // Tutup modal
        var modalEl = document.getElementById('modalTambahKarya');
        var modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();

        // Tambah ke grid karya
        var grid = document.getElementById('karyaGrid');
        var col = document.createElement('div');
        col.className = 'col-sm-6 col-lg-3 karya-item';
        col.setAttribute('data-shape', shape.toLowerCase());
        col.innerHTML = '<div class="lq-karya-card">' +
                        '<div class="lq-karya-media">' +
                        '<img src="' + imgSrc + '" alt="' + judul + '">' +
                        '<div style="position: absolute; top: 0.85rem; right: 0.85rem;">' +
                        '<span class="lq-shape-pill" style="background: rgba(250,245,242,0.92); backdrop-filter: blur(4px);">' + shape + '</span>' +
                        '</div>' +
                        '</div>' +
                        '<div class="p-3 d-flex flex-column justify-content-between flex-grow-1">' +
                        '<div>' +
                        '<div class="d-flex justify-content-between align-items-center mb-1">' +
                        '<span style="font-size: 0.72rem; letter-spacing: 0.12em; text-transform: uppercase; color: var(--lq-rose-deep); font-weight: 500;">' + kategori + '</span>' +
                        '<small style="font-size: 0.75rem; color: var(--lq-mauve-soft);">Hari ini</small>' +
                        '</div>' +
                        '<h4 style="font-family: var(--lq-serif); font-size: 1.18rem; color: var(--lq-ink); margin-bottom: 0.35rem;">' + judul + '</h4>' +
                        '<p style="font-size: 0.82rem; color: var(--lq-mauve); line-height: 1.45; margin-bottom: 0.75rem;">' + deskripsi + '</p>' +
                        '</div>' +
                        '<div class="d-flex justify-content-between align-items-center pt-2" style="border-top: 1px solid var(--lq-line-soft);">' +
                        '<div class="d-flex align-items-center gap-2">' +
                        '<span style="font-size: 0.78rem; color: var(--lq-rose-deep); font-weight: 500;">&hearts; 0 suka</span>' +
                        '<span style="font-size: 0.75rem; color: var(--lq-mauve);">·</span>' +
                        '<span style="font-size: 0.75rem; color: var(--lq-mauve); font-weight: 500;">⏱ ' + durasi + '</span>' +
                        '</div>' +
                        '<button type="button" class="btn btn-sm btn-link p-0 text-decoration-none" style="font-size: 0.78rem; color: var(--lq-mauve);" onclick="alert(\'Model: ' + judul + '\\nBentuk Kuku: ' + shape + '\\nEstimasi Waktu: ' + durasi + '\\nTeknik: ' + deskripsi + '\')">Detail &rarr;</button>' +
                        '</div>' +
                        '</div>' +
                        '</div>';

        grid.insertBefore(col, grid.firstChild);

        alert('Foto karya "' + judul + '" (' + shape + ' · Estimasi ' + durasi + ') berhasil ditambahkan ke lookbook!');
        document.getElementById('formKarya').reset();
        document.getElementById('boxPreviewKarya').style.display = 'none';
        uploadedKaryaImgUrl = '';
      }

      function filterKarya(shape, btn) {
        var items = document.querySelectorAll('.karya-item');
        var buttons = document.querySelectorAll('.lq-filter-btn');
        buttons.forEach(function(b) { b.classList.remove('is-active'); });
        if (btn) btn.classList.add('is-active');

        var visibleCount = 0;
        items.forEach(function(item) {
          var itemShape = item.getAttribute('data-shape');
          if (shape === 'semua' || itemShape === shape) {
            item.style.display = 'block';
            visibleCount++;
          } else {
            item.style.display = 'none';
          }
        });

        document.getElementById('karyaCountLabel').innerText = 'Menampilkan ' + visibleCount + ' karya';
      }
    </script>
  </body>
</html>
