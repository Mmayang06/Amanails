<!DOCTYPE html>
<html lang="id">
  <head>
    <script>document.documentElement.classList.add('js')</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard Admin &mdash; Amanails Nail Bar</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400;1,9..144,500&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
      /* ─── reuse terapis header ─── */
      .lq-terapis-header {
        background: var(--lq-white);
        border-bottom: 1px solid var(--lq-line-soft);
        padding: 1.15rem 0;
        position: sticky;
        top: 0;
        z-index: 100;
      }

      /* ─── nav links in topbar ─── */
      .adm-nav-links {
        display: flex;
        list-style: none;
        margin: 0; padding: 0;
        gap: 0.25rem;
      }
      .adm-nav-links a {
        display: block;
        padding: 0.35rem 0.9rem;
        border-radius: var(--lq-radius);
        font-size: 0.84rem;
        font-weight: 500;
        color: var(--lq-ink);
        text-decoration: none;
        letter-spacing: 0.02em;
        transition: background 0.15s;
      }
      .adm-nav-links a:hover { background: var(--lq-cream-2); }
      .adm-nav-links a.is-active {
        background: var(--lq-blush-soft);
        color: var(--lq-rose-deep);
        font-weight: 600;
      }
      /* disabled nav items */
      .adm-nav-links a.is-disabled {
        color: var(--lq-mauve);
        pointer-events: none;
        opacity: 0.55;
        cursor: default;
      }

      /* ─── stat cards (terapis style) ─── */
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
      /* hide eyebrow decorations in dashboard context */
      .lq-eyebrow::before,
      .lq-eyebrow::after { display: none !important; }

      /* ─── table ─── */
      .adm-table-wrap {
        background: var(--lq-white);
        border: 1px solid var(--lq-line-soft);
        border-radius: var(--lq-radius-lg);
        overflow: hidden;
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

      /* ─── status badges (Amanails tag style) ─── */
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
      .adm-badge.lunas,
      .adm-badge.disetujui {
        background: #eef6ee;
        color: #27ae60;
        border: 1px solid rgba(39, 174, 96, 0.25);
      }
      .adm-badge.pending,
      .adm-badge.menunggu {
        background: #fdf6e7;
        color: #b07c10;
        border: 1px solid rgba(176, 124, 16, 0.25);
      }
      .adm-badge.batal,
      .adm-badge.ditolak {
        background: var(--lq-blush-soft);
        color: var(--lq-rose-deep);
        border: 1px solid rgba(183, 110, 121, 0.3);
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

      /* ─── tab nav ─── */
      .adm-tabs {
        display: flex; gap: 0;
        border-bottom: 1px solid var(--lq-line-soft);
        margin-bottom: 1.25rem;
      }
      .adm-tab {
        padding: 0.6rem 1.15rem;
        font-size: 0.83rem; font-weight: 500;
        color: var(--lq-mauve); cursor: pointer;
        border-bottom: 2px solid transparent;
        margin-bottom: -1px;
        background: none; border-top: none; border-left: none; border-right: none;
        transition: color 0.15s, border-color 0.15s;
        letter-spacing: 0.02em;
      }
      .adm-tab.is-active { color: var(--lq-rose-deep); border-bottom-color: var(--lq-rose-deep); font-weight: 600; }
      .adm-tab:hover:not(.is-active) { color: var(--lq-ink); }
      .adm-tab-panel { display: none; }
      .adm-tab-panel.is-active { display: block; }

      /* ─── toolbar row (above table) ─── */
      .adm-toolbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 1rem;
      }
      .adm-toolbar-left { display: flex; align-items: baseline; gap: 0.5rem; flex-wrap: wrap; }
      .adm-toolbar-right { display: flex; align-items: center; gap: 0.5rem; flex-wrap: wrap; }
      .adm-section-title { font-family: var(--lq-serif); font-size: 1rem; color: var(--lq-ink); margin: 0; }
      .adm-section-eyebrow { font-size: 0.7rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--lq-mauve); }

      /* ─── selected date note ─── */
      .adm-date-note { font-size: 0.8rem; color: var(--lq-mauve); margin-top: 0.5rem; }
      .adm-date-note strong { color: var(--lq-rose-deep); }

      /* ─── admin role pill ─── */
      .adm-role-pill {
        display: inline-block; padding: 0.12rem 0.55rem;
        border-radius: 999px; font-size: 0.68rem; font-weight: 600;
        background: var(--lq-blush-soft); color: var(--lq-rose-deep);
        letter-spacing: 0.06em; text-transform: uppercase;
      }
    </style>
  </head>
  <body style="background: var(--lq-cream); min-height: 100vh;">
    <a class="lq-skip" href="#main">Lewati ke konten utama</a>

    <!-- ===================== NAVBAR (katalog) ===================== -->
    <header class="lq-nav is-scrolled" data-nav>
      <div class="container">
        <a class="lq-brand" href="{{ url('/') }}" aria-label="Amanails Nail Bar — Beranda">
          Amanails<span class="lq-dot">.</span>
          <small>Nail Bar</small>
        </a>

        <nav class="lq-nav-desktop" aria-label="Navigasi Admin">
          <ul class="lq-nav-links">
            <li><a href="{{ url('/admin/dashboard') }}" class="is-active">Appointment</a></li>
            <li><a href="{{ url('/admin/katalog') }}">Katalog</a></li>
            <li><a href="#" style="pointer-events:none; opacity:0.45; cursor:default;">Laporan</a></li>
          </ul>
        </nav>

        <div class="lq-nav-cta d-flex align-items-center gap-2">
          @auth
            <span class="lq-nav-desktop me-2" style="font-size: 0.82rem; color: var(--lq-mauve);">Halo, <strong>{{ Auth::user()->name }}</strong></span>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="lq-btn lq-btn-outline lq-btn-sm lq-nav-desktop">Keluar</button>
            </form>
          @endauth
          <button class="lq-nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-controls="mobile-nav" aria-label="Buka menu navigasi">
            <span></span><span></span><span></span>
          </button>
        </div>
      </div>
    </header>

    <div class="lq-nav-mobile" id="mobile-nav" data-nav-mobile>
      <ul>
        <li><a href="{{ url('/admin/dashboard') }}" class="is-active">Appointment</a></li>
        <li><a href="{{ url('/admin/katalog') }}">Katalog</a></li>
        <li><span style="display:block; padding:0.5rem 0; color:var(--lq-mauve); opacity:0.5;">Laporan</span></li>
      </ul>
    </div>

    <!-- ===================== MAIN ===================== -->
    <main id="main" style="padding-top: 115px; padding-bottom: 4rem;">
      <div class="container">

        <!-- ─── STAT CARDS (terapis lq-appt-card style) ─── -->
        <div class="row g-3 mb-4">
          <div class="col-6 col-md-3">
            <div class="lq-appt-card text-center mb-0 p-4">
              <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Hari Ini</span>
              <div style="font-family: var(--lq-serif); font-size: 2.8rem; color: var(--lq-rose-deep); line-height: 1; margin-bottom: 0.35rem;">12</div>
              <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Appointment</div>
              <small style="font-size: 0.8rem; color: var(--lq-mauve);">Total jadwal hari ini</small>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="lq-appt-card text-center mb-0 p-4">
              <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Pembayaran</span>
              <div style="font-family: var(--lq-serif); font-size: 2.8rem; color: var(--lq-gold); line-height: 1; margin-bottom: 0.35rem;">3</div>
              <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Menunggu Konfirmasi</div>
              <small style="font-size: 0.8rem; color: var(--lq-mauve);">Bukti belum diverifikasi</small>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="lq-appt-card text-center mb-0 p-4">
              <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Cuti</span>
              <div style="font-family: var(--lq-serif); font-size: 2.8rem; color: var(--lq-plum); line-height: 1; margin-bottom: 0.35rem;">2</div>
              <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Perlu Disetujui</div>
              <small style="font-size: 0.8rem; color: var(--lq-mauve);">Pengajuan cuti nail artist</small>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="lq-appt-card text-center mb-0 p-4">
              <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Selesai</span>
              <div style="font-family: var(--lq-serif); font-size: 2.8rem; color: #27ae60; line-height: 1; margin-bottom: 0.35rem;">8</div>
              <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Lunas Hari Ini</div>
              <small style="font-size: 0.8rem; color: var(--lq-mauve);">Pembayaran sudah disetujui</small>
            </div>
          </div>
        </div>

        <!-- ─── 2-COL LAYOUT: CONTENT ─── -->
        <div class="row g-4">

          <!-- FULL WIDTH: Tabs -->
          <div class="col-12">

            <!-- TAB NAV -->
            <div class="adm-tabs" role="tablist">
              <button class="adm-tab is-active" data-tab="appointment" role="tab">Jadwal Appointment</button>
              <button class="adm-tab" data-tab="pembayaran" role="tab">Approve Pembayaran</button>
              <button class="adm-tab" data-tab="cuti" role="tab">Approve Cuti</button>
            </div>

            <!-- ── TAB 1: JADWAL APPOINTMENT ── -->
            <div class="adm-tab-panel is-active" id="tab-appointment">

              <!-- TOOLBAR: judul + tombol + search (di atas tabel, sesuai wireframe) -->
              <div class="adm-toolbar">
                <div class="adm-toolbar-left">
                  <div>
                    <div class="adm-section-eyebrow">Admin</div>
                    <h3 class="adm-section-title">Jadwal appointment hari ini</h3>
                  </div>
                </div>
                <div class="adm-toolbar-right">
                  <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" data-bs-toggle="modal" data-bs-target="#modalTambahJadwal">
                    + Tambah jadwal manual
                  </button>
                  <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" onclick="window.print()">
                    Ekspor jadwal ke PDF
                  </button>
                </div>
              </div>

              <div class="adm-table-wrap">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th>Jam</th>
                      <th>Pelanggan</th>
                      <th>Layanan</th>
                      <th>Nail Artist</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="appointmentBody">
                    <tr>
                      <td>09:00&ndash;10:00</td>
                      <td>Aurellia</td>
                      <td>Basic Gel Polish</td>
                      <td>Ami</td>
                      <td><span class="adm-badge lunas">Lunas</span></td>
                      <td><button type="button" class="lq-btn lq-btn-outline lq-btn-table" onclick="alert('Detail appointment')">Detail</button></td>
                    </tr>
                    <tr>
                      <td>09:00&ndash;10:00</td>
                      <td>Mayang</td>
                      <td>Nail Art Custom</td>
                      <td>Rara</td>
                      <td><span class="adm-badge pending">Pending</span></td>
                      <td>
                        <div class="d-flex align-items-center gap-1">
                          <button type="button" class="lq-btn lq-btn-primary lq-btn-table" onclick="approveRow(this,'Lunas')">Accept</button>
                          <button type="button" class="lq-btn lq-btn-table lq-btn-table-danger" onclick="rejectRow(this)">Tolak</button>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>10:00&ndash;11:00</td>
                      <td>Sela</td>
                      <td>Soft Gel Extensions</td>
                      <td>Ami</td>
                      <td><span class="adm-badge lunas">Lunas</span></td>
                      <td><button type="button" class="lq-btn lq-btn-outline lq-btn-table" onclick="alert('Detail appointment')">Detail</button></td>
                    </tr>
                    <tr>
                      <td>11:00&ndash;12:00</td>
                      <td>Dina</td>
                      <td>Manikur Classic</td>
                      <td>Lena</td>
                      <td><span class="adm-badge lunas">Lunas</span></td>
                      <td><button type="button" class="lq-btn lq-btn-outline lq-btn-table" onclick="alert('Detail appointment')">Detail</button></td>
                    </tr>
                    <tr>
                      <td>13:00&ndash;14:00</td>
                      <td>Rina</td>
                      <td>Pedikur + Gel Polish</td>
                      <td>Rara</td>
                      <td><span class="adm-badge pending">Pending</span></td>
                      <td>
                        <div class="d-flex align-items-center gap-1">
                          <button type="button" class="lq-btn lq-btn-primary lq-btn-table" onclick="approveRow(this,'Lunas')">Accept</button>
                          <button type="button" class="lq-btn lq-btn-table lq-btn-table-danger" onclick="rejectRow(this)">Tolak</button>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>14:00&ndash;15:00</td>
                      <td>Cindy</td>
                      <td>BIAB Overlay</td>
                      <td>Ami</td>
                      <td><span class="adm-badge lunas">Lunas</span></td>
                      <td><button type="button" class="lq-btn lq-btn-outline lq-btn-table" onclick="alert('Detail appointment')">Detail</button></td>
                    </tr>
                    <tr>
                      <td>15:00&ndash;16:00</td>
                      <td>Tari</td>
                      <td>Acrylic Set</td>
                      <td>Lena</td>
                      <td><span class="adm-badge lunas">Lunas</span></td>
                      <td><button type="button" class="lq-btn lq-btn-outline lq-btn-table" onclick="alert('Detail appointment')">Detail</button></td>
                    </tr>
                    <tr>
                      <td>16:00&ndash;17:00</td>
                      <td>Bella</td>
                      <td>Basic Gel Polish</td>
                      <td>Rara</td>
                      <td><span class="adm-badge batal">Batal</span></td>
                      <td><button type="button" class="lq-btn lq-btn-outline lq-btn-table" onclick="alert('Detail appointment')">Detail</button></td>
                    </tr>
                    <tr>
                      <td>17:00&ndash;18:00</td>
                      <td>Nadia</td>
                      <td>Nail Art Custom</td>
                      <td>Ami</td>
                      <td><span class="adm-badge lunas">Lunas</span></td>
                      <td><button type="button" class="lq-btn lq-btn-outline lq-btn-table" onclick="alert('Detail appointment')">Detail</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- ── TAB 2: APPROVE PEMBAYARAN ── -->
            <div class="adm-tab-panel" id="tab-pembayaran">
              <div class="adm-toolbar">
                <div>
                  <div class="adm-section-eyebrow">Admin</div>
                  <h3 class="adm-section-title">Approve Pembayaran</h3>
                </div>
              </div>

              <div class="adm-table-wrap">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th>Tanggal</th>
                      <th>Pelanggan</th>
                      <th>Layanan</th>
                      <th>Total</th>
                      <th>Bukti</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="pembayaranBody">
                    <tr>
                      <td>20 Nov 2026</td>
                      <td>Mayang</td>
                      <td>Nail Art Custom</td>
                      <td>Rp&nbsp;220.000</td>
                      <td><button type="button" class="lq-btn lq-btn-outline lq-btn-table" onclick="alert('Simulasi: Lihat bukti transfer')">Lihat Bukti</button></td>
                      <td><span class="adm-badge menunggu">Menunggu</span></td>
                      <td>
                        <div class="d-flex align-items-center gap-1">
                          <button type="button" class="lq-btn lq-btn-primary lq-btn-table" onclick="approveRow(this,'Lunas')">Setujui</button>
                          <button type="button" class="lq-btn lq-btn-table lq-btn-table-danger" onclick="rejectRow(this)">Tolak</button>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>20 Nov 2026</td>
                      <td>Rina</td>
                      <td>Pedikur + Gel Polish</td>
                      <td>Rp&nbsp;185.000</td>
                      <td><button type="button" class="lq-btn lq-btn-outline lq-btn-table" onclick="alert('Simulasi: Lihat bukti transfer')">Lihat Bukti</button></td>
                      <td><span class="adm-badge menunggu">Menunggu</span></td>
                      <td>
                        <div class="d-flex align-items-center gap-1">
                          <button type="button" class="lq-btn lq-btn-primary lq-btn-table" onclick="approveRow(this,'Lunas')">Setujui</button>
                          <button type="button" class="lq-btn lq-btn-table lq-btn-table-danger" onclick="rejectRow(this)">Tolak</button>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td>19 Nov 2026</td>
                      <td>Aurellia</td>
                      <td>Basic Gel Polish</td>
                      <td>Rp&nbsp;150.000</td>
                      <td><button type="button" class="lq-btn lq-btn-outline lq-btn-table" onclick="alert('Simulasi: Lihat bukti transfer')">Lihat Bukti</button></td>
                      <td><span class="adm-badge disetujui">Lunas</span></td>
                      <td><button type="button" class="lq-btn lq-btn-outline lq-btn-table" onclick="alert('Sudah disetujui')">Detail</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

            <!-- ── TAB 3: APPROVE CUTI ── -->
            <div class="adm-tab-panel" id="tab-cuti">
              <div class="adm-toolbar">
                <div>
                  <div class="adm-section-eyebrow">Admin</div>
                  <h3 class="adm-section-title">Approve Cuti Nail Artist</h3>
                </div>
              </div>

              <div class="adm-table-wrap">
                <table class="table table-borderless">
                  <thead>
                    <tr>
                      <th>Nail Artist</th>
                      <th>Tanggal Cuti</th>
                      <th>Lama</th>
                      <th>Alasan</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody id="cutiBody">
                    <tr>
                      <td><strong>Ami</strong></td>
                      <td>25&ndash;27 Nov 2026</td>
                      <td>3 hari</td>
                      <td style="color: var(--lq-mauve); font-size: 0.82rem;">Keperluan keluarga</td>
                      <td><span class="adm-badge menunggu">Menunggu</span></td>
                      <td>
                        <div class="d-flex align-items-center gap-1">
                          <button type="button" class="lq-btn lq-btn-primary lq-btn-table" onclick="approveRow(this,'Disetujui')">Setujui</button>
                          <button type="button" class="lq-btn lq-btn-table lq-btn-table-danger" onclick="rejectRow(this)">Tolak</button>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td><strong>Rara</strong></td>
                      <td>30 Nov 2026</td>
                      <td>1 hari</td>
                      <td style="color: var(--lq-mauve); font-size: 0.82rem;">Sakit</td>
                      <td><span class="adm-badge menunggu">Menunggu</span></td>
                      <td>
                        <div class="d-flex align-items-center gap-1">
                          <button type="button" class="lq-btn lq-btn-primary lq-btn-table" onclick="approveRow(this,'Disetujui')">Setujui</button>
                          <button type="button" class="lq-btn lq-btn-table lq-btn-table-danger" onclick="rejectRow(this)">Tolak</button>
                        </div>
                      </td>
                    </tr>
                    <tr>
                      <td><strong>Lena</strong></td>
                      <td>15 Nov 2026</td>
                      <td>1 hari</td>
                      <td style="color: var(--lq-mauve); font-size: 0.82rem;">Acara pernikahan</td>
                      <td><span class="adm-badge disetujui">Disetujui</span></td>
                      <td><button type="button" class="lq-btn lq-btn-outline lq-btn-table" onclick="alert('Sudah disetujui')">Detail</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

          </div><!-- /col-lg-8 -->
        </div><!-- /row -->

      </div>
    </main>

    <!-- ===================== MODAL: TAMBAH JADWAL MANUAL ===================== -->
    <div class="modal fade" id="modalTambahJadwal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: var(--lq-radius-lg); overflow: hidden; border: 1px solid var(--lq-line-soft);">
          <div class="modal-header" style="background: var(--lq-plum); color: #fff;">
            <h5 class="modal-title" style="font-family: var(--lq-serif); color: #fff; font-size: 1.1rem;">Tambah Jadwal Manual</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body p-4" style="background: var(--lq-cream);">
            <div class="lq-field">
              <label>Nama Pelanggan <span class="req">*</span></label>
              <input type="text" class="lq-input" placeholder="Nama lengkap pelanggan">
            </div>
            <div class="lq-field">
              <label>Layanan <span class="req">*</span></label>
              <select class="lq-input">
                <option value="">Pilih layanan...</option>
                <option>Basic Gel Polish</option>
                <option>Nail Art Custom</option>
                <option>Soft Gel Extensions</option>
                <option>Manikur Classic</option>
                <option>Pedikur + Gel Polish</option>
                <option>BIAB Overlay</option>
                <option>Acrylic Set</option>
              </select>
            </div>
            <div class="row g-3">
              <div class="col-6">
                <div class="lq-field mb-0">
                  <label>Tanggal <span class="req">*</span></label>
                  <input type="date" class="lq-input">
                </div>
              </div>
              <div class="col-6">
                <div class="lq-field mb-0">
                  <label>Jam <span class="req">*</span></label>
                  <select class="lq-input">
                    <option>09:00&ndash;10:00</option>
                    <option>10:00&ndash;11:00</option>
                    <option>11:00&ndash;12:00</option>
                    <option>13:00&ndash;14:00</option>
                    <option>14:00&ndash;15:00</option>
                    <option>15:00&ndash;16:00</option>
                    <option>16:00&ndash;17:00</option>
                    <option>17:00&ndash;18:00</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="lq-field mt-3">
              <label>Nail Artist <span class="req">*</span></label>
              <select class="lq-input">
                <option value="">Pilih nail artist...</option>
                <option>Ami</option>
                <option>Rara</option>
                <option>Lena</option>
              </select>
            </div>
          </div>
          <div class="modal-footer" style="background: var(--lq-cream-2);">
            <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" data-bs-dismiss="modal">Batal</button>
            <button type="button" class="lq-btn lq-btn-primary lq-btn-sm"
              onclick="alert('Jadwal berhasil ditambahkan! (Simulasi)'); document.querySelector('#modalTambahJadwal .btn-close').click();">
              Simpan Jadwal
            </button>
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
            <p style="margin-top:1.25rem;max-width:32ch">Boutique nail bar estetik dengan perawatan manikur ahli, kutek gel tahan lama, dan nail art lukis tangan di studio yang tenang dan higienis.</p>
          </div>
          <div class="col-6 col-lg-2">
            <h5>Admin</h5>
            <ul>
              <li><a href="{{ url('/admin/dashboard') }}">Appointment</a></li>
              <li><span style="color: var(--lq-mauve);">Katalog</span></li>
              <li><span style="color: var(--lq-mauve);">Laporan</span></li>
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
            <p style="max-width:34ch">Modul Admin: kelola appointment, approve pembayaran &amp; cuti nail artist, dan post katalog.</p>
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
    document.addEventListener('DOMContentLoaded', function () {
      /* ══ TABS ══ */
      document.querySelectorAll('.adm-tab').forEach(tab => {
        tab.addEventListener('click', function () {
          document.querySelectorAll('.adm-tab').forEach(t => t.classList.remove('is-active'));
          document.querySelectorAll('.adm-tab-panel').forEach(p => p.classList.remove('is-active'));
          this.classList.add('is-active');
          document.getElementById('tab-' + this.dataset.tab).classList.add('is-active');
        });
      });
    });

    /* ══ ACTION HELPERS ══ */
    function approveRow(btn, labelText) {
      const row   = btn.closest('tr');
      const badge = row.querySelector('.adm-badge');
      badge.className = 'adm-badge disetujui';
      badge.textContent = labelText;
      btn.closest('td').innerHTML = '<button type="button" class="lq-btn lq-btn-outline lq-btn-table" onclick="alert(\'Sudah disetujui\')">Detail</button>';
    }
    function rejectRow(btn) {
      const row   = btn.closest('tr');
      const badge = row.querySelector('.adm-badge');
      badge.className = 'adm-badge ditolak';
      badge.textContent = 'Ditolak';
      btn.closest('td').innerHTML = '<button type="button" class="lq-btn lq-btn-outline lq-btn-table" onclick="alert(\'Sudah ditolak\')">Detail</button>';
    }
    </script>
  </body>
</html>
