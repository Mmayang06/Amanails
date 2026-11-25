<!DOCTYPE html>
<html lang="id">
  <head>
    <script>document.documentElement.classList.add('js')</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Terapis &mdash; Amanails Nail Bar</title>
    <meta name="description" content="Dashboard terapis Amanails Nail Bar untuk melihat jadwal janji temu dan catatan khusus klien.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400;1,9..144,500&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/terapis.css') }}">
  </head>
  <body style="background: var(--lq-cream); min-height: 100vh;">

    <!-- ===================== TOPBAR ===================== -->
    <header class="lq-terapis-header">
      <div class="container">
        <div class="d-flex justify-content-between align-items-center">
          <!-- Logo -->
          <div class="d-flex align-items-center">
            <a class="lq-brand" href="{{ route('terapis.dashboard') }}" style="font-size: 1.45rem;">
              Amanails<span class="lq-dot">.</span>
              <small style="font-size: 0.65rem;">Nail Bar</small>
            </a>
          </div>

          <!-- Navigasi Menu Burger (Icon Garis Tumpuk) -->
          <div class="dropdown">
            <button class="lq-menu-burger" type="button" id="menuTerapisToggle" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Buka Menu Navigasi" title="Menu Navigasi">
              <span></span>
              <span></span>
              <span></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end lq-portal-dropdown" aria-labelledby="menuTerapisToggle">
              <li>
                <a class="dropdown-item" href="{{ route('terapis.karya') }}">
                  Portofolio Saya
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('terapis.cuti') }}">
                  Pengajuan Cuti
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </header>

    <!-- ===================== MAIN CONTENT ===================== -->
    <main class="py-4 py-lg-5">
      <div class="container">

        <!-- Banner Profil Terapis (Sesuai Kartu Unggulan Template .lq-pkg-card.is-featured) -->
        <div class="lq-pkg-card is-featured mb-4" style="transform: none; padding: 2.2rem 2.4rem;">
          <div class="mb-2">
            <span class="lq-pkg-tag" style="position: static; display: inline-block; margin-bottom: 0.45rem; font-size: 0.62rem;">
              {{ $terapis['meja_kerja'] }}
            </span>
            <h2 style="color: #fff; font-size: 1.85rem; margin-bottom: 0.2rem; font-family: var(--lq-serif);">
              Selamat Bekerja, {{ $terapis['nama'] }}!
            </h2>
            <p style="color: var(--lq-mauve-soft); margin-bottom: 0; font-size: 0.88rem;">
              {{ $terapis['role'] }} &middot; Bergabung sejak {{ $terapis['bergabung_sejak'] }}
            </p>
          </div>
          <p style="color: rgba(255,255,255,0.85); font-size: 0.92rem; margin-bottom: 0;">
            Spesialisasi: <em>{{ $terapis['spesialisasi'] }}</em>
          </p>
        </div>

        <!-- 3 Baris Kartu Metrik Terpisah Sesuai Desain Template -->
        <div class="row g-3 mb-4">
          <div class="col-md-4">
            <div class="lq-appt-card text-center mb-0 p-4">
              <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Jadwal</span>
              <div style="font-family: var(--lq-serif); font-size: 2.8rem; color: var(--lq-rose-deep); line-height: 1; margin-bottom: 0.35rem;">
                {{ $statistik['janji_hari_ini'] }}
              </div>
              <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Janji Hari Ini</div>
              <small style="font-size: 0.8rem; color: var(--lq-mauve);">Jadwal aktif di meja kerja</small>
            </div>
          </div>

          <div class="col-md-4">
            <div class="lq-appt-card text-center mb-0 p-4">
              <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Performa Bulanan</span>
              <div style="font-family: var(--lq-serif); font-size: 2.8rem; color: var(--lq-plum); line-height: 1; margin-bottom: 0.35rem;">
                {{ $statistik['total_pelanggan_bulan_ini'] }}
              </div>
              <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Total Pelanggan Dilayani</div>
              <small style="font-size: 0.8rem; color: var(--lq-mauve);">Perawatan selesai bulan ini</small>
            </div>
          </div>

          <div class="col-md-4">
            <div class="lq-appt-card text-center mb-0 p-4">
              <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Klien Baru</span>
              <div style="font-family: var(--lq-serif); font-size: 2.8rem; color: var(--lq-gold); line-height: 1; margin-bottom: 0.35rem;">
                {{ $statistik['klien_baru_bulan_ini'] }}
              </div>
              <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Pelanggan Baru</div>
              <small style="font-size: 0.8rem; color: var(--lq-mauve);">Kunjungan pertama bulan ini</small>
            </div>
          </div>
        </div>

        <!-- ================= JADWAL PERAWATAN & KALENDER BOOKING (FULL WIDTH) ================= -->
        <div class="mb-5">
          <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-2">
              <div>
                <span class="lq-eyebrow" style="margin-bottom: 0.15rem;">Jadwal Perawatan</span>
                <h2 style="font-size: 1.5rem; margin-bottom: 0; font-family: var(--lq-serif);" id="scheduleMainHeading">Janji Temu Hari Ini ({{ count($jadwalHariIni) }})</h2>
              </div>
              <div class="d-flex align-items-center gap-2">
                <button type="button" id="btnTabHariIni" class="lq-view-toggle-btn is-active" onclick="switchScheduleView('hariIni')">
                  Hari Ini ({{ count($jadwalHariIni) }})
                </button>
                <button type="button" id="btnTabKalender" class="lq-view-toggle-btn" onclick="switchScheduleView('kalender')">
                  Kalender Booking
                </button>
              </div>
            </div>

            <!-- VIEW 1: DAFTAR JANJI TEMU HARI INI -->
            <div id="viewHariIni">
              <div class="d-flex justify-content-end mb-3">
                <div class="lq-filters m-0" role="group" aria-label="Filter antrean">
                  <button type="button" class="lq-filter-btn is-active" style="padding: 0.4rem 0.85rem; font-size: 0.75rem;" onclick="filterJadwal('semua', this)">Semua</button>
                  <button type="button" class="lq-filter-btn" style="padding: 0.4rem 0.85rem; font-size: 0.75rem;" onclick="filterJadwal('berlangsung', this)">Berjalan</button>
                  <button type="button" class="lq-filter-btn" style="padding: 0.4rem 0.85rem; font-size: 0.75rem;" onclick="filterJadwal('menunggu', this)">Menunggu</button>
                </div>
              </div>

              <!-- List Kartu Jadwal Klien (Elegan Sesuai Desain Butik Template Amanails) -->
              <div id="jadwalContainer">
              @foreach($jadwalHariIni as $index => $item)
                <div class="lq-appt-card" id="card-{{ $item['id'] }}" data-status="{{ strtolower(str_replace(' ', '', $item['status'])) }}">
                  
                  <!-- Baris Header: Waktu, Lokasi Meja & Status Badges -->
                  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3 pb-2" style="border-bottom: 1px solid var(--lq-line-soft);">
                    <div class="d-flex align-items-baseline gap-2">
                      <span style="font-family: var(--lq-serif); font-size: 1.35rem; font-weight: 500; color: var(--lq-ink);">{{ $item['jam'] }}</span>
                      <span style="font-size: 0.82rem; color: var(--lq-mauve);">({{ $item['durasi'] }}) &middot; {{ $item['kursi'] }}</span>
                    </div>

                    <!-- Badges (Hanya Member atau Pelanggan Baru, Sesuai Permintaan) -->
                    <div class="d-flex align-items-center gap-2">
                      <span class="lq-pkg-tag" id="badge-{{ $item['id'] }}" style="position: static; font-size: 0.62rem; padding: 0.35rem 0.7rem; {{ $item['status'] === 'Selesai' ? 'background: #eef6ee; color: #27ae60;' : ($item['status'] === 'Sedang Berlangsung' ? 'background: var(--lq-gold); color: var(--lq-plum-deep);' : 'background: var(--lq-cream-2); color: var(--lq-mauve);') }}">
                        {{ $item['status'] }}
                      </span>

                      @if($item['tipe_klien'] === 'Member')
                        <span class="lq-pkg-tag" style="position: static; font-size: 0.62rem; padding: 0.35rem 0.7rem; background: var(--lq-blush); color: var(--lq-rose-deep);">
                          MEMBER
                        </span>
                      @else
                        <span class="lq-pkg-tag" style="position: static; font-size: 0.62rem; padding: 0.35rem 0.7rem; background: var(--lq-cream-2); color: var(--lq-ink); border: 1px solid var(--lq-line-soft);">
                          PELANGGAN BARU
                        </span>
                      @endif
                    </div>
                  </div>

                  <!-- Informasi Klien & Menu Perawatan -->
                  <div class="mb-3">
                    <span class="lq-eyebrow" style="font-size: 0.68rem; margin-bottom: 0.15rem;">Klien Amanails</span>
                    <h3 style="font-size: 1.4rem; margin-bottom: 0.25rem; font-family: var(--lq-serif); color: var(--lq-ink);">
                      {{ $item['klien'] }}
                    </h3>
                    <div style="color: var(--lq-rose-deep); font-weight: 500; font-size: 0.95rem; margin-bottom: 0.35rem;">
                      {{ $item['layanan'] }}
                    </div>
                    <p style="color: var(--lq-mauve); font-size: 0.84rem; margin: 0;">
                      WhatsApp: <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $item['kontak']) }}" target="_blank" style="color: var(--lq-mauve); text-decoration: none;">{{ $item['kontak'] }}</a>
                    </p>
                  </div>

                  <!-- Catatan Permintaan Klien (Tipografi Miring Halus Butik) -->
                  @if(!empty($item['catatan']))
                    <div class="mb-3 pt-2 pb-1" style="border-top: 1px dashed var(--lq-line-soft);">
                      <p style="font-size: 0.86rem; color: var(--lq-ink); font-style: italic; margin: 0;">
                        &ldquo;{{ $item['catatan'] }}&rdquo;
                      </p>
                    </div>
                  @endif

                  <!-- Tombol Aksi Terapis Sesuai Tombol Asli Template -->
                  <div class="d-flex justify-content-end align-items-center flex-wrap gap-2 pt-2" style="border-top: 1px solid var(--lq-line-soft);">
                    <div class="d-flex gap-2" id="action-{{ $item['id'] }}">
                      @if($item['status'] === 'Sedang Berlangsung')
                        <button type="button" class="lq-btn lq-btn-primary lq-btn-sm" onclick="bukaKasirPelunasan('{{ $item['id'] }}')">
                          Selesai Perawatan
                        </button>
                      @elseif($item['status'] === 'Menunggu')
                        <button type="button" class="lq-btn lq-btn-gold lq-btn-sm" onclick="mulaiLayanan('{{ $item['id'] }}')">
                          Mulai Perawatan
                        </button>
                      @else
                        <span style="font-size: 0.84rem; color: #27ae60; font-weight: 500; align-self: center;">Perawatan Selesai</span>
                      @endif
                      <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" onclick="bukaKasirPelunasan('{{ $item['id'] }}')">
                        Detail &amp; Kasir Pelunasan
                      </button>
                    </div>
                  </div>

                </div>
              @endforeach
            </div>
          </div>

          <!-- VIEW 2: KALENDER 1 BULAN KEDEPAN -->
          <div id="viewKalender" style="display: none;">
            <!-- Kalender Widget Card -->
            <div class="lq-calendar-card">
              <!-- Kalender Navigasi Atas -->
              <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3 pb-2" style="border-bottom: 1px solid var(--lq-line-soft);">
                <div>
                  <span class="lq-eyebrow" style="font-size: 0.68rem; margin-bottom: 0.15rem;">Bulan &amp; Tahun</span>
                  <h3 id="calMonthTitle" style="font-family: var(--lq-serif); font-size: 1.45rem; margin: 0; color: var(--lq-ink);">November 2026</h3>
                </div>
                <div class="d-flex align-items-center gap-2">
                  <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" style="padding: 0.35rem 0.75rem;" onclick="changeCalMonth(-1)">‹ Sebelumnya</button>
                  <button type="button" class="lq-btn lq-btn-sm" style="background: var(--lq-cream-2); border: 1px solid var(--lq-line-soft); font-size: 0.75rem; padding: 0.35rem 0.75rem;" onclick="goToTodayCal()">Hari Ini</button>
                  <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" style="padding: 0.35rem 0.75rem;" onclick="changeCalMonth(1)">Berikutnya ›</button>
                </div>
              </div>

              <!-- Legend Indikator -->
              <div class="d-flex align-items-center gap-3 mb-3 flex-wrap" style="font-size: 0.76rem; color: var(--lq-mauve);">
                <span class="d-flex align-items-center gap-1">
                  <span style="width: 10px; height: 10px; background: var(--lq-gold); border-radius: 2px; display: inline-block;"></span> Hari Ini (21 Nov)
                </span>
                <span class="d-flex align-items-center gap-1">
                  <span style="width: 10px; height: 10px; background: rgba(162,93,107,0.3); border-radius: 2px; display: inline-block;"></span> Ada Klien Booking
                </span>
                <span class="d-flex align-items-center gap-1">
                  <span style="width: 10px; height: 10px; background: var(--lq-plum); border-radius: 2px; display: inline-block;"></span> Tanggal Dipilih
                </span>
              </div>

              <!-- Grid Hari Header -->
              <div class="lq-calendar-grid mb-1">
                <div class="lq-cal-day-head">Sen</div>
                <div class="lq-cal-day-head">Sel</div>
                <div class="lq-cal-day-head">Rab</div>
                <div class="lq-cal-day-head">Kam</div>
                <div class="lq-cal-day-head">Jum</div>
                <div class="lq-cal-day-head">Sab</div>
                <div class="lq-cal-day-head" style="color: var(--lq-rose-deep);">Min</div>
              </div>

              <!-- Grid Sel Hari -->
              <div id="calGridCells" class="lq-calendar-grid">
                <!-- Rendered dynamically by JS -->
              </div>
            </div>

            <!-- Detail Janji Temu Tanggal Terpilih -->
            <div class="mb-4">
              <div class="d-flex justify-content-between align-items-baseline mb-3 flex-wrap gap-2">
                <div>
                  <span class="lq-eyebrow" style="margin-bottom: 0.15rem;">Detail Jadwal Harian</span>
                  <h3 id="selectedDateTitle" style="font-family: var(--lq-serif); font-size: 1.35rem; margin: 0; color: var(--lq-ink);">
                    Sabtu, 21 November 2026
                  </h3>
                </div>
                <span id="selectedDateCountBadge" class="lq-pkg-tag" style="position: static; font-size: 0.72rem; padding: 0.35rem 0.85rem; background: var(--lq-plum); color: #fff;">
                  5 Klien Terjadwal
                </span>
              </div>

              <div id="detailKalenderContainer">
                <!-- Rendered dynamically by JS -->
              </div>
            </div>
          </div>
        </div>

        <!-- ================= GALERI & PORTOFOLIO KARYA TERAPIS (DI BAWAH JADWAL) ================= -->
        <div class="lq-pkg-card mb-4" style="padding: 2.2rem 2.4rem;">
          <div class="d-flex justify-content-between align-items-end flex-wrap gap-3 mb-4 pb-3" style="border-bottom: 1px solid var(--lq-line-soft);">
            <div>
              <span class="lq-eyebrow" style="margin-bottom: 0.25rem;">Galeri &amp; Portofolio Studio</span>
              <h3 style="font-size: 1.65rem; margin-bottom: 0.25rem; font-family: var(--lq-serif); color: var(--lq-ink);">
                Koleksi Portofolio Terapis
              </h3>
              <p class="lq-pkg-sub" style="margin: 0;">Dokumentasi hasil karya nail art &amp; manikur terbaru oleh {{ $terapis['nama'] }}</p>
            </div>
            <div class="d-flex align-items-center gap-2">
              <button type="button" class="lq-btn lq-btn-primary lq-btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahKarya">
                + Tambah Foto Karya
              </button>
              <a href="{{ route('terapis.karya') }}" class="lq-btn lq-btn-outline lq-btn-sm">
                Lihat Semua Portofolio &rarr;
              </a>
            </div>
          </div>

          <!-- Grid Preview Karya (Full Width Responsive) -->
          <div class="row g-3" id="karyaContainer">
            @foreach($karyaTerapis as $karya)
              <div class="col-6 col-md-4 col-lg-2">
                <div style="position: relative; border-radius: var(--lq-radius); overflow: hidden; height: 160px; border: 1px solid var(--lq-line-soft); background: var(--lq-cream-2);">
                  <img src="{{ $karya['img'] }}" alt="{{ $karya['judul'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                  <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(42,29,37,0.88), transparent 60%); display: flex; flex-direction: column; justify-content: flex-end; padding: 0.65rem; color: #fff;">
                    <span style="font-size: 0.8rem; font-weight: 500; line-height: 1.2; margin-bottom: 0.2rem;">{{ $karya['judul'] }}</span>
                    <small style="font-size: 0.68rem; color: var(--lq-gold-soft);">&hearts; {{ $karya['suka'] }} suka &middot; {{ $karya['nail_shape'] }}</small>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
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
                <input type="text" class="lq-input" id="judulKarya" placeholder="Contoh: Aurora Chrome Glazed, Velvet Cat Eye..." required>
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
                  @foreach(['Square', 'Squoval', 'Round', 'Oval', 'Almond', 'Coffin', 'Stiletto'] as $idx => $shape)
                    <div>
                      <input type="radio" class="lq-shape-radio" name="nail_shape" id="dash_shape_{{ strtolower($shape) }}" value="{{ $shape }}" {{ $idx === 4 ? 'checked' : '' }} required>
                      <label class="lq-shape-label" for="dash_shape_{{ strtolower($shape) }}">
                        {{ $shape }}
                      </label>
                    </div>
                  @endforeach
                </div>
              </div>

              <div class="lq-field mb-3">
                <label for="inputFotoKarya">Unggah Foto Karya <span class="req">*</span></label>
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
                <textarea class="lq-textarea" id="deskripsiKarya" placeholder="Catat nomor shade kutek, top coat, atau teknik yang digunakan..." style="min-height: 70px;"></textarea>
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

    <!-- ===================== MODAL DETAIL APPOINTMENT & KASIR PELUNASAN HARI-H ===================== -->
    <div class="modal fade" id="modalKasirPelunasan" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content" style="border-radius: var(--lq-radius-lg); border: 1px solid var(--lq-line-soft); box-shadow: var(--lq-shadow); background: var(--lq-white); overflow: hidden;">
          <div class="modal-header" style="background: var(--lq-plum); color: #fff; padding: 1.25rem 1.6rem;">
            <div>
              <span class="lq-eyebrow" style="font-size: 0.68rem; color: var(--lq-gold-soft); margin-bottom: 2px;">Kasir &amp; Pelunasan Studio</span>
              <h4 class="modal-title" style="font-family: var(--lq-serif); font-size: 1.35rem; color: #fff; margin: 0;">Hitung Totalan &amp; Pelunasan Perawatan</h4>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>

          <div class="modal-body p-4" style="background: var(--lq-cream);">
            
            <!-- Detail Klien & Status Booking -->
            <div class="p-3 mb-3" style="background: #fff; border: 1px solid var(--lq-line-soft); border-radius: var(--lq-radius);">
              <div class="row g-2 align-items-center">
                <div class="col-sm-6">
                  <small style="font-size: 0.72rem; color: var(--lq-mauve); text-transform: uppercase;">Pelanggan</small>
                  <div style="font-size: 1.05rem; font-weight: 600; color: var(--lq-ink);" id="kasirClientName">Sela (Buyer)</div>
                  <div style="font-size: 0.8rem; color: var(--lq-mauve);" id="kasirClientPhone">WhatsApp: 0812-9876-5432</div>
                </div>
                <div class="col-sm-6 text-sm-end">
                  <small style="font-size: 0.72rem; color: var(--lq-mauve); text-transform: uppercase;">Jadwal &amp; Meja</small>
                  <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-rose-deep);" id="kasirScheduleTime">09:00 - 10:30 WIB &bull; Station 01</div>
                  <div style="font-size: 0.8rem; color: var(--lq-mauve);" id="kasirArtistName">Terapis: Mia Alvarez</div>
                </div>
              </div>

              <!-- Status Referensi Website -->
              <div id="kasirReferenceBanner" class="mt-2 pt-2" style="border-top: 1px dashed var(--lq-line-soft);">
                <!-- Diisi dinamis oleh JS: apakah konsumen dari website atau tanpa referensi website -->
              </div>

              <!-- Foto Referensi Desain Klien (Jika Request Desain Sendiri) -->
              <div id="kasirDesignPhotoBox" class="mt-2 pt-2" style="border-top: 1px dashed var(--lq-line-soft); display: none;">
                <div class="d-flex align-items-center gap-3">
                  <img id="kasirDesignPhotoImg" src="" alt="Desain Referensi Klien" style="width: 58px; height: 58px; object-fit: cover; border-radius: 8px; border: 1px solid var(--lq-line);">
                  <div>
                    <span class="badge" style="background: var(--lq-blush); color: var(--lq-rose-deep); font-size: 0.72rem;">Request Desain Klien</span>
                    <div style="font-size: 0.82rem; font-style: italic; color: var(--lq-ink); margin-top: 2px;" id="kasirDesignNote">"Lilac floral &amp; aksen emas"</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- BAGIAN 1: LAYANAN UTAMA (Booking Awal / Dipilih di Tempat) -->
            <div class="mb-3 p-3" style="background: #fff; border: 1px solid var(--lq-line-soft); border-radius: var(--lq-radius);">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                  <label style="font-weight: 600; font-size: 0.88rem; color: var(--lq-plum); margin: 0;">
                    1. Layanan Utama Perawatan
                  </label>
                  <small style="font-size: 0.75rem; color: var(--lq-mauve); display: block;" id="kasirPrimarySubtitle">
                    Paket perawatan pokok yang dikerjakan untuk klien
                  </small>
                </div>
                <span class="badge" id="kasirPrimaryCountBadge" style="background: var(--lq-cream-2); color: var(--lq-ink); font-size: 0.72rem;">0 Layanan</span>
              </div>

              <!-- Tabel Daftar Layanan Utama -->
              <div style="border: 1px solid var(--lq-line-soft); border-radius: 6px; overflow: hidden; margin-bottom: 0.75rem;">
                <table class="table mb-0" style="font-size: 0.85rem;">
                  <tbody id="kasirInitialServicesTable">
                    <!-- Di-render oleh JavaScript -->
                  </tbody>
                </table>
              </div>

              <!-- Form Tambah Layanan Utama (Sangat berguna bagi klien tanpa referensi website) -->
              <div class="p-2 rounded" style="background: var(--lq-cream-2); border: 1px dashed var(--lq-line-soft);">
                <small style="font-size: 0.76rem; font-weight: 600; color: var(--lq-plum); display: block; margin-bottom: 4px;">
                  + Tambah Layanan Utama (Pilih Katalog / Input Sendiri):
                </small>
                <div class="row g-2 align-items-center">
                  <div class="col-sm-7">
                    <select class="lq-select" id="kasirPresetPrimary" style="font-size: 0.82rem; padding: 0.4rem 0.6rem;">
                      <option value="" disabled selected>Pilih Layanan Utama Katalog...</option>
                      <option value="Russian Manicure (Deep Cuticle Care)" data-price="65000">Russian Manicure (Deep Cuticle) - Rp 65.000</option>
                      <option value="Manikur Gel Lengkap" data-price="120000">Manikur Gel Lengkap - Rp 120.000</option>
                      <option value="BIAB Overlay (Builder Gel)" data-price="140000">BIAB Overlay (Builder Gel) - Rp 140.000</option>
                      <option value="Soft Gel Extension Full Set" data-price="180000">Soft Gel Extension Full Set - Rp 180.000</option>
                      <option value="Handpainted Custom Nail Art" data-price="150000">Handpainted Custom Nail Art - Rp 150.000</option>
                      <option value="Spa Manikur Deluxe &amp; Parafin" data-price="110000">Spa Manikur Deluxe &amp; Parafin - Rp 110.000</option>
                      <option value="Infill &amp; Retouch Gel" data-price="130000">Infill &amp; Retouch Gel - Rp 130.000</option>
                      <option value="custom" data-price="0">+ Input Custom Layanan Lainnya...</option>
                    </select>
                  </div>
                  <div class="col-sm-3" id="kasirCustomPrimaryPriceCol" style="display: none;">
                    <input type="number" class="lq-input" id="kasirCustomPrimaryPrice" placeholder="Harga (Rp)" style="font-size: 0.82rem; padding: 0.4rem 0.6rem;">
                  </div>
                  <div class="col-sm-2">
                    <button type="button" class="lq-btn lq-btn-sm lq-btn-block" id="btnKasirAddPrimaryService" style="background: var(--lq-plum); color: #fff; padding: 0.42rem 0.5rem; font-size: 0.78rem;">
                      + Tambah
                    </button>
                  </div>
                </div>
              </div>
            </div>

            <!-- BAGIAN 2: TAMBAHAN LAYANAN HARI-H (Manik-manik, Charms, Ekstra Gel, dll) -->
            <div class="p-3 mb-3" style="background: #fbf5f2; border: 1px solid var(--lq-rose-soft, #eedbd8); border-radius: var(--lq-radius);">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                  <label style="font-weight: 600; font-size: 0.88rem; color: var(--lq-plum); margin: 0;">
                    2. Tambahan Layanan Hari-H (Saat Treatment di Kursi)
                  </label>
                  <small style="font-size: 0.75rem; color: var(--lq-mauve); display: block;">
                    Manik-manik, kristal Swarovski, aksen chrome, 3D art, extension per jari, dll.
                  </small>
                </div>
                <span class="badge" id="kasirAddonsCountBadge" style="background: var(--lq-rose-deep); color: #fff; font-size: 0.72rem;">0 Tambahan</span>
              </div>

              <!-- Input Tambah Item Ekstra -->
              <div class="row g-2 align-items-center mb-2">
                <div class="col-sm-7">
                  <select class="lq-select" id="kasirPresetAddon" style="font-size: 0.82rem; padding: 0.45rem 0.65rem;">
                    <option value="" disabled selected>Pilih Tambahan Hari-H (Manik-manik, dll)...</option>
                    <option value="Aksesoris Manik-manik &amp; Pearls" data-price="25000">Aksesoris Manik-manik &amp; Pearls (+Rp 25.000)</option>
                    <option value="Kristal Swarovski Halus" data-price="35000">Kristal Swarovski Halus (+Rp 35.000)</option>
                    <option value="Aksen Chrome / Aurora Powder" data-price="30000">Aksen Chrome / Aurora Powder (+Rp 30.000)</option>
                    <option value="Cat Eye &amp; Velvet Effect" data-price="25000">Cat Eye &amp; Velvet Effect (+Rp 25.000)</option>
                    <option value="3D Ribbon / Gel Emboss Art" data-price="40000">3D Ribbon / Gel Emboss Art (+Rp 40.000)</option>
                    <option value="Ekstra Layer Builder Gel (BIAB)" data-price="40000">Ekstra Layer Builder Gel (+Rp 40.000)</option>
                    <option value="Nail Tip Extension Tambahan (2 Jari)" data-price="35000">Nail Tip Extension Tambahan (2 Jari) (+Rp 35.000)</option>
                    <option value="Hapus / Remove Kutek Gel Lama" data-price="30000">Hapus / Remove Kutek Gel Lama (+Rp 30.000)</option>
                    <option value="Spa Hand Massage &amp; Pelembap" data-price="30000">Spa Hand Massage &amp; Pelembap (+Rp 30.000)</option>
                    <option value="custom" data-price="0">+ Input Custom Tambahan Lainnya...</option>
                  </select>
                </div>
                <div class="col-sm-3" id="kasirCustomPriceCol" style="display: none;">
                  <input type="number" class="lq-input" id="kasirCustomPrice" placeholder="Harga (Rp)" style="font-size: 0.82rem; padding: 0.45rem 0.65rem;">
                </div>
                <div class="col-sm-2">
                  <button type="button" class="lq-btn lq-btn-primary lq-btn-block" id="btnKasirAddService" style="padding: 0.45rem 0.65rem; font-size: 0.8rem;">
                    + Tambah
                  </button>
                </div>
              </div>

              <!-- Daftar Item Tambahan Hari-H -->
              <div id="kasirAddonsList" style="background: #fff; border: 1px solid var(--lq-line-soft); border-radius: 6px; padding: 0.5rem 0.75rem; min-height: 40px;">
                <div id="kasirNoAddonsText" style="font-size: 0.78rem; color: var(--lq-mauve); font-style: italic; text-align: center; padding: 4px;">
                  Belum ada tambahan layanan hari-h. Pilih opsi di atas jika klien menambah manik-manik/aksesoris.
                </div>
                <ul id="kasirAddonsUl" style="list-style: none; padding: 0; margin: 0;"></ul>
              </div>
            </div>

            <!-- BAGIAN 3: REKAPITULASI TAGIHAN & PENGURANGAN DP 50.000 -->
            <div class="p-3 mb-3" style="background: #fff; border: 1px solid var(--lq-line-soft); border-radius: var(--lq-radius);">
              <span class="lq-eyebrow" style="font-size: 0.65rem; color: var(--lq-mauve); margin-bottom: 0.2rem; display: block;">Rincian Total Tagihan</span>
              
              <div class="d-flex justify-content-between py-1" style="font-size: 0.85rem; color: var(--lq-mauve);">
                <span>Subtotal Layanan Utama</span>
                <span id="kasirValInitialTotal" style="font-weight: 500; color: var(--lq-ink);">Rp 0</span>
              </div>
              <div class="d-flex justify-content-between py-1" style="font-size: 0.85rem; color: var(--lq-mauve);">
                <span>Tambahan Hari-H (Manik-manik &amp; Aksesoris)</span>
                <span id="kasirValAddonsTotal" style="color: var(--lq-rose-deep); font-weight: 600;">+ Rp 0</span>
              </div>
              <div class="d-flex justify-content-between py-1" style="font-size: 0.88rem; font-weight: 600; color: var(--lq-ink); border-top: 1px dashed var(--lq-line-soft); padding-top: 4px; margin-top: 2px;">
                <span>Total Biaya Perawatan</span>
                <span id="kasirValGrandTotal">Rp 0</span>
              </div>
              
              <!-- Potongan DP Rp 50.000 Sesuai Permintaan -->
              <div class="d-flex justify-content-between align-items-center py-2 px-2 mt-2 rounded" style="background: #f0f9f1; border: 1px solid #c9ebd0; font-size: 0.85rem;">
                <label class="d-flex align-items-center gap-2 m-0" style="cursor: pointer; color: #1e7e34; font-weight: 500;">
                  <input type="checkbox" id="kasirDpCheckbox" checked onchange="toggleDpDeduction()">
                  <span>Potong Uang Muka (DP Booking)</span>
                </label>
                <span id="kasirValDpPaid" style="color: #27ae60; font-weight: 700;">- Rp 50.000</span>
              </div>
              
              <!-- Total Sisa Pembayaran yang Harus Dibayar -->
              <div class="d-flex justify-content-between align-items-center pt-3 mt-3" style="border-top: 2px solid var(--lq-cream-2);">
                <div>
                  <small style="text-transform: uppercase; letter-spacing: 0.06em; color: var(--lq-rose-deep); font-weight: 700; font-size: 0.78rem; display: block;">
                    JUMLAH YANG HARUS DIBAYAR KONSUMEN:
                  </small>
                  <small style="font-size: 0.74rem; color: var(--lq-mauve);">Sisa tagihan yang harus dilunasi di meja kasir</small>
                </div>
                <div style="font-family: var(--lq-serif); font-size: 1.75rem; color: var(--lq-plum); font-weight: 700;" id="kasirValFinalRemaining">
                  Rp 0
                </div>
              </div>
            </div>

            <!-- RINCIAN STRUK TRANSPARAN (INVOICE BREAKDOWN) -->
            <div class="p-3 mb-1 rounded" style="background: var(--lq-cream-2); border: 1px dashed var(--lq-line-soft); font-size: 0.82rem;">
              <div class="d-flex justify-content-between align-items-center mb-1">
                <strong style="color: var(--lq-ink); font-family: var(--lq-serif); font-size: 0.95rem;">Ringkasan Struk Perawatan</strong>
                <small style="color: var(--lq-mauve);">Amanails Nail Bar</small>
              </div>
              <div id="kasirInvoiceBreakdownSummary" style="color: var(--lq-mauve); line-height: 1.5;">
                <!-- Di-render oleh JavaScript -->
              </div>
            </div>

          </div>

          <div class="modal-footer" style="background: var(--lq-cream-2); padding: 0.85rem 1.5rem;">
            <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="lq-btn lq-btn-primary lq-btn-sm" id="btnKasirSelesaikan">
              Konfirmasi Pelunasan &amp; Selesaikan Perawatan &rarr;
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL POPUP NOTIFIKASI PERAWATAN DIMULAI -->
    <div class="modal fade" id="modalPerawatanDimulai" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 440px;">
        <div class="modal-content" style="border-radius: var(--lq-radius); border: 1px solid var(--lq-line-soft); box-shadow: var(--lq-shadow); overflow: hidden; background: #fff;">
          <div class="modal-body text-center p-4">
            <h5 style="font-family: var(--lq-serif); font-size: 1.25rem; color: var(--lq-plum); margin-bottom: 0.75rem;">Layanan Perawatan Dimulai</h5>
            <p style="font-size: 0.88rem; color: var(--lq-ink); line-height: 1.5; margin-bottom: 1.25rem;" id="modalMulaiLayananText">
              Layanan untuk jadwal telah dimulai! Waktu estimasi mulai berjalan.<br><br>
              Setelah selesai pengerjaan di kursi, klik tombol <strong>"Selesai Perawatan"</strong>.
            </p>
            <button type="button" class="lq-btn lq-btn-primary" data-bs-dismiss="modal" style="min-width: 120px; font-size: 0.84rem; padding: 0.5rem 1.25rem;">
              Oke
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL POPUP NOTIFIKASI PELUNASAN SELESAI -->
    <div class="modal fade" id="modalPelunasanSukses" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" style="max-width: 460px;">
        <div class="modal-content" style="border-radius: var(--lq-radius); border: 1px solid var(--lq-line-soft); box-shadow: var(--lq-shadow); overflow: hidden; background: #fff;">
          <div class="modal-body text-center p-4">
            <h5 style="font-family: var(--lq-serif); font-size: 1.25rem; color: var(--lq-plum); margin-bottom: 0.75rem;">Perawatan Selesai &amp; Pelunasan Dicatat</h5>
            <div id="modalPelunasanSuksesBody" class="text-start p-3 mb-3 rounded" style="background: var(--lq-cream-2); font-size: 0.84rem; color: var(--lq-ink); line-height: 1.6;">
              <!-- Detail pelunasan di-render oleh JS -->
            </div>
            <button type="button" class="lq-btn lq-btn-primary" data-bs-dismiss="modal" style="min-width: 120px; font-size: 0.84rem; padding: 0.5rem 1.25rem;">
              Oke
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- Footer Khusus Portal -->
    <footer style="padding: 1.8rem 0; border-top: 1px solid var(--lq-line-soft); text-align: center; font-size: 0.82rem; color: var(--lq-mauve); background: var(--lq-cream);">
      &copy; {{ date('Y') }} Amanails Nail Bar &middot; Khusus Akses Internal Terapis
    </footer>

    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script>
      // Simulasi Interaksi Tanpa Database (Mock Actions)
      function mulaiLayanan(id) {
        var card = document.getElementById('card-' + id);
        var badge = document.getElementById('badge-' + id);
        var action = document.getElementById('action-' + id);
        
        if (card) card.setAttribute('data-status', 'sedangberlangsung');
        if (badge) {
          badge.style.background = 'var(--lq-gold)';
          badge.style.color = 'var(--lq-plum-deep)';
          badge.innerText = 'Sedang Berlangsung';
        }

        // Ubah tombol langsung menjadi "Selesai Perawatan" yang membuka form kasir pelunasan
        if (action) {
          action.innerHTML = '<button type="button" class="lq-btn lq-btn-primary lq-btn-sm" onclick="bukaKasirPelunasan(\'' + id + '\')">Selesai Perawatan</button>' +
                             '<button type="button" class="lq-btn lq-btn-outline lq-btn-sm" onclick="bukaKasirPelunasan(\'' + id + '\')">Detail &amp; Kasir Pelunasan</button>';
        }

        var found = jadwalList.find(function(it) { return it.id === id; });
        if (found) found.status = 'Sedang Berlangsung';
        
        var textEl = document.getElementById('modalMulaiLayananText');
        if (textEl) {
          textEl.innerHTML = 'Layanan untuk jadwal <strong>' + id + '</strong> telah dimulai! Waktu estimasi mulai berjalan.<br><br>Setelah selesai pengerjaan di kursi, klik tombol <strong>"Selesai Perawatan"</strong>.';
        }
        var mDimulai = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalPerawatanDimulai'));
        mDimulai.show();
      }

      function selesaikanLayanan(id) {
        bukaKasirPelunasan(id);
      }

      function filterJadwal(tipe, btn) {
        var cards = document.querySelectorAll('#jadwalContainer .lq-appt-card');
        var buttons = document.querySelectorAll('.lq-filter-btn');
        buttons.forEach(function(b) { b.classList.remove('is-active'); });
        if (btn) btn.classList.add('is-active');

        cards.forEach(function(card) {
          var status = card.getAttribute('data-status');
          if (tipe === 'semua') {
            card.style.display = 'block';
          } else if (tipe === 'berlangsung') {
            card.style.display = status === 'sedangberlangsung' ? 'block' : 'none';
          } else if (tipe === 'menunggu') {
            card.style.display = status === 'menunggu' ? 'block' : 'none';
          }
        });
      }

      // Preview dan Unggah Foto Karya
      var uploadedKaryaImgUrl = '';

      function toggleGuideImageDashboard() {
        var box = document.getElementById('boxGuideImageDash');
        box.style.display = box.style.display === 'none' ? 'block' : 'none';
      }

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

        // Tambah ke galeri lookbook
        var container = document.getElementById('karyaContainer');
        var col = document.createElement('div');
        col.className = 'col-6 col-md-4 col-lg-2';
        col.innerHTML = '<div style="position: relative; border-radius: var(--lq-radius); overflow: hidden; height: 160px; border: 1px solid var(--lq-line-soft); background: var(--lq-cream-2);">' +
                        '<img src="' + imgSrc + '" alt="' + judul + '" style="width: 100%; height: 100%; object-fit: cover;">' +
                        '<div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(42,29,37,0.88), transparent 60%); display: flex; flex-direction: column; justify-content: flex-end; padding: 0.65rem; color: #fff;">' +
                        '<span style="font-size: 0.8rem; font-weight: 500; line-height: 1.2; margin-bottom: 0.2rem;">' + judul + '</span>' +
                        '<small style="font-size: 0.68rem; color: var(--lq-gold-soft);">' + shape + ' &bull; ⏱ ' + durasi + ' &bull; &hearts; 0 baru</small>' +
                        '</div>' +
                        '</div>';

        container.insertBefore(col, container.firstChild);

        alert('Foto karya "' + judul + '" (' + shape + ' · Estimasi ' + durasi + ') berhasil ditambahkan ke lookbook Anda!');
        document.getElementById('formKarya').reset();
        document.getElementById('boxPreviewKarya').style.display = 'none';
        uploadedKaryaImgUrl = '';
      }

      // ================= LOGIKA KASIR PELUNASAN, TAMBAHAN HARI-H & PERHITUNGAN =================
      var jadwalList = @json($jadwalHariIni);
      var currentActiveAppt = null;
      var currentPrimaryServices = [];
      var currentAddons = [];
      var currentDpDeducted = true;

      function formatRupiahKasir(num) {
        return 'Rp ' + (parseInt(num, 10) || 0).toLocaleString('id-ID');
      }

      function bukaKasirPelunasan(id) {
        var appt = jadwalList.find(function(item) { return item.id === id; });
        if (!appt) {
          appt = {
            id: id,
            klien: 'Klien Amanails',
            kontak: '0812-9876-5432',
            jam: '10:00 - 11:00 WIB',
            kursi: 'Station 01',
            layanan: 'Perawatan Kuku',
            has_website_reference: false,
            layanan_awal: [],
            dp_terbayar: 50000
          };
        }
        currentActiveAppt = appt;

        // Inisialisasi daftar layanan utama
        if (appt.layanan_awal && appt.layanan_awal.length > 0) {
          currentPrimaryServices = JSON.parse(JSON.stringify(appt.layanan_awal));
        } else {
          currentPrimaryServices = [];
        }

        // Inisialisasi daftar tambahan hari-h (manik-manik, dll)
        if (appt.addons && appt.addons.length > 0) {
          currentAddons = JSON.parse(JSON.stringify(appt.addons));
        } else {
          currentAddons = [];
        }

        currentDpDeducted = true;
        var dpCheckbox = document.getElementById('kasirDpCheckbox');
        if (dpCheckbox) dpCheckbox.checked = true;

        // Render data profil & appointment
        document.getElementById('kasirClientName').textContent = appt.klien;
        document.getElementById('kasirClientPhone').textContent = 'WhatsApp: ' + appt.kontak;
        document.getElementById('kasirScheduleTime').textContent = appt.jam + ' • ' + (appt.kursi || 'Station 01');
        document.getElementById('kasirArtistName').textContent = 'Terapis Bertugas: Mia Alvarez (Station 01)';

        // Render banner status referensi website
        var refBanner = document.getElementById('kasirReferenceBanner');
        if (appt.has_website_reference === false || currentPrimaryServices.length === 0) {
          refBanner.innerHTML = '<div class="p-2 px-3 rounded" style="background: #fff8e8; border: 1px solid #f6e2b5; color: #8a6414; font-size: 0.8rem;">' +
                                '  <strong>Konsumen Tanpa Referensi Website (Walk-in / Request Langsung):</strong>' +
                                '  <div style="font-size: 0.76rem; color: #73530e; margin-top: 2px;">Layanan pokok belum tercatat di website. Silakan pilih atau tambahkan layanan utama di bawah ini untuk memulai perhitungan.</div>' +
                                '</div>';
          var subTitle = document.getElementById('kasirPrimarySubtitle');
          if (subTitle) subTitle.textContent = 'Pilih atau input paket perawatan pokok yang dikerjakan';
        } else {
          refBanner.innerHTML = '<div class="d-flex align-items-center gap-2" style="font-size: 0.8rem; color: #1e7e34;">' +
                                '  <span class="badge" style="background: #eef6ee; color: #27ae60; font-size: 0.72rem;">Referensi Booking Website</span>' +
                                '  <span>Konsumen memilih paket perawatan melalui reservasi website Amanails.</span>' +
                                '</div>';
          var subTitle = document.getElementById('kasirPrimarySubtitle');
          if (subTitle) subTitle.textContent = 'Rincian paket perawatan yang dipesan via website';
        }

        // Foto desain referensi (jika ada upload foto klien)
        var photoBox = document.getElementById('kasirDesignPhotoBox');
        if (appt.foto_desain) {
          photoBox.style.display = 'block';
          document.getElementById('kasirDesignPhotoImg').src = appt.foto_desain;
          document.getElementById('kasirDesignNote').textContent = appt.catatan || 'Model referensi desain khusus klien.';
        } else {
          photoBox.style.display = 'none';
        }

        renderKasirPrimaryServices();
        renderKasirAddons();

        var modalEl = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalKasirPelunasan'));
        modalEl.show();
      }

      function renderKasirPrimaryServices() {
        var tbody = document.getElementById('kasirInitialServicesTable');
        var badge = document.getElementById('kasirPrimaryCountBadge');
        if (!tbody) return;

        tbody.innerHTML = '';
        if (currentPrimaryServices.length === 0) {
          tbody.innerHTML = '<tr><td colspan="2" class="text-center py-3 text-muted" style="font-size: 0.82rem; font-style: italic;">' +
                            'Belum ada layanan utama yang dipilih. Silakan pilih layanan dari katalog di bawah.' +
                            '</td></tr>';
          if (badge) badge.textContent = '0 Layanan';
        } else {
          currentPrimaryServices.forEach(function(s, idx) {
            var tr = document.createElement('tr');
            tr.innerHTML = '<td style="padding: 0.55rem 0.85rem; vertical-align: middle;">' +
                           '  <strong>' + s.nama + '</strong>' +
                           '</td>' +
                           '<td class="text-end" style="padding: 0.55rem 0.85rem; font-weight: 600; color: var(--lq-ink); vertical-align: middle; white-space: nowrap;">' +
                           '  ' + formatRupiahKasir(s.harga) +
                           '  <button type="button" class="btn btn-sm btn-link text-danger p-0 ms-2" onclick="hapusLayananUtama(' + idx + ')" style="text-decoration:none; font-size:0.95rem;" title="Hapus layanan ini">&times;</button>' +
                           '</td>';
            tbody.appendChild(tr);
          });
          if (badge) badge.textContent = currentPrimaryServices.length + ' Layanan';
        }

        recalculateKasirTotals();
      }

      function hapusLayananUtama(idx) {
        currentPrimaryServices.splice(idx, 1);
        renderKasirPrimaryServices();
      }

      function renderKasirAddons() {
        var ul = document.getElementById('kasirAddonsUl');
        var noText = document.getElementById('kasirNoAddonsText');
        var badge = document.getElementById('kasirAddonsCountBadge');
        if (!ul) return;

        ul.innerHTML = '';
        if (currentAddons.length === 0) {
          if (noText) noText.style.display = 'block';
          if (badge) badge.textContent = '0 Tambahan';
        } else {
          if (noText) noText.style.display = 'none';
          currentAddons.forEach(function(item, idx) {
            var li = document.createElement('li');
            li.className = 'd-flex justify-content-between align-items-center py-1';
            li.style.borderBottom = '1px dashed var(--lq-line-soft)';
            li.style.fontSize = '0.82rem';
            li.innerHTML = '<span>+ ' + item.name + '</span>' +
                           '<div><strong style="color:var(--lq-rose-deep); margin-right:8px;">' + formatRupiahKasir(item.price) + '</strong>' +
                           '<button type="button" class="btn btn-sm btn-link text-danger p-0" style="text-decoration:none; font-size:0.95rem;" onclick="hapusKasirAddon(' + idx + ')" title="Hapus tambahan ini">&times;</button></div>';
            ul.appendChild(li);
          });
          if (badge) badge.textContent = currentAddons.length + ' Tambahan';
        }

        recalculateKasirTotals();
      }

      function hapusKasirAddon(idx) {
        currentAddons.splice(idx, 1);
        renderKasirAddons();
      }

      function toggleDpDeduction() {
        var cb = document.getElementById('kasirDpCheckbox');
        currentDpDeducted = cb ? cb.checked : true;
        recalculateKasirTotals();
      }

      function recalculateKasirTotals() {
        var totalPrimary = currentPrimaryServices.reduce(function(acc, cur) {
          return acc + (parseInt(cur.harga, 10) || 0);
        }, 0);

        var totalAddons = currentAddons.reduce(function(acc, cur) {
          return acc + (parseInt(cur.price, 10) || 0);
        }, 0);

        var totalGrand = totalPrimary + totalAddons;
        var dp = currentDpDeducted ? (currentActiveAppt && currentActiveAppt.dp_terbayar ? currentActiveAppt.dp_terbayar : 50000) : 0;
        var finalRemaining = Math.max(0, totalGrand - dp);

        // Update Elemen DOM
        var elInit = document.getElementById('kasirValInitialTotal');
        var elAddons = document.getElementById('kasirValAddonsTotal');
        var elGrand = document.getElementById('kasirValGrandTotal');
        var elDp = document.getElementById('kasirValDpPaid');
        var elFinal = document.getElementById('kasirValFinalRemaining');

        if (elInit) elInit.textContent = formatRupiahKasir(totalPrimary);
        if (elAddons) elAddons.textContent = '+ ' + formatRupiahKasir(totalAddons);
        if (elGrand) elGrand.textContent = formatRupiahKasir(totalGrand);
        if (elDp) elDp.textContent = currentDpDeducted ? ('- ' + formatRupiahKasir(dp)) : 'Rp 0 (Tanpa DP)';
        if (elFinal) elFinal.textContent = formatRupiahKasir(finalRemaining);

        // Render Rincian Struk Transparan
        var summaryBox = document.getElementById('kasirInvoiceBreakdownSummary');
        if (summaryBox) {
          var lines = [];
          if (currentPrimaryServices.length > 0) {
            currentPrimaryServices.forEach(function(p) {
              lines.push('<div>• ' + p.nama + ' <span class="float-end">' + formatRupiahKasir(p.harga) + '</span></div>');
            });
          } else {
            lines.push('<div>• <em>Belum ada layanan utama dipilih</em></div>');
          }

          if (currentAddons.length > 0) {
            currentAddons.forEach(function(a) {
              lines.push('<div style="color: var(--lq-rose-deep);">• [Tambahan] ' + a.name + ' <span class="float-end">' + formatRupiahKasir(a.price) + '</span></div>');
            });
          }

          lines.push('<div class="d-flex justify-content-between pt-1 mt-1" style="border-top: 1px dashed var(--lq-line-soft); font-weight: 600;">' +
                     '<span>Subtotal Layanan:</span><span>' + formatRupiahKasir(totalGrand) + '</span></div>');
          lines.push('<div class="d-flex justify-content-between" style="color: #27ae60; font-weight: 500;">' +
                     '<span>Uang Muka (DP Terbayar):</span><span>- ' + formatRupiahKasir(dp) + '</span></div>');
          lines.push('<div class="d-flex justify-content-between pt-1 mt-1" style="border-top: 1px solid var(--lq-line-soft); font-weight: 700; color: var(--lq-plum); font-size: 0.92rem;">' +
                     '<span>Total Pelunasan Kasir:</span><span>' + formatRupiahKasir(finalRemaining) + '</span></div>');

          summaryBox.innerHTML = lines.join('');
        }
      }

      // Event Listener: Tambah Layanan Utama
      var selectPrimary = document.getElementById('kasirPresetPrimary');
      if (selectPrimary) {
        selectPrimary.addEventListener('change', function() {
          var priceCol = document.getElementById('kasirCustomPrimaryPriceCol');
          if (this.value === 'custom') {
            priceCol.style.display = 'block';
          } else {
            priceCol.style.display = 'none';
          }
        });
      }

      var btnAddPrimary = document.getElementById('btnKasirAddPrimaryService');
      if (btnAddPrimary) {
        btnAddPrimary.addEventListener('click', function() {
          var select = document.getElementById('kasirPresetPrimary');
          var val = select.value;
          if (!val) {
            alert('Silakan pilih jenis layanan utama terlebih dahulu.');
            return;
          }

          var name = '';
          var price = 0;

          if (val === 'custom') {
            var customName = prompt('Masukkan nama layanan utama:', 'Paket Spesial Manicure Custom');
            if (!customName) return;
            name = customName;
            price = parseInt(document.getElementById('kasirCustomPrimaryPrice').value, 10) || 100000;
          } else {
            var opt = select.options[select.selectedIndex];
            name = opt.value;
            price = parseInt(opt.getAttribute('data-price'), 10) || 0;
          }

          currentPrimaryServices.push({ nama: name, harga: price });
          select.selectedIndex = 0;
          document.getElementById('kasirCustomPrimaryPriceCol').style.display = 'none';
          renderKasirPrimaryServices();
        });
      }

      // Event Listener: Tambah Layanan Add-on
      var selectAddon = document.getElementById('kasirPresetAddon');
      if (selectAddon) {
        selectAddon.addEventListener('change', function() {
          var priceCol = document.getElementById('kasirCustomPriceCol');
          if (this.value === 'custom') {
            priceCol.style.display = 'block';
          } else {
            priceCol.style.display = 'none';
          }
        });
      }

      var btnAddAddon = document.getElementById('btnKasirAddService');
      if (btnAddAddon) {
        btnAddAddon.addEventListener('click', function() {
          var select = document.getElementById('kasirPresetAddon');
          var val = select.value;
          if (!val) {
            alert('Silakan pilih jenis tambahan hari-h (manik-manik, dll) terlebih dahulu.');
            return;
          }

          var name = '';
          var price = 0;

          if (val === 'custom') {
            var customInput = prompt('Masukkan nama item tambahan / manik-manik:', 'Aksesoris Manik-manik Charm');
            if (!customInput) return;
            name = customInput;
            price = parseInt(document.getElementById('kasirCustomPrice').value, 10) || 25000;
          } else {
            var opt = select.options[select.selectedIndex];
            name = opt.value;
            price = parseInt(opt.getAttribute('data-price'), 10) || 0;
          }

          currentAddons.push({ name: name, price: price });
          select.selectedIndex = 0;
          document.getElementById('kasirCustomPriceCol').style.display = 'none';
          renderKasirAddons();
        });
      }

      // Event Listener: Konfirmasi Pelunasan & Selesaikan Appointment
      var btnSelesaikan = document.getElementById('btnKasirSelesaikan');
      if (btnSelesaikan) {
        btnSelesaikan.addEventListener('click', function() {
          if (!currentActiveAppt) return;

          if (currentPrimaryServices.length === 0 && currentAddons.length === 0) {
            alert('Mohon pilih setidaknya satu layanan sebelum menyelesaikan perawatan.');
            return;
          }

          var remaining = document.getElementById('kasirValFinalRemaining').textContent;
          var grand = document.getElementById('kasirValGrandTotal').textContent;

          // Update data di jadwalList
          currentActiveAppt.status = 'Selesai';
          currentActiveAppt.layanan_awal = JSON.parse(JSON.stringify(currentPrimaryServices));
          currentActiveAppt.addons = JSON.parse(JSON.stringify(currentAddons));
          currentActiveAppt.pelunasan_final = {
            total_layanan: grand,
            dp_terpotong: currentDpDeducted ? 'Rp 50.000' : 'Rp 0',
            sisa_dibayar: remaining
          };

          // Update UI Kartu di Dashboard
          var id = currentActiveAppt.id;
          var card = document.getElementById('card-' + id);
          var badge = document.getElementById('badge-' + id);
          var action = document.getElementById('action-' + id);

          if (card) card.setAttribute('data-status', 'selesai');
          if (badge) {
            badge.style.background = '#eef6ee';
            badge.style.color = '#27ae60';
            badge.innerText = 'Selesai & Lunas';
          }
          if (action) {
            action.innerHTML = '<span style="font-size:0.84rem; color:#27ae60; font-weight:600; align-self:center;">Selesai (' + remaining + ')</span>' +
                               '<button type="button" class="lq-btn lq-btn-outline lq-btn-sm" onclick="bukaKasirPelunasan(\'' + id + '\')">Lihat Rincian Pembayaran</button>';
          }

          var modalEl = bootstrap.Modal.getInstance(document.getElementById('modalKasirPelunasan'));
          if (modalEl) modalEl.hide();

          // Tampilkan popup modal notifikasi sukses
          var suksesBody = document.getElementById('modalPelunasanSuksesBody');
          if (suksesBody) {
            suksesBody.innerHTML = '<div><strong>Pelanggan:</strong> ' + currentActiveAppt.klien + '</div>' +
                                   '<div><strong>Total Layanan:</strong> ' + grand + '</div>' +
                                   '<div><strong>Potongan DP Booking:</strong> ' + (currentDpDeducted ? '- Rp 50.000' : 'Rp 0') + '</div>' +
                                   '<div class="pt-2 mt-2" style="border-top:1px dashed var(--lq-line-soft); font-weight:700; color:var(--lq-plum); font-size:0.95rem;">' +
                                   '<strong>Sisa Tagihan Diterima:</strong> ' + remaining + '</div>';
          }
          var mSukses = bootstrap.Modal.getOrCreateInstance(document.getElementById('modalPelunasanSukses'));
          mSukses.show();
        });
      }

      function lihatDetail(klien, layanan) {
        bukaKasirPelunasan('APT-000');
      }

      // ================= LOGIKA KALENDER 1 BULAN KEDEPAN =================
      var jadwalSatuBulan = @json($jadwalSatuBulan);
      var currentCalYear = 2026;
      var currentCalMonth = 10; // November (0-based)
      var selectedCalDate = '2026-11-21';
      var todayDateStr = '2026-11-21';
      var namaBulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
      var namaHari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];

      function formatTanggalIndo(dateStr) {
        var parts = dateStr.split('-');
        var y = parseInt(parts[0], 10);
        var m = parseInt(parts[1], 10) - 1;
        var d = parseInt(parts[2], 10);
        var dt = new Date(y, m, d);
        var dayName = namaHari[dt.getDay()];
        var monthName = namaBulan[m];
        return dayName + ', ' + d + ' ' + monthName + ' ' + y;
      }

      function switchScheduleView(mode) {
        var btnHariIni = document.getElementById('btnTabHariIni');
        var btnKalender = document.getElementById('btnTabKalender');
        var viewHariIni = document.getElementById('viewHariIni');
        var viewKalender = document.getElementById('viewKalender');
        var heading = document.getElementById('scheduleMainHeading');

        if (mode === 'hariIni') {
          btnHariIni.classList.add('is-active');
          btnKalender.classList.remove('is-active');
          viewHariIni.style.display = 'block';
          viewKalender.style.display = 'none';
          heading.textContent = 'Janji Temu Hari Ini ({{ count($jadwalHariIni) }})';
        } else {
          btnHariIni.classList.remove('is-active');
          btnKalender.classList.add('is-active');
          viewHariIni.style.display = 'none';
          viewKalender.style.display = 'block';
          heading.textContent = 'Kalender Booking';
          renderCalendarGrid();
          renderSelectedDateDetails(selectedCalDate);
        }
      }

      function changeCalMonth(offset) {
        currentCalMonth += offset;
        if (currentCalMonth < 0) {
          currentCalMonth = 11;
          currentCalYear--;
        } else if (currentCalMonth > 11) {
          currentCalMonth = 0;
          currentCalYear++;
        }
        renderCalendarGrid();
      }

      function goToTodayCal() {
        currentCalYear = 2026;
        currentCalMonth = 10;
        selectedCalDate = todayDateStr;
        renderCalendarGrid();
        renderSelectedDateDetails(selectedCalDate);
      }

      function renderCalendarGrid() {
        var titleEl = document.getElementById('calMonthTitle');
        if (titleEl) {
          titleEl.textContent = namaBulan[currentCalMonth] + ' ' + currentCalYear;
        }

        var grid = document.getElementById('calGridCells');
        if (!grid) return;
        grid.innerHTML = '';

        var firstDayDate = new Date(currentCalYear, currentCalMonth, 1);
        var firstDayIndex = (firstDayDate.getDay() + 6) % 7; // Mulai Senin (0) s/d Minggu (6)
        var daysInMonth = new Date(currentCalYear, currentCalMonth + 1, 0).getDate();
        var daysInPrevMonth = new Date(currentCalYear, currentCalMonth, 0).getDate();

        // Trailing hari bulan lalu
        for (var p = firstDayIndex - 1; p >= 0; p--) {
          var prevDayNum = daysInPrevMonth - p;
          var cellPrev = document.createElement('div');
          cellPrev.className = 'lq-cal-cell is-other-month';
          cellPrev.innerHTML = '<span class="lq-cal-num" style="opacity: 0.4;">' + prevDayNum + '</span>';
          grid.appendChild(cellPrev);
        }

        // Hari bulan aktif
        for (var d = 1; d <= daysInMonth; d++) {
          var mStr = String(currentCalMonth + 1).padStart(2, '0');
          var dStr = String(d).padStart(2, '0');
          var dateKey = currentCalYear + '-' + mStr + '-' + dStr;

          var appts = jadwalSatuBulan[dateKey] || [];
          var apptCount = appts.length;

          var cell = document.createElement('div');
          var cellClass = 'lq-cal-cell';
          if (dateKey === todayDateStr) {
            cellClass += ' is-today';
          }
          if (dateKey === selectedCalDate) {
            cellClass += ' is-selected';
          }
          if (apptCount > 0) {
            cellClass += ' has-appt';
          }
          cell.className = cellClass;
          cell.setAttribute('data-date', dateKey);

          var topHtml = '<div class="d-flex justify-content-between align-items-center">' +
                        '<span class="lq-cal-num">' + d + '</span>' +
                        (dateKey === todayDateStr ? '<span style="font-size: 0.55rem; color: var(--lq-gold); font-weight: 700; letter-spacing: 0.05em;">HARI INI</span>' : '') +
                        '</div>';

          var botHtml = apptCount > 0 ?
            '<div class="mt-1"><span class="lq-cal-badge">' + apptCount + ' Klien</span></div>' :
            '<div class="mt-1" style="height: 12px;"></div>';

          cell.innerHTML = topHtml + botHtml;

          (function(targetCell, k) {
            targetCell.onclick = function() {
              selectedCalDate = k;
              document.querySelectorAll('.lq-cal-cell').forEach(function(el) {
                el.classList.remove('is-selected');
              });
              targetCell.classList.add('is-selected');
              renderSelectedDateDetails(k);
            };
          })(cell, dateKey);

          grid.appendChild(cell);
        }

        // Leading hari bulan depan
        var totalCells = firstDayIndex + daysInMonth;
        var remainingCells = (7 - (totalCells % 7)) % 7;
        for (var n = 1; n <= remainingCells; n++) {
          var cellNext = document.createElement('div');
          cellNext.className = 'lq-cal-cell is-other-month';
          cellNext.innerHTML = '<span class="lq-cal-num" style="opacity: 0.4;">' + n + '</span>';
          grid.appendChild(cellNext);
        }
      }

      function renderSelectedDateDetails(dateKey) {
        var titleEl = document.getElementById('selectedDateTitle');
        var badgeEl = document.getElementById('selectedDateCountBadge');
        var container = document.getElementById('detailKalenderContainer');
        if (!container || !titleEl || !badgeEl) return;

        titleEl.textContent = formatTanggalIndo(dateKey);
        var appts = jadwalSatuBulan[dateKey] || [];

        if (appts.length === 0) {
          badgeEl.textContent = 'Belum Ada Klien';
          badgeEl.style.background = 'var(--lq-cream-2)';
          badgeEl.style.color = 'var(--lq-mauve)';
          container.innerHTML = '<div class="lq-appt-card text-center p-5">' +
                                '<div style="font-size: 2.2rem; margin-bottom: 0.5rem;">🌸</div>' +
                                '<h4 style="font-family: var(--lq-serif); color: var(--lq-ink); margin-bottom: 0.35rem;">Meja Bebas / Belum Ada Klien</h4>' +
                                '<p style="font-size: 0.88rem; color: var(--lq-mauve); margin-bottom: 0; max-width: 420px; margin-inline: auto;">' +
                                'Belum ada klien yang booking pada ' + formatTanggalIndo(dateKey) + '. Meja kerja Anda siap untuk menerima reservasi langsung (walk-in) atau jadwal cuti/istirahat.' +
                                '</p>' +
                                '</div>';
          return;
        }

        badgeEl.textContent = appts.length + ' Klien Terjadwal';
        badgeEl.style.background = 'var(--lq-plum)';
        badgeEl.style.color = '#fff';

        var html = '';
        appts.forEach(function(item) {
          var statusBg = item.status === 'Selesai' ? 'background: #eef6ee; color: #27ae60;' :
                        (item.status === 'Sedang Berlangsung' ? 'background: var(--lq-gold); color: var(--lq-plum-deep);' :
                        'background: var(--lq-cream-2); color: var(--lq-mauve);');

          var tipeBadge = item.tipe_klien === 'Member' ?
            '<span class="lq-pkg-tag" style="position: static; font-size: 0.62rem; padding: 0.35rem 0.7rem; background: var(--lq-blush); color: var(--lq-rose-deep);">MEMBER</span>' :
            '<span class="lq-pkg-tag" style="position: static; font-size: 0.62rem; padding: 0.35rem 0.7rem; background: var(--lq-cream-2); color: var(--lq-ink); border: 1px solid var(--lq-line-soft);">PELANGGAN BARU</span>';

          var cleanWa = (item.kontak || '').replace(/[^0-9]/g, '');
          var kursi = item.kursi || 'Station 01';

          html += '<div class="lq-appt-card" id="card-' + item.id + '">' +
                  '  <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3 pb-2" style="border-bottom: 1px solid var(--lq-line-soft);">' +
                  '    <div class="d-flex align-items-baseline gap-2">' +
                  '      <span style="font-family: var(--lq-serif); font-size: 1.35rem; font-weight: 500; color: var(--lq-ink);">' + item.jam + '</span>' +
                  '      <span style="font-size: 0.82rem; color: var(--lq-mauve);">(' + item.durasi + ') &middot; ' + kursi + '</span>' +
                  '    </div>' +
                  '    <div class="d-flex align-items-center gap-2">' +
                  '      <span class="lq-pkg-tag" id="badge-' + item.id + '" style="position: static; font-size: 0.62rem; padding: 0.35rem 0.7rem; ' + statusBg + '">' +
                  '        ' + item.status +
                  '      </span>' +
                  '      ' + tipeBadge +
                  '    </div>' +
                  '  </div>' +
                  '  <div class="mb-3">' +
                  '    <span class="lq-eyebrow" style="font-size: 0.68rem; margin-bottom: 0.15rem;">Klien Amanails</span>' +
                  '    <h3 style="font-size: 1.4rem; margin-bottom: 0.25rem; font-family: var(--lq-serif); color: var(--lq-ink);">' +
                  '      ' + item.klien +
                  '    </h3>' +
                  '    <div style="color: var(--lq-rose-deep); font-weight: 500; font-size: 0.95rem; margin-bottom: 0.35rem;">' +
                  '      ' + item.layanan +
                  '    </div>' +
                  '    <p style="color: var(--lq-mauve); font-size: 0.84rem; margin: 0;">' +
                  '      WhatsApp: <a href="https://wa.me/' + cleanWa + '" target="_blank" style="color: var(--lq-mauve); text-decoration: none;">' + item.kontak + '</a>' +
                  '    </p>' +
                  '  </div>';

          if (item.catatan) {
            html += '  <div class="mb-3 pt-2 pb-1" style="border-top: 1px dashed var(--lq-line-soft);">' +
                    '    <p style="font-size: 0.86rem; color: var(--lq-ink); font-style: italic; margin: 0;">' +
                    '      &ldquo;' + item.catatan + '&rdquo;' +
                    '    </p>' +
                    '  </div>';
          }

          html += '  <div class="d-flex justify-content-end align-items-center flex-wrap gap-2 pt-2" style="border-top: 1px solid var(--lq-line-soft);">' +
                  '    <div class="d-flex gap-2" id="action-' + item.id + '">' +
                  '      <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" onclick="bukaKasirPelunasan(\'' + item.id + '\')">Rincian &amp; Kasir</button>' +
                  '      <a href="https://wa.me/' + cleanWa + '" target="_blank" class="lq-btn lq-btn-sm" style="background: var(--lq-cream-2); border: 1px solid var(--lq-line-soft); font-size: 0.75rem; text-decoration: none; color: var(--lq-ink);">Hubungi WA</a>' +
                  '    </div>' +
                  '  </div>' +
                  '</div>';
        });

        container.innerHTML = html;
      }
    </script>
  </body>
</html>
