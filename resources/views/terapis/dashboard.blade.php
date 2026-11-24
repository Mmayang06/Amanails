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
                        <button type="button" class="lq-btn lq-btn-primary lq-btn-sm" onclick="selesaikanLayanan('{{ $item['id'] }}')">
                          Selesaikan Layanan
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
              <h4 class="modal-title" style="font-family: var(--lq-serif); font-size: 1.35rem; color: #fff; margin: 0;">Detail Appointment &amp; Tambahan Hari-H</h4>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>

          <div class="modal-body p-4" style="background: var(--lq-cream);">
            
            <!-- Detail Klien & Status Booking -->
            <div class="p-3 mb-3" style="background: #fff; border: 1px solid var(--lq-line-soft); border-radius: var(--lq-radius);">
              <div class="row g-2">
                <div class="col-sm-6">
                  <small style="font-size: 0.72rem; color: var(--lq-mauve); text-transform: uppercase;">Pelanggan</small>
                  <div style="font-size: 1.05rem; font-weight: 600; color: var(--lq-ink);" id="kasirClientName">Sela (Buyer)</div>
                  <div style="font-size: 0.8rem; color: var(--lq-mauve);" id="kasirClientPhone">WhatsApp: 0812-9876-5432</div>
                </div>
                <div class="col-sm-6 text-sm-end">
                  <small style="font-size: 0.72rem; color: var(--lq-mauve); text-transform: uppercase;">Jadwal &amp; Meja</small>
                  <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-rose-deep);" id="kasirScheduleTime">09:00 - 10:30 WIB &bull; Station 01</div>
                  <div style="font-size: 0.8rem; color: var(--lq-mauve);" id="kasirArtistName">Terapis: Aurel (Senior Nail Artist)</div>
                </div>
              </div>

              <!-- Foto Referensi Desain Klien (Jika Request Desain Sendiri) -->
              <div id="kasirDesignPhotoBox" class="mt-3 pt-3" style="border-top: 1px dashed var(--lq-line-soft); display: none;">
                <div class="d-flex align-items-center gap-3">
                  <img id="kasirDesignPhotoImg" src="" alt="Desain Referensi Klien" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; border: 1px solid var(--lq-line);">
                  <div>
                    <span class="badge" style="background: var(--lq-blush); color: var(--lq-rose-deep); font-size: 0.72rem;">✨ Request Desain Klien</span>
                    <div style="font-size: 0.82rem; font-style: italic; color: var(--lq-ink); margin-top: 2px;" id="kasirDesignNote">"Lilac floral & aksen emas"</div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Rincian Layanan Booking Awal -->
            <div class="mb-3">
              <label style="font-weight: 600; font-size: 0.85rem; color: var(--lq-plum);" class="d-block mb-1">
                Rincian Layanan Saat Booking Awal:
              </label>
              <div style="background: #fff; border: 1px solid var(--lq-line-soft); border-radius: var(--lq-radius); overflow: hidden;">
                <table class="table mb-0" style="font-size: 0.85rem;">
                  <tbody id="kasirInitialServicesTable">
                    <!-- Di-render oleh JavaScript -->
                  </tbody>
                </table>
              </div>
            </div>

            <!-- TAMBAHAN LAYANAN HARI-H (Add-on Saat Treatment) -->
            <div class="p-3 mb-3" style="background: #fbf5f2; border: 1px solid var(--lq-rose-soft, #eedbd8); border-radius: var(--lq-radius);">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <label style="font-weight: 600; font-size: 0.86rem; color: var(--lq-plum); margin: 0;">
                  Tambahan Layanan Hari-H (Saat Treatment di Kursi)
                </label>
                <small style="font-size: 0.75rem; color: var(--lq-mauve);">Charm, 3D Art, Ekstra Layer, dll.</small>
              </div>

              <!-- Input Tambah Item Ekstra -->
              <div class="row g-2 align-items-center mb-2">
                <div class="col-7 col-sm-6">
                  <select class="lq-select" id="kasirPresetAddon" style="font-size: 0.82rem; padding: 0.45rem 0.65rem;">
                    <option value="" disabled selected>Pilih Layanan Tambahan Cepat...</option>
                    <option value="Aksesoris Charm 3D / Kristal Swarovski" data-price="25000">Charm 3D / Kristal Swarovski (+Rp 25.000)</option>
                    <option value="Ekstra Layer Builder Gel (BIAB)" data-price="40000">Ekstra Layer Builder Gel (+Rp 40.000)</option>
                    <option value="Aksen Chrome / Aurora Powder" data-price="30000">Aksen Chrome / Aurora (+Rp 30.000)</option>
                    <option value="Nail Tip Extension Tambahan (2 Jari)" data-price="35000">Nail Tip Extension (+Rp 35.000)</option>
                    <option value="Spa Hand Massage & Pelembap" data-price="30000">Spa Hand Massage & Pelembap (+Rp 30.000)</option>
                    <option value="custom" data-price="0">+ Input Custom Layanan Lainnya...</option>
                  </select>
                </div>
                <div class="col-5 col-sm-4" id="kasirCustomPriceCol" style="display: none;">
                  <input type="number" class="lq-input" id="kasirCustomPrice" placeholder="Harga (Rp)" style="font-size: 0.82rem; padding: 0.45rem 0.65rem;">
                </div>
                <div class="col-12 col-sm-2">
                  <button type="button" class="lq-btn lq-btn-primary lq-btn-block" id="btnKasirAddService" style="padding: 0.45rem 0.65rem; font-size: 0.8rem;">
                    + Tambah
                  </button>
                </div>
              </div>

              <!-- Daftar Item Tambahan Hari-H -->
              <div id="kasirAddonsList" style="background: #fff; border: 1px solid var(--lq-line-soft); border-radius: 6px; padding: 0.5rem 0.75rem; min-height: 40px;">
                <div id="kasirNoAddonsText" style="font-size: 0.78rem; color: var(--lq-mauve); font-style: italic; text-align: center; padding: 4px;">
                  Belum ada tambahan layanan hari-h.
                </div>
                <ul id="kasirAddonsUl" style="list-style: none; padding: 0; margin: 0;"></ul>
              </div>
            </div>

            <!-- Rekapitulasi Tagihan & Sisa Pelunasan -->
            <div class="p-3" style="background: #fff; border: 1px solid var(--lq-line-soft); border-radius: var(--lq-radius);">
              <div class="d-flex justify-content-between py-1" style="font-size: 0.85rem; color: var(--lq-mauve);">
                <span>Subtotal Layanan Awal</span>
                <span id="kasirValInitialTotal">Rp 275.000</span>
              </div>
              <div class="d-flex justify-content-between py-1" style="font-size: 0.85rem; color: var(--lq-mauve);">
                <span>Tambahan Layanan Hari-H</span>
                <span id="kasirValAddonsTotal" style="color: var(--lq-rose-deep); font-weight: 600;">+ Rp 0</span>
              </div>
              <div class="d-flex justify-content-between py-1" style="font-size: 0.85rem; color: var(--lq-mauve);">
                <span>Uang Muka (DP) Sudah Terbayar</span>
                <span id="kasirValDpPaid" style="color: #27ae60; font-weight: 600;">- Rp 50.000</span>
              </div>
              
              <div class="d-flex justify-content-between align-items-center pt-2 mt-2" style="border-top: 2px solid var(--lq-cream-2);">
                <div>
                  <small style="text-transform: uppercase; letter-spacing: 0.05em; color: var(--lq-rose-deep); font-weight: 700; font-size: 0.75rem; display: block;">
                    💵 SISA TOTALAN DIBAYAR DI AKHIR:
                  </small>
                  <small style="font-size: 0.72rem; color: var(--lq-mauve);">Harus dilunasi klien sebelum meninggalkan studio</small>
                </div>
                <div style="font-family: var(--lq-serif); font-size: 1.55rem; color: var(--lq-plum); font-weight: 700;" id="kasirValFinalRemaining">
                  Rp 225.000
                </div>
              </div>
            </div>

            <!-- Metode Pembayaran Pelunasan -->
            <div class="mt-3">
              <label style="font-size: 0.8rem; font-weight: 600; color: var(--lq-mauve);" class="d-block mb-1">Metode Pelunasan:</label>
              <div class="d-flex gap-3">
                <label style="font-size: 0.82rem; cursor: pointer;"><input type="radio" name="payment_method_final" value="cash" checked> Tunai (Cash)</label>
                <label style="font-size: 0.82rem; cursor: pointer;"><input type="radio" name="payment_method_final" value="qris"> QRIS Kasir</label>
                <label style="font-size: 0.82rem; cursor: pointer;"><input type="radio" name="payment_method_final" value="edc"> Kartu Debit / EDC</label>
              </div>
            </div>

          </div>

          <div class="modal-footer" style="background: var(--lq-cream-2); padding: 0.85rem 1.5rem;">
            <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="lq-btn lq-btn-primary lq-btn-sm" id="btnKasirSelesaikan">
              Konfirmasi Pelunasan &amp; Selesaikan Appointment &rarr;
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
        
        card.setAttribute('data-status', 'sedangberlangsung');
        badge.style.background = 'var(--lq-gold)';
        badge.style.color = 'var(--lq-plum-deep)';
        badge.innerText = 'Sedang Berlangsung';

        action.innerHTML = '<button type="button" class="lq-btn lq-btn-primary lq-btn-sm" onclick="selesaikanLayanan(\'' + id + '\')">Selesaikan Layanan</button>' +
                           '<button type="button" class="lq-btn lq-btn-outline lq-btn-sm" onclick="lihatDetail(\'\', \'\')">Detail</button>';
        
        alert('Layanan untuk jadwal ' + id + ' telah dimulai! Waktu estimasi mulai berjalan.');
      }

      function selesaikanLayanan(id) {
        var card = document.getElementById('card-' + id);
        var badge = document.getElementById('badge-' + id);
        var action = document.getElementById('action-' + id);

        card.setAttribute('data-status', 'selesai');
        badge.style.background = '#eef6ee';
        badge.style.color = '#27ae60';
        badge.innerText = 'Selesai';

        action.innerHTML = '<span style="font-size: 0.84rem; color: #27ae60; font-weight: 500; align-self: center;">Perawatan Selesai</span>' +
                           '<button type="button" class="lq-btn lq-btn-outline lq-btn-sm" onclick="lihatDetail(\'\', \'\')">Detail</button>';

        alert('Selamat! Layanan jadwal ' + id + ' telah selesai dicatat.');
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

      // ================= LOGIKA KASIR PELUNASAN & TAMBAHAN HARI-H =================
      var jadwalList = @json($jadwalHariIni);
      var currentActiveAppt = null;
      var currentAddons = [];

      function formatRupiahKasir(num) {
        return 'Rp ' + parseInt(num, 10).toLocaleString('id-ID');
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
            layanan: 'Treatment Kuku',
            layanan_awal: [
              { nama: 'Layanan Manikur & Nail Art', harga: 200000 }
            ],
            dp_terbayar: 50000
          };
        }
        currentActiveAppt = appt;
        currentAddons = [];

        document.getElementById('kasirClientName').textContent = appt.klien;
        document.getElementById('kasirClientPhone').textContent = 'WhatsApp: ' + appt.kontak;
        document.getElementById('kasirScheduleTime').textContent = appt.jam + ' • ' + (appt.kursi || 'Station 01');
        document.getElementById('kasirArtistName').textContent = 'Terapis Bertugas: ' + (appt.kursi === 'Station 02' ? 'Nadia' : 'Aurel');

        var photoBox = document.getElementById('kasirDesignPhotoBox');
        if (appt.foto_desain) {
          photoBox.style.display = 'block';
          document.getElementById('kasirDesignPhotoImg').src = appt.foto_desain;
          document.getElementById('kasirDesignNote').textContent = appt.catatan || 'Model referensi desain khusus klien.';
        } else {
          photoBox.style.display = 'none';
        }

        var initialServices = appt.layanan_awal || [
          { nama: appt.layanan || 'Manikur Gel Lengkap', harga: 180000 }
        ];

        var tableHtml = '';
        var initialTotal = 0;
        initialServices.forEach(function(s) {
          initialTotal += s.harga;
          tableHtml += '<tr><td style="padding: 0.55rem 0.85rem;">' + s.nama + '</td>' +
                       '<td class="text-end" style="padding: 0.55rem 0.85rem; font-weight: 600; color: var(--lq-ink);">' + formatRupiahKasir(s.harga) + '</td></tr>';
        });
        document.getElementById('kasirInitialServicesTable').innerHTML = tableHtml;
        document.getElementById('kasirValInitialTotal').textContent = formatRupiahKasir(initialTotal);

        var dp = appt.dp_terbayar || 50000;
        document.getElementById('kasirValDpPaid').textContent = '- ' + formatRupiahKasir(dp);

        renderKasirAddons();

        var modalEl = new bootstrap.Modal(document.getElementById('modalKasirPelunasan'));
        modalEl.show();
      }

      function renderKasirAddons() {
        var ul = document.getElementById('kasirAddonsUl');
        var noText = document.getElementById('kasirNoAddonsText');
        ul.innerHTML = '';

        var totalAddons = 0;
        if (currentAddons.length === 0) {
          noText.style.display = 'block';
        } else {
          noText.style.display = 'none';
          currentAddons.forEach(function(item, idx) {
            totalAddons += item.price;
            var li = document.createElement('li');
            li.className = 'd-flex justify-content-between align-items-center py-1';
            li.style.borderBottom = '1px dashed var(--lq-line-soft)';
            li.style.fontSize = '0.82rem';
            li.innerHTML = '<span>+ ' + item.name + '</span>' +
                           '<div><strong style="color:var(--lq-rose-deep); margin-right:8px;">' + formatRupiahKasir(item.price) + '</strong>' +
                           '<button type="button" class="btn btn-sm btn-link text-danger p-0" style="text-decoration:none; font-size:0.85rem;" onclick="hapusKasirAddon(' + idx + ')">&times;</button></div>';
            ul.appendChild(li);
          });
        }

        var initialServices = currentActiveAppt.layanan_awal || [{ harga: 180000 }];
        var initialTotal = initialServices.reduce(function(acc, cur) { return acc + cur.harga; }, 0);
        var dp = currentActiveAppt.dp_terbayar || 50000;

        var finalGrand = initialTotal + totalAddons;
        var finalRemaining = Math.max(0, finalGrand - dp);

        document.getElementById('kasirValAddonsTotal').textContent = '+ ' + formatRupiahKasir(totalAddons);
        document.getElementById('kasirValFinalRemaining').textContent = formatRupiahKasir(finalRemaining);
      }

      function hapusKasirAddon(idx) {
        currentAddons.splice(idx, 1);
        renderKasirAddons();
      }

      document.getElementById('kasirPresetAddon').addEventListener('change', function() {
        var priceCol = document.getElementById('kasirCustomPriceCol');
        if (this.value === 'custom') {
          priceCol.style.display = 'block';
        } else {
          priceCol.style.display = 'none';
        }
      });

      document.getElementById('btnKasirAddService').addEventListener('click', function() {
        var select = document.getElementById('kasirPresetAddon');
        var val = select.value;
        if (!val) {
          alert('Pilih jenis layanan tambahan terlebih dahulu.');
          return;
        }

        var name = '';
        var price = 0;

        if (val === 'custom') {
          var customInput = prompt('Masukkan nama layanan / aksesoris tambahan:', 'Charm 3D Ekstra');
          if (!customInput) return;
          name = customInput;
          price = parseInt(document.getElementById('kasirCustomPrice').value, 10) || 25000;
        } else {
          var opt = select.options[select.selectedIndex];
          name = opt.value;
          price = parseInt(opt.getAttribute('data-price'), 10);
        }

        currentAddons.push({ name: name, price: price });
        select.selectedIndex = 0;
        document.getElementById('kasirCustomPriceCol').style.display = 'none';
        renderKasirAddons();
      });

      document.getElementById('btnKasirSelesaikan').addEventListener('click', function() {
        if (!currentActiveAppt) return;
        var remaining = document.getElementById('kasirValFinalRemaining').textContent;
        var methodEl = document.querySelector('input[name="payment_method_final"]:checked');
        var method = methodEl ? methodEl.value.toUpperCase() : 'CASH';

        alert('Appointment untuk ' + currentActiveAppt.klien + ' berhasil diselesaikan!\n\nPelunasan sebesar ' + remaining + ' (' + method + ') telah diterima di kasir studio. Terima kasih!');

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
          action.innerHTML = '<span style="font-size:0.84rem; color:#27ae60; font-weight:600; align-self:center;">✓ Lunas (' + remaining + ')</span>' +
                             '<button type="button" class="lq-btn lq-btn-outline lq-btn-sm" onclick="bukaKasirPelunasan(\'' + id + '\')">Detail Kasir</button>';
        }

        var modalEl = bootstrap.Modal.getInstance(document.getElementById('modalKasirPelunasan'));
        if (modalEl) modalEl.hide();
      });

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
                  '      <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" onclick="lihatDetail(\'' + item.klien + '\', \'' + item.layanan + '\')">Detail</button>' +
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
