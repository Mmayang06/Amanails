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

    <style>
      .lq-terapis-header {
        background: var(--lq-white);
        border-bottom: 1px solid var(--lq-line-soft);
        padding: 1.15rem 0;
        position: sticky;
        top: 0;
        z-index: 100;
      }
      .lq-appt-card {
        background: var(--lq-white);
        border-radius: var(--lq-radius-lg);
        padding: 1.8rem 2rem;
        border: 1px solid var(--lq-line-soft);
        margin-bottom: 1.25rem;
        transition: transform 0.3s var(--lq-ease), box-shadow 0.3s var(--lq-ease);
      }
      .lq-appt-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--lq-shadow-soft);
      }
      .lq-eyebrow::before,
      .lq-eyebrow::after {
        display: none !important;
      }
      .lq-shape-radio {
        display: none;
      }
      .lq-shape-label {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.35rem 0.75rem;
        border-radius: var(--lq-radius);
        border: 1px solid var(--lq-line-soft);
        background: var(--lq-white);
        font-size: 0.78rem;
        font-weight: 500;
        color: var(--lq-ink);
        cursor: pointer;
        transition: all 0.2s ease;
      }
      .lq-shape-radio:checked + .lq-shape-label {
        background: var(--lq-plum);
        color: #fff;
        border-color: var(--lq-plum);
      }

      /* ================= KALENDER JADWAL 1 BULAN ================= */
      .lq-calendar-card {
        background: var(--lq-white);
        border-radius: var(--lq-radius-lg);
        padding: 1.6rem;
        border: 1px solid var(--lq-line-soft);
        margin-bottom: 1.5rem;
      }
      .lq-calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 6px;
      }
      .lq-cal-day-head {
        text-align: center;
        font-size: 0.72rem;
        font-weight: 600;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        color: var(--lq-mauve);
        padding: 0.4rem 0;
      }
      .lq-cal-cell {
        background: var(--lq-cream-2);
        border-radius: var(--lq-radius);
        border: 1px solid var(--lq-line-soft);
        min-height: 68px;
        padding: 6px 8px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        cursor: pointer;
        transition: all 0.2s ease;
        position: relative;
        text-align: left;
      }
      .lq-cal-cell:hover {
        border-color: var(--lq-rose);
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(42, 29, 37, 0.08);
      }
      .lq-cal-cell.is-other-month {
        opacity: 0.35;
        background: transparent;
        cursor: default;
      }
      .lq-cal-cell.is-today {
        border: 2px solid var(--lq-gold);
        background: #fffdf8;
      }
      .lq-cal-cell.is-selected {
        background: var(--lq-plum) !important;
        color: #fff !important;
        border-color: var(--lq-plum) !important;
        box-shadow: 0 4px 12px rgba(42, 29, 37, 0.25);
      }
      .lq-cal-cell.is-selected .lq-cal-num {
        color: #fff !important;
      }
      .lq-cal-cell.is-selected .lq-cal-badge {
        background: rgba(255, 255, 255, 0.22) !important;
        color: #fff !important;
      }
      .lq-cal-cell.has-appt {
        background: #fffcfd;
        border-color: rgba(162, 93, 107, 0.4);
      }
      .lq-cal-num {
        font-family: var(--lq-serif);
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--lq-ink);
        line-height: 1;
      }
      .lq-cal-badge {
        font-size: 0.64rem;
        font-weight: 600;
        color: var(--lq-rose-deep);
        background: rgba(162, 93, 107, 0.12);
        padding: 2px 5px;
        border-radius: 4px;
        display: inline-block;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
      .lq-view-toggle-btn {
        padding: 0.45rem 1rem;
        font-size: 0.78rem;
        font-weight: 500;
        border-radius: 999px;
        border: 1px solid var(--lq-line-soft);
        background: var(--lq-white);
        color: var(--lq-ink);
        cursor: pointer;
        transition: all 0.2s ease;
      }
      .lq-view-toggle-btn.is-active {
        background: var(--lq-plum);
        color: #fff;
        border-color: var(--lq-plum);
      }
    </style>
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

          <!-- Navigasi -->
          <div class="d-flex align-items-center gap-2">
            <a href="{{ route('terapis.karya') }}" class="lq-btn lq-btn-outline lq-btn-sm">
              Lookbook Karya &rarr;
            </a>
          </div>
        </div>
      </div>
    </header>

    <!-- ===================== MAIN CONTENT ===================== -->
    <main class="py-4 py-lg-5">
      <div class="container">

        <!-- Banner Profil Terapis (Sesuai Kartu Unggulan Template .lq-pkg-card.is-featured) -->
        <div class="lq-pkg-card is-featured mb-4" style="transform: none; padding: 2.2rem 2.4rem;">
          <div class="row align-items-center g-4">
            <div class="col-lg-8">
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

            <div class="col-lg-4 text-lg-end">
              <div class="d-inline-block text-lg-end">
                <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.16em; color: var(--lq-gold-soft); display: block;">Rating Kepuasan Klien</span>
                <div style="font-size: 2rem; font-weight: 500; color: #fff; font-family: var(--lq-serif); line-height: 1.1; margin-top: 0.25rem;">
                  ★ {{ $terapis['rating'] }} <small style="font-size: 0.85rem; color: var(--lq-mauve-soft); font-family: var(--lq-sans);">/ 5.0</small>
                </div>
                <small style="font-size: 0.78rem; color: var(--lq-mauve-soft);">Berdasarkan {{ $terapis['total_ulasan'] }} ulasan terverifikasi</small>
              </div>
            </div>
          </div>
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

        <div class="row g-4">
          <!-- ================= KONTEN KIRI: DAFTAR JANJI TEMU & KALENDER ================= -->
          <div class="col-lg-8">
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
                      <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" onclick="lihatDetail('{{ $item['klien'] }}', '{{ $item['layanan'] }}')">
                        Detail
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

        <!-- ================= KONTEN KANAN: PENGAJUAN CUTI & PORTOFOLIO ================= -->
          <div class="col-lg-4">
            
            <!-- Fitur Pengajuan Cuti (Format Kartu Template .lq-pkg-card) -->
            <div class="lq-pkg-card mb-4">
              <span class="lq-eyebrow" style="margin-bottom: 0.35rem;">Pengajuan Cuti</span>
              <h3>Cuti &amp; Izin Terapis</h3>
              <p class="lq-pkg-sub">Alokasi cuti aktif periode {{ date('F Y') }}</p>

              <div class="lq-pkg-price mb-3">
                {{ $dataCuti['sisa_cuti'] }}<small style="font-size: 0.95rem;"> / {{ $dataCuti['kuota_bulanan'] }} hari tersisa</small>
              </div>

              <ul class="lq-pkg-list mb-3">
                <li>Jatah kuota bulanan: <strong>8 Hari Sebulan</strong></li>
                <li>Cuti yang telah terpakai: <strong>{{ $dataCuti['cuti_terpakai'] }} Hari</strong></li>
                <li>Sisa kuota bulan berjalan: <strong>{{ $dataCuti['sisa_cuti'] }} Hari</strong></li>
              </ul>

              <!-- Tombol Pengajuan Cuti Modal -->
              <button type="button" class="lq-btn lq-btn-primary lq-btn-block mb-3" data-bs-toggle="modal" data-bs-target="#modalAjukanCuti">
                Ajukan Cuti Baru
              </button>

              <!-- Riwayat Pengajuan Cuti -->
              <span class="lq-eyebrow" style="font-size: 0.68rem; margin-bottom: 0.65rem; display: block;">Riwayat Pengajuan</span>

              <div id="riwayatCutiList">
                @foreach($dataCuti['riwayat'] as $cuti)
                  <div class="p-3 rounded mb-2" style="background: var(--lq-cream-2); border: 1px solid var(--lq-line-soft); font-size: 0.84rem;">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                      <strong style="color: var(--lq-ink); font-family: var(--lq-serif); font-size: 0.95rem;">{{ $cuti['tipe'] }}</strong>
                      <span class="lq-pkg-tag" style="position: static; font-size: 0.58rem; padding: 0.2rem 0.55rem; background: var(--lq-white); color: var(--lq-mauve);">
                        {{ $cuti['status'] }}
                      </span>
                    </div>
                    <div style="font-size: 0.8rem; color: var(--lq-mauve); margin-bottom: 0.25rem;">
                      {{ $cuti['tanggal'] }} &middot; {{ $cuti['durasi'] }}
                    </div>
                    <div style="font-size: 0.8rem; color: var(--lq-mauve-soft); font-style: italic;">
                      &ldquo;{{ $cuti['alasan'] }}&rdquo;
                    </div>
                  </div>
                @endforeach
              </div>
            </div>

            <!-- Galeri Portofolio Terapis (Format Kartu Template .lq-pkg-card) -->
            <div class="lq-pkg-card mb-4">
              <div class="d-flex justify-content-between align-items-baseline mb-2">
                <div>
                  <span class="lq-eyebrow" style="margin-bottom: 0.2rem;">Galeri Studio</span>
                  <h3 style="font-size: 1.35rem; margin-bottom: 0.2rem;">Karya Anda</h3>
                </div>
                <a href="{{ route('terapis.karya') }}" style="font-size: 0.78rem; color: var(--lq-rose-deep); text-decoration: none;">Lihat Semua &rarr;</a>
              </div>
              <p class="lq-pkg-sub" style="margin-bottom: 1.25rem;">Dokumentasi hasil karya manikur &amp; nail art terbaru</p>

              <div class="row g-2" id="karyaContainer">
                @foreach($karyaTerapis as $karya)
                  <div class="col-6">
                    <div style="position: relative; border-radius: var(--lq-radius); overflow: hidden; height: 110px;">
                      <img src="{{ $karya['img'] }}" alt="{{ $karya['judul'] }}" style="width: 100%; height: 100%; object-fit: cover;">
                      <div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(42,29,37,0.85), transparent 70%); display: flex; flex-direction: column; justify-content: flex-end; padding: 0.5rem; color: #fff;">
                        <span style="font-size: 0.75rem; font-weight: 500;">{{ $karya['judul'] }}</span>
                        <small style="font-size: 0.65rem; color: var(--lq-gold-soft);">&hearts; {{ $karya['suka'] }} suka</small>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
              <button type="button" class="lq-btn lq-btn-outline lq-btn-block lq-btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#modalTambahKarya">
                + Tambah Foto Karya
              </button>
            </div>

          </div>
        </div>

      </div>
    </main>

    <!-- ===================== MODAL AJUKAN CUTI (SESUAI GAYA FORM TEMPLATE) ===================== -->
    <div class="modal fade" id="modalAjukanCuti" tabindex="-1" aria-labelledby="modalAjukanCutiLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: var(--lq-radius-lg); border: 1px solid var(--lq-line-soft); box-shadow: var(--lq-shadow); background: var(--lq-white);">
          <div class="modal-header" style="background: var(--lq-cream); border-bottom: 1px solid var(--lq-line-soft); padding: 1.5rem 1.8rem;">
            <div>
              <span class="lq-eyebrow" style="font-size: 0.68rem; margin-bottom: 2px;">Formulir Internal Terapis</span>
              <h4 class="modal-title" id="modalAjukanCutiLabel" style="font-family: var(--lq-serif); font-size: 1.45rem; color: var(--lq-ink); margin: 0;">Ajukan Cuti Bulanan</h4>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body" style="padding: 1.8rem;">
            <form id="formCuti" onsubmit="event.preventDefault(); submitCuti();">
              <div class="lq-field mb-3">
                <label for="jenisCuti">Jenis Cuti / Izin <span class="req">*</span></label>
                <select class="lq-select" id="jenisCuti" required>
                  <option value="">Pilih jenis cuti...</option>
                  <option value="Cuti Bulanan">Cuti Bulanan Reguler</option>
                  <option value="Izin Sakit">Izin Sakit</option>
                  <option value="Keperluan Keluarga">Keperluan Keluarga / Mendesak</option>
                  <option value="Cuti Khusus">Cuti Khusus (Menikah / Melahirkan)</option>
                </select>
              </div>

              <div class="lq-field-row mb-3">
                <div class="lq-field">
                  <label for="tglMulai">Tanggal Mulai <span class="req">*</span></label>
                  <input type="date" class="lq-input" id="tglMulai" required>
                </div>
                <div class="lq-field">
                  <label for="tglSelesai">Tanggal Selesai <span class="req">*</span></label>
                  <input type="date" class="lq-input" id="tglSelesai" required>
                </div>
              </div>

              <div class="lq-field mb-3">
                <label for="alasanCuti">Alasan / Keterangan <span class="req">*</span></label>
                <textarea class="lq-textarea" id="alasanCuti" placeholder="Jelaskan keperluan pengajuan cuti Anda secara singkat..." required style="min-height: 85px;"></textarea>
              </div>

              <div class="p-3 rounded mb-3" style="background: var(--lq-cream-2); font-size: 0.82rem; color: var(--lq-mauve);">
                <em>Catatan:</em> Kuota cuti terapis adalah <strong>8 hari sebulan</strong>. Mohon ajukan beberapa hari sebelumnya agar resepsionis dapat mengelola reservasi klien.
              </div>

              <div class="d-flex justify-content-end gap-2 pt-2">
                <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="lq-btn lq-btn-primary lq-btn-sm">Kirim Pengajuan Cuti</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

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

      function submitCuti() {
        var jenis = document.getElementById('jenisCuti').value;
        var tglMulai = document.getElementById('tglMulai').value;
        var tglSelesai = document.getElementById('tglSelesai').value;
        var alasan = document.getElementById('alasanCuti').value;

        if (!jenis || !tglMulai || !tglSelesai || !alasan) {
          alert('Silakan lengkapi semua data formulir pengajuan cuti.');
          return;
        }

        // Tutup modal
        var modalEl = document.getElementById('modalAjukanCuti');
        var modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();

        // Tambah ke riwayat list secara dinamis
        var riwayatContainer = document.getElementById('riwayatCutiList');
        var itemBaru = document.createElement('div');
        itemBaru.className = 'p-3 rounded mb-2';
        itemBaru.style.cssText = 'background: var(--lq-cream-2); border: 1px solid var(--lq-line-soft); font-size: 0.84rem;';
        itemBaru.innerHTML = '<div class="d-flex justify-content-between align-items-center mb-1">' +
                             '<strong style="color: var(--lq-ink); font-family: var(--lq-serif); font-size: 0.95rem;">' + jenis + '</strong>' +
                             '<span class="lq-pkg-tag" style="position: static; font-size: 0.58rem; padding: 0.2rem 0.55rem; background: var(--lq-gold); color: var(--lq-plum-deep);">Menunggu Persetujuan</span>' +
                             '</div>' +
                             '<div style="font-size: 0.8rem; color: var(--lq-mauve); margin-bottom: 0.25rem;">' + tglMulai + ' s/d ' + tglSelesai + '</div>' +
                             '<div style="font-size: 0.8rem; color: var(--lq-mauve-soft); font-style: italic;">&ldquo;' + alasan + '&rdquo;</div>';
        
        riwayatContainer.insertBefore(itemBaru, riwayatContainer.firstChild);

        alert('Pengajuan cuti (' + jenis + ') berhasil dikirim ke manajer salon!');
        document.getElementById('formCuti').reset();
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
        col.className = 'col-6';
        col.innerHTML = '<div style="position: relative; border-radius: var(--lq-radius); overflow: hidden; height: 110px;">' +
                        '<img src="' + imgSrc + '" alt="' + judul + '" style="width: 100%; height: 100%; object-fit: cover;">' +
                        '<div style="position: absolute; inset: 0; background: linear-gradient(to top, rgba(42,29,37,0.85), transparent 70%); display: flex; flex-direction: column; justify-content: flex-end; padding: 0.5rem; color: #fff;">' +
                        '<span style="font-size: 0.75rem; font-weight: 500;">' + judul + '</span>' +
                        '<small style="font-size: 0.65rem; color: var(--lq-gold-soft);">' + shape + ' &bull; ⏱ ' + durasi + ' &bull; &hearts; 0 baru</small>' +
                        '</div>' +
                        '</div>';

        container.insertBefore(col, container.firstChild);

        alert('Foto karya "' + judul + '" (' + shape + ' · Estimasi ' + durasi + ') berhasil ditambahkan ke lookbook Anda!');
        document.getElementById('formKarya').reset();
        document.getElementById('boxPreviewKarya').style.display = 'none';
        uploadedKaryaImgUrl = '';
      }

      function lihatDetail(klien, layanan) {
        if (!klien) {
          alert('Informasi riwayat perawatan klien ini tersimpan aman di sistem.');
          return;
        }
        alert('Klien: ' + klien + '\nLayanan: ' + layanan + '\nStatus: Terjadwal di Meja Amanails Nail Bar');
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

          (function(k) {
            cell.onclick = function() {
              selectedCalDate = k;
              document.querySelectorAll('.lq-cal-cell').forEach(function(el) {
                el.classList.remove('is-selected');
              });
              cell.classList.add('is-selected');
              renderSelectedDateDetails(k);
            };
          })(dateKey);

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
