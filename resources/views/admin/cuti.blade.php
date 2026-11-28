<!DOCTYPE html>
<html lang="id">
  <head>
    <script>document.documentElement.classList.add('js')</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Approve Cuti Nail Artist &mdash; Amanails Nail Bar</title>
    <meta name="description" content="Halaman persetujuan cuti nail artist Amanails Nail Bar.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400;1,9..144,500&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
      /* ─── stat cards (terapis style) ─── */
      .lq-appt-card {
        background: var(--lq-white);
        border-radius: var(--lq-radius-lg);
        padding: 1.8rem 2rem;
        border: 1px solid var(--lq-line-soft);
        margin-bottom: 1.25rem;
        transition: transform 0.3s var(--lq-ease), box-shadow 0.3s var(--lq-ease), border-color 0.25s var(--lq-ease);
      }
      .lq-appt-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--lq-shadow-soft);
      }
      .lq-appt-card.is-filter-active {
        border-color: var(--lq-rose-deep);
        box-shadow: 0 10px 24px -14px rgba(139, 77, 90, 0.45);
      }
      .lq-eyebrow::before,
      .lq-eyebrow::after { display: none !important; }

      /* ─── table ─── */
      .adm-table-wrap {
        background: var(--lq-white);
        border: 1px solid var(--lq-line-soft);
        border-radius: var(--lq-radius-lg);
        overflow-x: auto;
      }
      .adm-table-wrap table { margin: 0; }
      .adm-table-wrap thead th {
        background: var(--lq-cream-2);
        font-size: 0.7rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: var(--lq-mauve);
        border-bottom: 1px solid var(--lq-line-soft);
        padding: 0.7rem 1rem;
        font-weight: 600;
        white-space: nowrap;
        border-top: none;
      }
      .adm-table-wrap tbody td {
        padding: 0.75rem 1rem;
        font-size: 0.87rem;
        border-bottom: 1px solid var(--lq-line-soft);
        vertical-align: middle;
        color: var(--lq-ink);
      }
      .adm-table-wrap tbody tr:last-child td { border-bottom: none; }
      .adm-table-wrap tbody tr:hover td { background: var(--lq-cream); }

      /* ─── status badges ─── */
      .adm-badge {
        display: inline-block;
        padding: 0.32rem 0.8rem;
        border-radius: 30px;
        font-size: 0.65rem;
        font-weight: 600;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        font-family: var(--lq-sans);
        line-height: 1.2;
        white-space: nowrap;
      }
      .adm-badge.disetujui {
        background: #eef6ee;
        color: #27ae60;
        border: 1px solid rgba(39, 174, 96, 0.25);
      }
      .adm-badge.menunggu {
        background: #fdf6e7;
        color: #b07c10;
        border: 1px solid rgba(176, 124, 16, 0.25);
      }
      .adm-badge.ditolak {
        background: #fdf0f0;
        color: #c62828;
        border: 1px solid rgba(198, 40, 40, 0.25);
      }

      /* ─── table action buttons (Amanails lq-btn style) ─── */
      .lq-btn-table {
        padding: 0.45rem 1rem !important;
        font-size: 0.72rem !important;
        letter-spacing: 0.12em !important;
        border-radius: 30px !important;
        font-weight: 600 !important;
        line-height: 1 !important;
        text-transform: uppercase !important;
        font-family: var(--lq-sans) !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: all 0.25s var(--lq-ease) !important;
        white-space: nowrap !important;
      }
      .lq-btn-table-danger {
        background: transparent !important;
        color: #c62828 !important;
        border: 1px solid rgba(198, 40, 40, 0.35) !important;
      }
      .lq-btn-table-danger:hover {
        background: #c62828 !important;
        color: #fff !important;
        border-color: #c62828 !important;
        transform: translateY(-2px);
      }

      /* ─── toolbar ─── */
      .adm-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 1rem;
      }
      .adm-section-title { font-family: var(--lq-serif); font-size: 1.15rem; color: var(--lq-ink); margin: 0; }
      .adm-section-eyebrow { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--lq-mauve); }

      /* ─── modal styling (sesuai desain Amanails) ─── */
      .adm-detail-box {
        background: var(--lq-cream);
        border: 1px solid var(--lq-line-soft);
        border-radius: var(--lq-radius);
        padding: 1rem 1.15rem;
      }
      .adm-detail-row {
        display: flex;
        justify-content: space-between;
        gap: 0.75rem;
        font-size: 0.86rem;
        padding: 0.35rem 0;
        border-bottom: 1px dashed var(--lq-line-soft);
      }
      .adm-detail-row:last-child { border-bottom: none; }
      .adm-detail-row span:first-child { color: var(--lq-mauve); }
      .adm-detail-row strong { color: var(--lq-ink); text-align: right; }

      .adm-reason-chip {
        background: var(--lq-cream-2);
        border: 1px solid var(--lq-line-soft);
        color: var(--lq-ink);
        font-size: 0.74rem;
        padding: 0.28rem 0.7rem;
        border-radius: 999px;
        cursor: pointer;
        transition: all 0.2s ease;
      }
      .adm-reason-chip:hover {
        border-color: var(--lq-rose);
        background: var(--lq-blush-soft);
        color: var(--lq-rose-deep);
      }
    </style>
  </head>
  <body style="background: var(--lq-cream); min-height: 100vh;">
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
            <li>
              <a href="{{ url('/admin/cuti') }}" class="is-active">
                Approve Cuti
                <span class="adm-nav-badge {{ ($pendingCutiCount ?? 0) === 0 ? 'is-zero' : '' }}" id="navCutiBadge">{{ $pendingCutiCount ?? 0 }}</span>
              </a>
            </li>
            <li><a href="{{ url('/admin/katalog') }}">Katalog</a></li>
          </ul>
        </nav>

        <div class="lq-nav-cta d-flex align-items-center gap-2">
          <span class="lq-nav-desktop me-2" style="font-size: 0.82rem; color: var(--lq-mauve);">Halo, <strong>{{ Auth::user()->name ?? 'Admin' }}</strong></span>
          <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="lq-btn lq-btn-outline lq-btn-sm">Keluar</button>
          </form>
          <button class="lq-nav-toggle" type="button" aria-label="Buka menu navigasi" aria-expanded="false" aria-controls="mobile-nav" data-nav-toggle>
            <span></span><span></span><span></span>
          </button>
        </div>
      </div>
    </header>

    <div class="lq-nav-mobile" id="mobile-nav" data-nav-mobile>
      <ul>
        <li><a href="{{ url('/admin/dashboard') }}">Appointment</a></li>
        <li><a href="{{ url('/admin/pembayaran') }}">Pembayaran</a></li>
        <li><a href="{{ url('/admin/cuti') }}" class="is-active">Approve Cuti <span class="adm-nav-badge {{ ($pendingCutiCount ?? 0) === 0 ? 'is-zero' : '' }}" id="navCutiBadgeMobile">{{ $pendingCutiCount ?? 0 }}</span></a></li>
        <li><a href="{{ url('/admin/katalog') }}">Katalog</a></li>
      </ul>
    </div>

    <!-- ===================== MAIN ===================== -->
    <main id="main" style="padding-top: 115px; padding-bottom: 4rem;">
      <div class="container">

        <div id="cutiToast" class="alert mb-4" role="status" style="display: none; border-radius: var(--lq-radius); font-size: 0.88rem; transition: opacity 0.4s ease;"></div>

        <!-- ─── STAT CARDS ─── -->
        <div class="row g-3 mb-4">
          <div class="col-6 col-md-3">
            <div class="lq-appt-card text-center mb-0 p-4 is-filter-active" data-cuti-card="all" onclick="filterCuti('all')" style="cursor: pointer;" title="Klik untuk tampilkan semua">
              <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Semua Pengajuan</span>
              <div id="statTotalCuti" style="font-family: var(--lq-serif); font-size: 2.8rem; color: var(--lq-rose-deep); line-height: 1; margin-bottom: 0.35rem;">{{ $stats['total'] }}</div>
              <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Total Permohonan</div>
              <small style="font-size: 0.8rem; color: var(--lq-mauve);">Pengajuan cuti nail artist</small>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="lq-appt-card text-center mb-0 p-4" data-cuti-card="menunggu" onclick="filterCuti('menunggu')" style="cursor: pointer;" title="Klik untuk filter menunggu persetujuan">
              <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Perlu Ditinjau</span>
              <div id="statMenungguCuti" style="font-family: var(--lq-serif); font-size: 2.8rem; color: var(--lq-gold); line-height: 1; margin-bottom: 0.35rem;">{{ $stats['menunggu'] }}</div>
              <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Menunggu Review</div>
              <small style="font-size: 0.8rem; color: var(--lq-mauve);">Belum dikonfirmasi admin</small>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="lq-appt-card text-center mb-0 p-4" data-cuti-card="disetujui" onclick="filterCuti('disetujui')" style="cursor: pointer;" title="Klik untuk filter disetujui">
              <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Disetujui</span>
              <div id="statDisetujuiCuti" style="font-family: var(--lq-serif); font-size: 2.8rem; color: #27ae60; line-height: 1; margin-bottom: 0.35rem;">{{ $stats['disetujui'] }}</div>
              <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Cuti Disetujui</div>
              <small style="font-size: 0.8rem; color: var(--lq-mauve);">Izin cuti telah terbit</small>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="lq-appt-card text-center mb-0 p-4" data-cuti-card="ditolak" onclick="filterCuti('ditolak')" style="cursor: pointer;" title="Klik untuk filter ditolak">
              <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Ditolak</span>
              <div id="statDitolakCuti" style="font-family: var(--lq-serif); font-size: 2.8rem; color: #c62828; line-height: 1; margin-bottom: 0.35rem;">{{ $stats['ditolak'] }}</div>
              <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Permohonan Ditolak</div>
              <small style="font-size: 0.8rem; color: var(--lq-mauve);">Tidak memenuhi syarat</small>
            </div>
          </div>
        </div>

        <!-- ─── DAFTAR PENGAJUAN CUTI ─── -->
        <div class="row g-4">
          <div class="col-12">

            <div class="adm-toolbar">
              <div>
                <div class="adm-section-eyebrow">Admin &middot; Persetujuan Cuti</div>
                <h3 class="adm-section-title">Approve Cuti Nail Artist <small id="activeCutiFilterLabel" style="font-family: var(--lq-sans); font-size: 0.78rem; color: var(--lq-mauve); font-weight: 400;">(Menampilkan semua)</small></h3>
              </div>
            </div>

            <div class="adm-table-wrap">
              <table class="table table-borderless" id="cutiTableWrap">
                <thead>
                  <tr>
                    <th>Nail Artist</th>
                    <th>Jenis Cuti</th>
                    <th>Tanggal Cuti</th>
                    <th>Lama</th>
                    <th>Alasan</th>
                    <th>Keterangan Persetujuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody id="cutiBody">
                  <!-- Rendered dynamically from DB via JS -->
                </tbody>
              </table>

              <div id="emptyCutiState" style="display: none; padding: 3rem 1.5rem; text-align: center;">
                <h4 style="font-family: var(--lq-serif); color: var(--lq-ink); margin-bottom: 0.35rem;">Tidak Ada Permohonan Cuti</h4>
                <p style="font-size: 0.88rem; color: var(--lq-mauve); margin-bottom: 0; max-width: 420px; margin-inline: auto;">
                  Belum ada pengajuan cuti yang sesuai dengan kategori status yang dipilih.
                </p>
              </div>
            </div>

          </div>
        </div>

      </div>
    </main>

    <!-- ===================== MODAL POP-UP: SETUJUI PENGAJUAN CUTI ===================== -->
    <div class="modal fade" id="modalSetujuiCuti" tabindex="-1" aria-labelledby="modalSetujuiCutiLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: none; border-radius: var(--lq-radius-lg); overflow: hidden; box-shadow: 0 30px 80px -20px rgba(0,0,0,0.45); background: var(--lq-white);">
          <div class="modal-header" style="background: var(--lq-cream); border-bottom: 1px solid var(--lq-line-soft); padding: 1.35rem 1.75rem;">
            <div>
              <span class="lq-eyebrow" style="font-size: 0.68rem; margin-bottom: 0.2rem; display: block;">Konfirmasi Persetujuan</span>
              <h4 class="modal-title" id="modalSetujuiCutiLabel" style="font-family: var(--lq-serif); font-size: 1.4rem; color: var(--lq-ink); margin: 0;">
                Setujui Pengajuan Cuti
              </h4>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>

          <div class="modal-body" style="padding: 1.65rem 1.75rem;">
            <div class="adm-detail-box mb-3">
              <div class="adm-detail-row">
                <span>Nail Artist</span>
                <strong id="approveModalArtist">-</strong>
              </div>
              <div class="adm-detail-row">
                <span>Jenis Cuti</span>
                <strong id="approveModalType">-</strong>
              </div>
              <div class="adm-detail-row">
                <span>Tanggal &amp; Lama</span>
                <strong id="approveModalSchedule">-</strong>
              </div>
              <div class="adm-detail-row">
                <span>Alasan</span>
                <strong id="approveModalReason">-</strong>
              </div>
            </div>

            <div class="lq-field mb-2">
              <label for="approveCutiNote" style="font-size: 0.78rem;">Keterangan Persetujuan (Opsional)</label>
              <textarea id="approveCutiNote" class="lq-textarea" rows="3" placeholder="Tulis catatan persetujuan untuk nail artist..." style="min-height: 85px;"></textarea>
            </div>

            <div class="d-flex flex-wrap gap-1 mb-4">
              <button type="button" class="adm-reason-chip" onclick="setApproveCutiNote('Disetujui, slot meja kerja sudah dialihkan sementara')">Slot dialihkan</button>
              <button type="button" class="adm-reason-chip" onclick="setApproveCutiNote('Disetujui sesuai kuota cuti bulanan')">Sesuai kuota</button>
              <button type="button" class="adm-reason-chip" onclick="setApproveCutiNote('Disetujui, selamat beristirahat')">Selamat beristirahat</button>
            </div>

            <div class="d-flex gap-2 justify-content-end">
              <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" data-bs-dismiss="modal">Batal</button>
              <button type="button" id="btnConfirmApproveCuti" class="lq-btn lq-btn-primary lq-btn-sm" onclick="confirmApproveCuti()">
                Setujui Pengajuan
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ===================== MODAL POP-UP: TOLAK PENGAJUAN CUTI ===================== -->
    <div class="modal fade" id="modalTolakCuti" tabindex="-1" aria-labelledby="modalTolakCutiLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: none; border-radius: var(--lq-radius-lg); overflow: hidden; box-shadow: 0 30px 80px -20px rgba(0,0,0,0.45); background: var(--lq-white);">
          <div class="modal-header" style="background: var(--lq-cream); border-bottom: 1px solid var(--lq-line-soft); padding: 1.35rem 1.75rem;">
            <div>
              <span class="lq-eyebrow" style="font-size: 0.68rem; margin-bottom: 0.2rem; display: block;">Konfirmasi Penolakan</span>
              <h4 class="modal-title" id="modalTolakCutiLabel" style="font-family: var(--lq-serif); font-size: 1.4rem; color: var(--lq-ink); margin: 0;">
                Tolak Pengajuan Cuti
              </h4>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>

          <div class="modal-body" style="padding: 1.65rem 1.75rem;">
            <div class="adm-detail-box mb-3">
              <div class="adm-detail-row">
                <span>Nail Artist</span>
                <strong id="rejectModalArtist">-</strong>
              </div>
              <div class="adm-detail-row">
                <span>Jenis Cuti</span>
                <strong id="rejectModalType">-</strong>
              </div>
              <div class="adm-detail-row">
                <span>Tanggal &amp; Lama</span>
                <strong id="rejectModalSchedule">-</strong>
              </div>
            </div>

            <div class="lq-field mb-2">
              <label for="rejectCutiNote" style="font-size: 0.78rem;">Alasan Penolakan (Opsional)</label>
              <textarea id="rejectCutiNote" class="lq-textarea" rows="3" placeholder="Tulis alasan penolakan untuk nail artist..." style="min-height: 85px;"></textarea>
            </div>

            <div class="d-flex flex-wrap gap-1 mb-4">
              <button type="button" class="adm-reason-chip" onclick="setRejectCutiReason('Jadwal studio sedang penuh di tanggal tersebut')">Jadwal studio penuh</button>
              <button type="button" class="adm-reason-chip" onclick="setRejectCutiReason('Pengajuan cuti terlalu mendadak')">Terlalu mendadak</button>
              <button type="button" class="adm-reason-chip" onclick="setRejectCutiReason('Kuota cuti bulanan sudah melebihi batas')">Kuota habis</button>
            </div>

            <div class="d-flex gap-2 justify-content-end">
              <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" data-bs-dismiss="modal">Batal</button>
              <button type="button" id="btnConfirmRejectCuti" class="lq-btn lq-btn-table-danger" style="border-radius: 999px; padding: 0.7rem 1.4rem !important; font-size: 0.78rem; font-weight: 600; letter-spacing: 0.08em; text-transform: uppercase;" onclick="confirmRejectCuti()">
                Tolak Pengajuan
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ===================== MODAL POP-UP: DETAIL PENGAJUAN CUTI ===================== -->
    <div class="modal fade" id="modalDetailCuti" tabindex="-1" aria-labelledby="modalDetailCutiLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border: none; border-radius: var(--lq-radius-lg); overflow: hidden; box-shadow: 0 30px 80px -20px rgba(0,0,0,0.45); background: var(--lq-white);">
          <div class="modal-header" style="background: var(--lq-cream); border-bottom: 1px solid var(--lq-line-soft); padding: 1.35rem 1.75rem;">
            <div>
              <span class="lq-eyebrow" style="font-size: 0.68rem; margin-bottom: 0.2rem; display: block;">Informasi Cuti Nail Artist</span>
              <div class="d-flex align-items-center gap-2 flex-wrap">
                <h4 class="modal-title" id="modalDetailCutiLabel" style="font-family: var(--lq-serif); font-size: 1.4rem; color: var(--lq-ink); margin: 0;">
                  Detail Pengajuan Cuti
                </h4>
                <span id="detailCutiStatusBadge" class="adm-badge disetujui">Disetujui</span>
              </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>

          <div class="modal-body" style="padding: 1.65rem 1.75rem;">
            <div class="adm-detail-box mb-3">
              <div class="adm-detail-row">
                <span>Nail Artist</span>
                <strong id="detailCutiArtist">-</strong>
              </div>
              <div class="adm-detail-row">
                <span>Jenis Cuti</span>
                <strong id="detailCutiType">-</strong>
              </div>
              <div class="adm-detail-row">
                <span>Tanggal Cuti</span>
                <strong id="detailCutiTanggal">-</strong>
              </div>
              <div class="adm-detail-row">
                <span>Durasi</span>
                <strong id="detailCutiDurasi">-</strong>
              </div>
            </div>

            <div class="adm-detail-box mb-3">
              <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--lq-mauve); font-weight: 600; display: block; margin-bottom: 0.35rem;">Alasan Nail Artist</span>
              <p id="detailCutiAlasan" class="mb-0" style="font-size: 0.88rem; color: var(--lq-ink); font-style: italic;">-</p>
            </div>

            <div id="detailCutiAdminNoteBox" class="adm-detail-box mb-4" style="display: none; background: var(--lq-cream-2);">
              <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--lq-mauve); font-weight: 600; display: block; margin-bottom: 0.35rem;">Catatan Admin</span>
              <p id="detailCutiAdminNote" class="mb-0" style="font-size: 0.86rem; color: var(--lq-ink);">-</p>
            </div>

            <div class="d-flex justify-content-end">
              <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" data-bs-dismiss="modal">Tutup</button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- ===================== FOOTER ===================== -->
    <footer class="lq-footer">
      <div class="container">
        <div class="row g-4">
          <div class="col-lg-4">
            <a class="lq-brand" href="{{ url('/') }}">Amanails<span class="lq-dot">.</span><small>Nail Bar</small></a>
            <p style="margin-top:1.25rem;max-width:32ch">Boutique nail bar estetik dengan perawatan manikur ahli, kutek
              gel tahan lama, dan nail art lukis tangan di studio yang tenang dan higienis.</p>
          </div>
          <div class="col-6 col-lg-2">
            <h5>Admin</h5>
            <ul>
              <li><a href="{{ url('/admin/dashboard') }}">Appointment</a></li>
              <li><a href="{{ url('/admin/pembayaran') }}">Pembayaran</a></li>
              <li><a href="{{ url('/admin/cuti') }}">Approve Cuti</a></li>
              <li><a href="{{ url('/admin/katalog') }}">Katalog</a></li>
            </ul>
          </div>
          <div class="col-6 col-lg-2">
            <h5>Kunjungan</h5>
            <ul>
              <li><a href="#">Selasa &ndash; Minggu: 09:00 &ndash; 20:00</a></li>
              <li><a href="tel:+6281234567890">(021) 555-0142</a></li>
              <li><a href="mailto:halo@amanails.com">halo@amanails.com</a></li>
            </ul>
          </div>
          <div class="col-lg-4">
            <h5>Amanails &middot; PROBIS</h5>
            <p style="max-width:34ch">Modul Admin: kelola appointment, approve pembayaran &amp; cuti nail artist, dan post
              katalog.</p>
          </div>
        </div>
        <div class="lq-footer-bottom">
          <p style="margin:0">&copy; {{ date('Y') }} Amanails Nail Bar. Seluruh hak cipta dilindungi.</p>
          <p style="margin:0"><a href="#main">Kembali ke atas &uarr;</a></p>
        </div>
      </div>
    </footer>

    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
      var cutiList = @json($cutiList);
      var activeCutiFilter = 'all';
      var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

      function escapeHtml(str) {
        return String(str ?? '').replace(/[&<>"']/g, function (c) {
          return ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[c];
        });
      }

      function updateCutiStatsAndBadge() {
        var total = cutiList.length;
        var menunggu = cutiList.filter(function (x) { return x.status === 'menunggu'; }).length;
        var disetujui = cutiList.filter(function (x) { return x.status === 'disetujui'; }).length;
        var ditolak = cutiList.filter(function (x) { return x.status === 'ditolak'; }).length;

        document.getElementById('statTotalCuti').textContent = total;
        document.getElementById('statMenungguCuti').textContent = menunggu;
        document.getElementById('statDisetujuiCuti').textContent = disetujui;
        document.getElementById('statDitolakCuti').textContent = ditolak;

        ['navCutiBadge', 'navCutiBadgeMobile'].forEach(function (id) {
          var badgeEl = document.getElementById(id);
          if (badgeEl) {
            badgeEl.textContent = menunggu;
            badgeEl.classList.toggle('is-zero', menunggu === 0);
          }
        });
      }

      function filterCuti(status) {
        activeCutiFilter = status || 'all';
        document.querySelectorAll('[data-cuti-card]').forEach(function (card) {
          card.classList.toggle('is-filter-active', card.getAttribute('data-cuti-card') === activeCutiFilter);
        });

        var labels = {
          all: '(Menampilkan semua)',
          menunggu: '(Filter: Menunggu Review)',
          disetujui: '(Filter: Cuti Disetujui)',
          ditolak: '(Filter: Permohonan Ditolak)'
        };
        document.getElementById('activeCutiFilterLabel').textContent = labels[activeCutiFilter] || '';
        renderCutiTable();
      }

      function renderCutiTable() {
        var tbody = document.getElementById('cutiBody');
        var tableWrap = document.getElementById('cutiTableWrap');
        var emptyState = document.getElementById('emptyCutiState');

        var filtered = cutiList.filter(function (item) {
          return activeCutiFilter === 'all' || item.status === activeCutiFilter;
        });

        if (filtered.length === 0) {
          tableWrap.style.display = 'none';
          emptyState.style.display = 'block';
          tbody.innerHTML = '';
          return;
        }

        tableWrap.style.display = '';
        emptyState.style.display = 'none';

        var html = '';
        filtered.forEach(function (item) {
          var badgeClass = 'adm-badge ' + (item.status === 'disetujui' ? 'disetujui' : (item.status === 'ditolak' ? 'ditolak' : 'menunggu'));
          var actionHtml = '';

          if (item.status === 'menunggu') {
            actionHtml = '<div class="d-flex align-items-center gap-1">' +
              '<button type="button" class="lq-btn lq-btn-primary lq-btn-table" onclick="openApproveCutiModal(' + item.id + ')">Setujui</button>' +
              '<button type="button" class="lq-btn lq-btn-table lq-btn-table-danger" onclick="openRejectCutiModal(' + item.id + ')">Tolak</button>' +
              '</div>';
          } else {
            actionHtml = '<button type="button" class="lq-btn lq-btn-outline lq-btn-table" onclick="showCutiDetail(' + item.id + ')">Detail</button>';
          }

          var noteCellHtml = item.admin_note
            ? '<span style="color: var(--lq-ink); font-size: 0.82rem;">' + escapeHtml(item.admin_note) + '</span>'
            : '<span style="color: var(--lq-mauve-soft);">-</span>';

          html += '<tr>' +
            '<td><strong>' + escapeHtml(item.artist_name) + '</strong></td>' +
            '<td>' + escapeHtml(item.leave_type) + '</td>' +
            '<td>' + escapeHtml(item.tanggal) + '</td>' +
            '<td>' + escapeHtml(item.durasi) + '</td>' +
            '<td style="color: var(--lq-mauve); font-size: 0.82rem; max-width: 240px;">' + escapeHtml(item.reason) + '</td>' +
            '<td style="max-width: 220px;">' + noteCellHtml + '</td>' +
            '<td><span class="' + badgeClass + '">' + escapeHtml(item.status_label) + '</span></td>' +
            '<td>' + actionHtml + '</td>' +
            '</tr>';
        });

        tbody.innerHTML = html;
      }

      function showToast(message, isReject) {
        var toast = document.getElementById('cutiToast');
        if (!toast) return;
        toast.style.display = 'block';
        toast.style.opacity = '1';
        toast.style.background = isReject ? '#fdf2f2' : '#eef6ee';
        toast.style.color = isReject ? '#a82323' : '#2e6930';
        toast.style.border = isReject ? '1px solid #f9d4d4' : '1px solid #d4ebd4';
        toast.textContent = message;
        setTimeout(function () {
          toast.style.opacity = '0';
          setTimeout(function () { toast.style.display = 'none'; }, 400);
        }, 3500);
      }

      var pendingApproveCutiId = null;
      var pendingRejectCutiId = null;

      function openApproveCutiModal(id) {
        var item = cutiList.find(function (x) { return Number(x.id) === Number(id); });
        if (!item) return;

        pendingApproveCutiId = id;
        document.getElementById('approveModalArtist').textContent = item.artist_name;
        document.getElementById('approveModalType').textContent = item.leave_type;
        document.getElementById('approveModalSchedule').textContent = item.tanggal + ' (' + item.durasi + ')';
        document.getElementById('approveModalReason').textContent = item.reason;
        document.getElementById('approveCutiNote').value = '';

        var modalEl = document.getElementById('modalSetujuiCuti');
        bootstrap.Modal.getOrCreateInstance(modalEl).show();
      }

      function setApproveCutiNote(text) {
        var el = document.getElementById('approveCutiNote');
        if (el) el.value = text;
      }

      async function confirmApproveCuti() {
        if (!pendingApproveCutiId) return;
        var note = (document.getElementById('approveCutiNote')?.value || '').trim();
        var btn = document.getElementById('btnConfirmApproveCuti');
        await decideCuti(pendingApproveCutiId, 'approve', btn, note);

        var modalEl = document.getElementById('modalSetujuiCuti');
        var modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();
      }

      function openRejectCutiModal(id) {
        var item = cutiList.find(function (x) { return Number(x.id) === Number(id); });
        if (!item) return;

        pendingRejectCutiId = id;
        document.getElementById('rejectModalArtist').textContent = item.artist_name;
        document.getElementById('rejectModalType').textContent = item.leave_type;
        document.getElementById('rejectModalSchedule').textContent = item.tanggal + ' (' + item.durasi + ')';
        document.getElementById('rejectCutiNote').value = '';

        var modalEl = document.getElementById('modalTolakCuti');
        bootstrap.Modal.getOrCreateInstance(modalEl).show();
      }

      function setRejectCutiReason(text) {
        var el = document.getElementById('rejectCutiNote');
        if (el) el.value = text;
      }

      async function confirmRejectCuti() {
        if (!pendingRejectCutiId) return;
        var note = (document.getElementById('rejectCutiNote')?.value || '').trim();
        var btn = document.getElementById('btnConfirmRejectCuti');
        await decideCuti(pendingRejectCutiId, 'reject', btn, note);

        var modalEl = document.getElementById('modalTolakCuti');
        var modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();
      }

      async function decideCuti(id, action, btnEl, adminNote) {
        if (btnEl) btnEl.disabled = true;
        var url = action === 'approve'
          ? '/admin/cuti/' + id + '/approve'
          : '/admin/cuti/' + id + '/reject';

        try {
          var res = await fetch(url, {
            method: 'PATCH',
            headers: {
              'Content-Type': 'application/json',
              'Accept': 'application/json',
              'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ admin_note: adminNote || '' })
          });

          var data = await res.json();
          if (!res.ok || !data.success) {
            throw new Error(data.message || 'Gagal memperbarui status cuti.');
          }

          var item = cutiList.find(function (x) { return Number(x.id) === Number(id); });
          if (item) {
            item.status = data.status;
            item.status_label = data.status === 'disetujui' ? 'Disetujui' : 'Ditolak';
            if (typeof data.admin_note !== 'undefined') item.admin_note = data.admin_note;
          }

          updateCutiStatsAndBadge();
          renderCutiTable();
          showToast(data.message, action === 'reject');
        } catch (err) {
          showToast(err.message || 'Terjadi kesalahan saat memproses pengajuan cuti.', true);
        } finally {
          if (btnEl) btnEl.disabled = false;
        }
      }

      function showCutiDetail(id) {
        var item = cutiList.find(function (x) { return Number(x.id) === Number(id); });
        if (!item) return;

        document.getElementById('detailCutiArtist').textContent = item.artist_name;
        document.getElementById('detailCutiType').textContent = item.leave_type;
        document.getElementById('detailCutiTanggal').textContent = item.tanggal;
        document.getElementById('detailCutiDurasi').textContent = item.durasi;
        document.getElementById('detailCutiAlasan').textContent = '“' + item.reason + '”';

        var badge = document.getElementById('detailCutiStatusBadge');
        badge.className = 'adm-badge ' + (item.status === 'disetujui' ? 'disetujui' : (item.status === 'ditolak' ? 'ditolak' : 'menunggu'));
        badge.textContent = item.status_label;

        var noteBox = document.getElementById('detailCutiAdminNoteBox');
        var noteText = document.getElementById('detailCutiAdminNote');
        if (item.admin_note) {
          noteBox.style.display = 'block';
          noteText.textContent = item.admin_note;
        } else {
          noteBox.style.display = 'none';
          noteText.textContent = '';
        }

        var modalEl = document.getElementById('modalDetailCuti');
        bootstrap.Modal.getOrCreateInstance(modalEl).show();
      }

      document.addEventListener('DOMContentLoaded', function () {
        updateCutiStatsAndBadge();
        renderCutiTable();
      });
    </script>
  </body>
</html>
