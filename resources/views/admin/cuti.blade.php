<!DOCTYPE html>
<html lang="id">
  <head>
    <script>document.documentElement.classList.add('js')</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Approve Cuti Nail Artist &mdash; Amanails Nail Bar</title>
    <meta name="description" content="Halaman persetujuan cuti nail artist Amanails Nail Bar.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400;1,9..144,500&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
      @media (min-width: 992px) {
        .lq-nav .container {
          position: relative;
        }
        .lq-nav-desktop {
          position: absolute;
          left: 50%;
          top: 50%;
          transform: translate(-50%, -50%);
        }
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
    </style>
  </head>
  <body style="background: var(--lq-cream); min-height: 100vh;">
    <a class="lq-skip" href="#main">Lewati ke konten utama</a>

    <!-- ===================== NAVBAR (Admin) ===================== -->
    <header class="lq-nav is-scrolled" data-nav>
      <div class="container">
        <a class="lq-brand" href="{{ url('/') }}" aria-label="Amanails Nail Bar — Beranda">
          Amanails<span class="lq-dot">.</span>
          <small>Nail Bar</small>
        </a>

        <nav class="lq-nav-desktop" aria-label="Navigasi Admin">
          <ul class="lq-nav-links">
            <li><a href="{{ url('/admin/dashboard') }}">Appointment</a></li>
            <li><a href="{{ url('/admin/cuti') }}" class="is-active">Approve Cuti</a></li>
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
        <li><a href="{{ url('/admin/dashboard') }}">Appointment</a></li>
        <li><a href="{{ url('/admin/cuti') }}" class="is-active">Approve Cuti</a></li>
        <li><a href="{{ url('/admin/katalog') }}">Katalog</a></li>
        <li><span style="display:block; padding:0.5rem 0; color:var(--lq-mauve); opacity:0.5;">Laporan</span></li>
      </ul>
    </div>

    <!-- ===================== MAIN ===================== -->
    <main id="main" style="padding-top: 115px; padding-bottom: 4rem;">
      <div class="container">

        <!-- ─── STAT CARDS ─── -->
        <div class="row g-3 mb-4">
          <div class="col-6 col-md-3">
            <div class="lq-appt-card text-center mb-0 p-4" onclick="filterCuti('all')" style="cursor: pointer;" title="Klik untuk tampilkan semua">
              <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Semua Pengajuan</span>
              <div style="font-family: var(--lq-serif); font-size: 2.8rem; color: var(--lq-rose-deep); line-height: 1; margin-bottom: 0.35rem;">3</div>
              <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Total Permohonan</div>
              <small style="font-size: 0.8rem; color: var(--lq-mauve);">Pengajuan cuti nail artist</small>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="lq-appt-card text-center mb-0 p-4" onclick="filterCuti('menunggu')" style="cursor: pointer;" title="Klik untuk filter menunggu persetujuan">
              <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Perlu Ditinjau</span>
              <div style="font-family: var(--lq-serif); font-size: 2.8rem; color: var(--lq-gold); line-height: 1; margin-bottom: 0.35rem;">2</div>
              <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Menunggu Review</div>
              <small style="font-size: 0.8rem; color: var(--lq-mauve);">Belum dikonfirmasi admin</small>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="lq-appt-card text-center mb-0 p-4" onclick="filterCuti('disetujui')" style="cursor: pointer;" title="Klik untuk filter disetujui">
              <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Disetujui</span>
              <div style="font-family: var(--lq-serif); font-size: 2.8rem; color: #27ae60; line-height: 1; margin-bottom: 0.35rem;">1</div>
              <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Cuti Disetujui</div>
              <small style="font-size: 0.8rem; color: var(--lq-mauve);">Izin cuti telah terbit</small>
            </div>
          </div>
          <div class="col-6 col-md-3">
            <div class="lq-appt-card text-center mb-0 p-4" onclick="filterCuti('ditolak')" style="cursor: pointer;" title="Klik untuk filter ditolak">
              <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Ditolak</span>
              <div style="font-family: var(--lq-serif); font-size: 2.8rem; color: #c62828; line-height: 1; margin-bottom: 0.35rem;">0</div>
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
                        <button type="button" class="lq-btn lq-btn-primary lq-btn-table"
                          onclick="approveRow(this,'Disetujui')">Setujui</button>
                        <button type="button" class="lq-btn lq-btn-table lq-btn-table-danger"
                          onclick="rejectRow(this)">Tolak</button>
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
                        <button type="button" class="lq-btn lq-btn-primary lq-btn-table"
                          onclick="approveRow(this,'Disetujui')">Setujui</button>
                        <button type="button" class="lq-btn lq-btn-table lq-btn-table-danger"
                          onclick="rejectRow(this)">Tolak</button>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td><strong>Lena</strong></td>
                    <td>15 Nov 2026</td>
                    <td>1 hari</td>
                    <td style="color: var(--lq-mauve); font-size: 0.82rem;">Acara pernikahan</td>
                    <td><span class="adm-badge disetujui">Disetujui</span></td>
                    <td><button type="button" class="lq-btn lq-btn-outline lq-btn-table"
                        onclick="alert('Sudah disetujui')">Detail</button></td>
                  </tr>
                </tbody>
              </table>
            </div>

          </div>
        </div>

      </div>
    </main>

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
              <li><a href="{{ url('/admin/cuti') }}">Approve Cuti</a></li>
              <li><a href="{{ url('/admin/katalog') }}">Katalog</a></li>
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
      function filterCuti(status) {
        const rows = document.querySelectorAll('#cutiBody tr');
        rows.forEach(row => {
          if (!status || status === 'all') {
            row.style.display = '';
          } else {
            const badge = row.querySelector('.adm-badge');
            if (badge && badge.textContent.toLowerCase().includes(status.toLowerCase())) {
              row.style.display = '';
            } else {
              row.style.display = 'none';
            }
          }
        });
      }

      function approveRow(btn, labelText) {
        const row = btn.closest('tr');
        const badge = row.querySelector('.adm-badge');
        badge.className = 'adm-badge disetujui';
        badge.textContent = labelText;
        btn.closest('td').innerHTML = '<button type="button" class="lq-btn lq-btn-outline lq-btn-table" onclick="alert(\'Sudah disetujui\')">Detail</button>';
      }
      function rejectRow(btn) {
        const row = btn.closest('tr');
        const badge = row.querySelector('.adm-badge');
        badge.className = 'adm-badge ditolak';
        badge.textContent = 'Ditolak';
        btn.closest('td').innerHTML = '<button type="button" class="lq-btn lq-btn-outline lq-btn-table" onclick="alert(\'Sudah ditolak\')">Detail</button>';
      }
    </script>
  </body>
</html>
