<!DOCTYPE html>
<html lang="id">

<head>
  <script>document.documentElement.classList.add('js')</script>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Approve Pembayaran Buyer &mdash; Amanails Nail Bar</title>
  <meta name="description" content="Halaman verifikasi bukti transfer dan persetujuan pembayaran DP buyer Amanails Nail Bar.">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400;1,9..144,500&family=Jost:wght@300;400;500;600&display=swap"
    rel="stylesheet">

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
    .lq-eyebrow::after {
      display: none !important;
    }

    /* ─── table ─── */
    .adm-table-wrap {
      background: var(--lq-white);
      border: 1px solid var(--lq-line-soft);
      border-radius: var(--lq-radius-lg);
      overflow-x: auto;
    }

    .adm-table-wrap table {
      margin: 0;
    }

    .adm-table-wrap thead th {
      background: var(--lq-cream-2);
      font-size: 0.7rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--lq-mauve);
      border-bottom: 1px solid var(--lq-line-soft);
      padding: 0.75rem 1rem;
      font-weight: 600;
      white-space: nowrap;
      border-top: none;
    }

    .adm-table-wrap tbody td {
      padding: 0.85rem 1rem;
      font-size: 0.87rem;
      border-bottom: 1px solid var(--lq-line-soft);
      vertical-align: middle;
      color: var(--lq-ink);
    }

    .adm-table-wrap tbody tr {
      cursor: pointer;
      transition: background 0.18s ease;
    }

    .adm-table-wrap tbody tr:last-child td {
      border-bottom: none;
    }

    .adm-table-wrap tbody tr:hover td {
      background: var(--lq-cream);
    }

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

    .adm-badge.verified {
      background: #eef6ee;
      color: #27ae60;
      border: 1px solid rgba(39, 174, 96, 0.25);
    }

    .adm-badge.pending {
      background: #fdf6e7;
      color: #b07c10;
      border: 1px solid rgba(176, 124, 16, 0.25);
    }

    .adm-badge.rejected {
      background: #fdf0f0;
      color: #c62828;
      border: 1px solid rgba(198, 40, 40, 0.25);
    }

    .adm-proof-pill {
      display: inline-flex;
      align-items: center;
      gap: 0.35rem;
      padding: 0.25rem 0.65rem;
      border-radius: 999px;
      font-size: 0.72rem;
      font-weight: 500;
      white-space: nowrap;
    }

    .adm-proof-pill.has-file {
      background: var(--lq-blush-soft);
      color: var(--lq-rose-deep);
    }

    .adm-proof-pill.no-file {
      background: var(--lq-cream-2);
      color: var(--lq-mauve);
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
      gap: 0.85rem;
      margin-bottom: 1rem;
    }

    .adm-section-title {
      font-family: var(--lq-serif);
      font-size: 1.2rem;
      color: var(--lq-ink);
      margin: 0;
    }

    .adm-section-eyebrow {
      font-size: 0.7rem;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      color: var(--lq-mauve);
    }

    .adm-search-input {
      background: var(--lq-white);
      border: 1px solid var(--lq-line-soft);
      border-radius: 999px;
      padding: 0.48rem 1.1rem;
      font-size: 0.84rem;
      color: var(--lq-ink);
      min-width: 240px;
      outline: none;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    .adm-search-input:focus {
      border-color: var(--lq-rose);
      box-shadow: 0 0 0 3px rgba(183, 110, 121, 0.14);
    }

    /* ─── detail modal styling ─── */
    .adm-detail-box {
      background: var(--lq-cream);
      border: 1px solid var(--lq-line-soft);
      border-radius: var(--lq-radius);
      padding: 1.1rem 1.2rem;
    }

    .adm-detail-row {
      display: flex;
      justify-content: space-between;
      gap: 0.75rem;
      font-size: 0.85rem;
      padding: 0.32rem 0;
    }

    .adm-detail-row span:first-child {
      color: var(--lq-mauve);
    }

    .adm-detail-row strong {
      color: var(--lq-ink);
      text-align: right;
    }

    .adm-proof-frame {
      background: var(--lq-cream-2);
      border: 1px dashed var(--lq-line);
      border-radius: var(--lq-radius);
      min-height: 290px;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      overflow: hidden;
      position: relative;
      padding: 0.75rem;
    }

    .adm-proof-frame img {
      max-width: 100%;
      max-height: 360px;
      object-fit: contain;
      border-radius: calc(var(--lq-radius) - 4px);
    }

    .adm-reason-chip {
      background: var(--lq-cream-2);
      border: 1px solid var(--lq-line-soft);
      color: var(--lq-ink);
      font-size: 0.74rem;
      padding: 0.25rem 0.65rem;
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
          <li><a href="{{ route('admin.dashboard') }}">Appointment</a></li>
          <li><a href="{{ route('admin.pembayaran') }}" class="is-active">Pembayaran</a></li>
          <li><a href="{{ route('admin.cuti') }}">Approve Cuti <span class="adm-nav-badge {{ ($pendingCutiCount ?? 0) === 0 ? 'is-zero' : '' }}">{{ $pendingCutiCount ?? 0 }}</span></a></li>
          <li><a href="{{ route('admin.katalog') }}">Katalog</a></li>
        </ul>
      </nav>

      <div class="lq-nav-cta d-flex align-items-center gap-2">
        <span class="lq-nav-desktop me-2" style="font-size: 0.82rem; color: var(--lq-mauve);">Halo,
          <strong>{{ Auth::user()->name ?? 'Admin' }}</strong></span>
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
      <li><a href="{{ route('admin.dashboard') }}">Appointment</a></li>
      <li><a href="{{ route('admin.pembayaran') }}" class="is-active">Pembayaran</a></li>
      <li><a href="{{ route('admin.cuti') }}">Approve Cuti <span class="adm-nav-badge {{ ($pendingCutiCount ?? 0) === 0 ? 'is-zero' : '' }}">{{ $pendingCutiCount ?? 0 }}</span></a></li>
      <li><a href="{{ route('admin.katalog') }}">Katalog</a></li>
    </ul>
  </div>

  <!-- ===================== MAIN ===================== -->
  <main id="main" style="padding-top: 115px; padding-bottom: 4rem;">
    <div class="container">

      <!-- Toast Feedback Banner -->
      <div id="paymentToast" class="alert mb-4" role="status" style="display: none; border-radius: var(--lq-radius); font-size: 0.88rem;"></div>

      <!-- ─── STAT CARDS ─── -->
      <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
          <div class="lq-appt-card text-center mb-0 p-4 is-filter-active" data-filter-card="all" onclick="setPaymentFilter('all')" style="cursor: pointer;" title="Klik untuk tampilkan semua">
            <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Semua Transaksi</span>
            <div id="statTotalPay" style="font-family: var(--lq-serif); font-size: 2.8rem; color: var(--lq-rose-deep); line-height: 1; margin-bottom: 0.35rem;">
              {{ $stats['total'] }}
            </div>
            <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Total Pembayaran</div>
            <small style="font-size: 0.8rem; color: var(--lq-mauve);">Reservasi buyer masuk</small>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="lq-appt-card text-center mb-0 p-4" data-filter-card="pending" onclick="setPaymentFilter('pending')" style="cursor: pointer;" title="Klik untuk filter menunggu verifikasi">
            <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Perlu Dicek</span>
            <div id="statPendingPay" style="font-family: var(--lq-serif); font-size: 2.8rem; color: var(--lq-gold); line-height: 1; margin-bottom: 0.35rem;">
              {{ $stats['pending'] }}
            </div>
            <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Menunggu Verifikasi</div>
            <small style="font-size: 0.8rem; color: var(--lq-mauve);">Belum dicek admin</small>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="lq-appt-card text-center mb-0 p-4" data-filter-card="verified" onclick="setPaymentFilter('verified')" style="cursor: pointer;" title="Klik untuk filter sudah disetujui">
            <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Terverifikasi</span>
            <div id="statVerifiedPay" style="font-family: var(--lq-serif); font-size: 2.8rem; color: #27ae60; line-height: 1; margin-bottom: 0.35rem;">
              {{ $stats['verified'] }}
            </div>
            <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Pembayaran Valid</div>
            <small style="font-size: 0.8rem; color: var(--lq-mauve);">DP terkonfirmasi aman</small>
          </div>
        </div>
        <div class="col-6 col-md-3">
          <div class="lq-appt-card text-center mb-0 p-4" data-filter-card="rejected" onclick="setPaymentFilter('rejected')" style="cursor: pointer;" title="Klik untuk filter ditolak">
            <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Ditolak</span>
            <div id="statRejectedPay" style="font-family: var(--lq-serif); font-size: 2.8rem; color: #c62828; line-height: 1; margin-bottom: 0.35rem;">
              {{ $stats['rejected'] }}
            </div>
            <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Bukti Bermasalah</div>
            <small style="font-size: 0.8rem; color: var(--lq-mauve);">Bukti bodong / dibatalkan</small>
          </div>
        </div>
      </div>

      <!-- ─── TABEL APPROVE PEMBAYARAN ─── -->
      <div class="row g-4">
        <div class="col-12">

          <div class="adm-toolbar">
            <div>
              <div class="adm-section-eyebrow">Admin &middot; Verifikasi Transfer &amp; QRIS</div>
              <h3 class="adm-section-title">Approve Pembayaran Buyer <small id="activeFilterLabel" style="font-family: var(--lq-sans); font-size: 0.78rem; color: var(--lq-mauve); font-weight: 400;">(Menampilkan semua)</small></h3>
            </div>
            <div class="d-flex align-items-center gap-2 flex-wrap">
              <input type="search" id="searchPaymentInput" class="adm-search-input" placeholder="Cari kode booking / nama buyer..." oninput="renderPaymentTable()">
            </div>
          </div>

          <div class="adm-table-wrap">
            <table class="table table-borderless" id="paymentTableWrap">
              <thead>
                <tr>
                  <th>Kode &amp; Jadwal</th>
                  <th>Pelanggan</th>
                  <th>Layanan</th>
                  <th>Metode &amp; DP</th>
                  <th>Bukti Transfer</th>
                  <th>Status DP</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody id="pembayaranBody">
                <!-- Rendered via JS -->
              </tbody>
            </table>

            <div id="emptyPaymentState" style="display: none; padding: 3rem 1.5rem; text-align: center;">
              <h4 style="font-family: var(--lq-serif); color: var(--lq-ink); margin-bottom: 0.35rem;">Tidak Ada Data Pembayaran</h4>
              <p style="font-size: 0.88rem; color: var(--lq-mauve); margin-bottom: 0; max-width: 440px; margin-inline: auto;">
                Belum ada data transaksi yang sesuai dengan filter atau kata kunci pencarian Anda.
              </p>
            </div>
          </div>

        </div>
      </div>

    </div>
  </main>

  <!-- ===================== MODAL POP-UP DETAIL & BUKTI TRANSFER ===================== -->
  <div class="modal fade" id="modalDetailPembayaran" tabindex="-1" aria-labelledby="modalDetailPembayaranLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content" style="border: none; border-radius: var(--lq-radius-lg); overflow: hidden; box-shadow: 0 30px 80px -20px rgba(0,0,0,0.45); background: var(--lq-white);">

        <!-- Header Modal -->
        <div class="modal-header" style="background: var(--lq-cream); border-bottom: 1px solid var(--lq-line-soft); padding: 1.35rem 1.8rem;">
          <div>
            <span class="lq-eyebrow" style="font-size: 0.68rem; margin-bottom: 0.2rem; display: block;">Verifikasi Pembayaran &amp; Bukti Transfer</span>
            <div class="d-flex align-items-center gap-2 flex-wrap">
              <h4 class="modal-title" id="modalDetailPembayaranLabel" style="font-family: var(--lq-serif); font-size: 1.45rem; color: var(--lq-ink); margin: 0;">
                Detail Booking <span id="modalBookingCode">-</span>
              </h4>
              <span id="modalStatusBadge" class="adm-badge pending">Menunggu</span>
            </div>
          </div>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
        </div>

        <!-- Body Modal -->
        <div class="modal-body" style="padding: 1.75rem 1.8rem;">
          <div class="row g-4">

            <!-- KIRI: Detail Pelanggan, Jadwal & Tagihan -->
            <div class="col-lg-6">
              <!-- Info Pelanggan -->
              <div class="adm-detail-box mb-3">
                <div class="d-flex justify-content-between align-items-center mb-2">
                  <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--lq-mauve); font-weight: 600;">Data Buyer &amp; Jadwal</span>
                  <span id="modalClientType" style="font-size: 0.7rem; background: var(--lq-white); border: 1px solid var(--lq-line-soft); padding: 0.15rem 0.6rem; border-radius: 999px; color: var(--lq-ink);">-</span>
                </div>
                <div class="adm-detail-row">
                  <span>Nama Pelanggan</span>
                  <strong id="modalClientName">-</strong>
                </div>
                <div class="adm-detail-row">
                  <span>No. WhatsApp</span>
                  <strong><a id="modalClientPhoneLink" href="#" target="_blank" style="color: var(--lq-rose-deep); text-decoration: none;"><span id="modalClientPhone">-</span></a></strong>
                </div>
                <div class="adm-detail-row">
                  <span>Jadwal Kunjungan</span>
                  <strong id="modalSchedule">-</strong>
                </div>
                <div class="adm-detail-row">
                  <span>Nail Artist &amp; Meja</span>
                  <strong id="modalArtistStation">-</strong>
                </div>
                <div class="adm-detail-row">
                  <span>Status Reservasi</span>
                  <strong id="modalAppointmentStatus">-</strong>
                </div>
              </div>

              <!-- Rincian Layanan & Biaya -->
              <div class="adm-detail-box mb-3">
                <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--lq-mauve); font-weight: 600; display: block; margin-bottom: 0.5rem;">Rincian Layanan &amp; Pembayaran</span>
                <div id="modalServiceItems" class="mb-2 pb-2" style="border-bottom: 1px dashed var(--lq-line-soft);">
                  <!-- Items rendered via JS -->
                </div>
                <div class="adm-detail-row">
                  <span>Total Estimasi Layanan</span>
                  <strong id="modalFinalTotal">Rp 0</strong>
                </div>
                <div class="adm-detail-row">
                  <span>Metode Pembayaran DP</span>
                  <strong id="modalMethodLabel">-</strong>
                </div>
                <div class="adm-detail-row" style="font-size: 0.95rem; padding-top: 0.5rem; border-top: 1px solid var(--lq-line-soft); margin-top: 0.35rem;">
                  <span style="color: var(--lq-ink); font-weight: 600;">Nominal DP Harus Masuk</span>
                  <strong id="modalDpAmount" style="color: var(--lq-rose-deep); font-size: 1.05rem;">Rp 0</strong>
                </div>
                <div class="adm-detail-row">
                  <span>Sisa Pelunasan di Studio</span>
                  <strong id="modalSisaTagihan">Rp 0</strong>
                </div>
              </div>

              <!-- Catatan -->
              <div class="adm-detail-box">
                <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--lq-mauve); font-weight: 600; display: block; margin-bottom: 0.35rem;">Catatan Reservasi / Admin</span>
                <p id="modalNotes" style="font-size: 0.84rem; color: var(--lq-ink); margin: 0; white-space: pre-line;">-</p>
              </div>
            </div>

            <!-- KANAN: Bukti Transfer & Verifikasi Admin -->
            <div class="col-lg-6 d-flex flex-column">
              <div class="d-flex justify-content-between align-items-center mb-2">
                <span style="font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--lq-mauve); font-weight: 600;">Bukti Transfer yang Diunggah</span>
                <a id="modalFullProofLink" href="#" target="_blank" style="display: none; font-size: 0.76rem; color: var(--lq-rose-deep); font-weight: 600; text-decoration: none;">
                  Buka Ukuran Penuh &#8599;
                </a>
              </div>

              <!-- Preview Gambar Bukti -->
              <div class="adm-proof-frame mb-3">
                <img id="modalProofImg" src="" alt="Bukti Transfer Buyer" style="display: none;">
                <div id="modalNoProofState" style="text-align: center; padding: 1.5rem; max-width: 340px;">
                  <div style="font-size: 2rem; margin-bottom: 0.5rem; color: var(--lq-mauve);">&#128196;</div>
                  <div style="font-family: var(--lq-serif); font-size: 1.05rem; color: var(--lq-ink); margin-bottom: 0.25rem;">
                    Belum Ada File Bukti Transfer
                  </div>
                  <p style="font-size: 0.8rem; color: var(--lq-mauve); margin: 0;">
                    Buyer belum mengunggah gambar struk/mutasi, atau transaksi ini berasal dari pencatatan langsung/seeder.
                  </p>
                </div>
              </div>

              <!-- Checklist Pengecekan Anti-Bukti Bodong -->
              <div class="p-3 rounded mb-3" style="background: #fdf6e7; border: 1px solid rgba(176, 124, 16, 0.25); font-size: 0.8rem; color: #7a5508;">
                <strong>Tips Cek Keaslian:</strong> Cocokkan <em>nominal transfer</em> dengan jumlah DP di samping, pastikan <em>tanggal/jam transaksi</em> terbaru, dan cek apakah dana benar-benar sudah masuk ke mutasi rekening/QRIS Amanails.
              </div>

              <!-- Input Alasan Penolakan (Jika Bukti Bodong) -->
              <div class="lq-field mb-3">
                <label for="rejectReasonInput" style="font-size: 0.76rem;">Catatan / Alasan Penolakan (Opsional jika disetujui)</label>
                <input type="text" id="rejectReasonInput" class="lq-input" placeholder="Contoh: Dana belum masuk mutasi / bukti terindikasi editan...">
                <div class="d-flex flex-wrap gap-1 mt-2">
                  <button type="button" class="adm-reason-chip" onclick="fillRejectReason('Dana tidak ditemukan di mutasi rekening/QRIS')">Dana belum masuk mutasi</button>
                  <button type="button" class="adm-reason-chip" onclick="fillRejectReason('Bukti transfer tidak valid / terindikasi bodong')">Bukti tidak valid / bodong</button>
                  <button type="button" class="adm-reason-chip" onclick="fillRejectReason('Nominal transfer tidak sesuai tagihan DP')">Nominal tidak sesuai</button>
                </div>
              </div>

              <!-- Tombol Aksi Verifikasi -->
              <div class="d-flex flex-wrap gap-2 mt-auto pt-2" style="border-top: 1px solid var(--lq-line-soft);">
                <button type="button" id="btnApprovePayment" class="lq-btn lq-btn-primary flex-grow-1" onclick="submitPaymentDecision('approve')">
                  Setujui Pembayaran (Valid)
                </button>
                <button type="button" id="btnRejectPayment" class="lq-btn lq-btn-table-danger flex-grow-1" style="border-radius: 30px; padding: 0.78rem 1.4rem !important;" onclick="submitPaymentDecision('reject')">
                  Tolak / Bukti Bodong
                </button>
              </div>
            </div>

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
            <li><a href="{{ route('admin.dashboard') }}">Appointment</a></li>
            <li><a href="{{ route('admin.pembayaran') }}">Pembayaran</a></li>
            <li><a href="{{ route('admin.cuti') }}">Approve Cuti <span class="adm-nav-badge {{ ($pendingCutiCount ?? 0) === 0 ? 'is-zero' : '' }}">{{ $pendingCutiCount ?? 0 }}</span></a></li>
            <li><a href="{{ route('admin.katalog') }}">Katalog</a></li>
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
    var pembayaranData = @json($pembayaranList);
    var activeFilter = 'all';
    var selectedAppointmentId = null;
    var csrfToken = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';

    function formatRupiah(num) {
      return 'Rp ' + Number(num || 0).toLocaleString('id-ID');
    }

    function escapeHtml(str) {
      return String(str ?? '').replace(/[&<>"']/g, function (c) {
        return ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' })[c];
      });
    }

    function getStatusBadgeInfo(dpStatus) {
      if (dpStatus === 'verified') {
        return { cls: 'adm-badge verified', label: 'Terverifikasi' };
      }
      if (dpStatus === 'rejected') {
        return { cls: 'adm-badge rejected', label: 'Ditolak' };
      }
      return { cls: 'adm-badge pending', label: 'Menunggu' };
    }

    function updateStatsUI() {
      var total = pembayaranData.length;
      var pending = pembayaranData.filter(function (x) { return x.dp_status === 'pending'; }).length;
      var verified = pembayaranData.filter(function (x) { return x.dp_status === 'verified'; }).length;
      var rejected = pembayaranData.filter(function (x) { return x.dp_status === 'rejected'; }).length;

      document.getElementById('statTotalPay').textContent = total;
      document.getElementById('statPendingPay').textContent = pending;
      document.getElementById('statVerifiedPay').textContent = verified;
      document.getElementById('statRejectedPay').textContent = rejected;
    }

    function setPaymentFilter(filter) {
      activeFilter = filter;
      document.querySelectorAll('[data-filter-card]').forEach(function (card) {
        card.classList.toggle('is-filter-active', card.getAttribute('data-filter-card') === filter);
      });

      var labels = {
        all: '(Menampilkan semua)',
        pending: '(Filter: Menunggu Verifikasi)',
        verified: '(Filter: Pembayaran Valid)',
        rejected: '(Filter: Ditolak / Bermasalah)'
      };
      document.getElementById('activeFilterLabel').textContent = labels[filter] || '';
      renderPaymentTable();
    }

    function renderPaymentTable() {
      var tbody = document.getElementById('pembayaranBody');
      var tableWrap = document.getElementById('paymentTableWrap');
      var emptyState = document.getElementById('emptyPaymentState');
      var keyword = (document.getElementById('searchPaymentInput')?.value || '').trim().toLowerCase();

      var filtered = pembayaranData.filter(function (item) {
        if (activeFilter !== 'all' && item.dp_status !== activeFilter) {
          return false;
        }
        if (keyword !== '') {
          var haystack = (item.booking_code + ' ' + item.pelanggan + ' ' + item.telepon + ' ' + item.layanan + ' ' + item.dp_payment_method_label).toLowerCase();
          return haystack.indexOf(keyword) !== -1;
        }
        return true;
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
        var badge = getStatusBadgeInfo(item.dp_status);
        var proofHtml = item.has_proof
          ? '<span class="adm-proof-pill has-file">&#128247; Ada Bukti</span>'
          : '<span class="adm-proof-pill no-file">Tanpa File</span>';

        var btnClass = item.dp_status === 'pending' ? 'lq-btn lq-btn-primary lq-btn-table' : 'lq-btn lq-btn-outline lq-btn-table';
        var btnText = item.dp_status === 'pending' ? 'Periksa Bukti' : 'Detail & Cek';

        html += '<tr onclick="openPaymentModal(' + item.id + ')">' +
          '<td>' +
            '<div style="font-weight: 600; color: var(--lq-ink);">' + escapeHtml(item.booking_code) + '</div>' +
            '<small style="color: var(--lq-mauve); font-size: 0.78rem;">' + escapeHtml(item.tanggal) + ' &middot; ' + escapeHtml(item.jam) + '</small>' +
          '</td>' +
          '<td>' +
            '<div style="font-weight: 500;">' + escapeHtml(item.pelanggan) + '</div>' +
            '<small style="color: var(--lq-mauve); font-size: 0.78rem;">' + escapeHtml(item.telepon) + '</small>' +
          '</td>' +
          '<td style="max-width: 240px;">' + escapeHtml(item.layanan) + '</td>' +
          '<td>' +
            '<div style="font-weight: 600; color: var(--lq-rose-deep);">' + formatRupiah(item.dp_amount) + '</div>' +
            '<small style="color: var(--lq-mauve); font-size: 0.76rem;">' + escapeHtml(item.dp_payment_method_label) + ' &middot; Total ' + formatRupiah(item.final_total) + '</small>' +
          '</td>' +
          '<td>' + proofHtml + '</td>' +
          '<td><span class="' + badge.cls + '">' + badge.label + '</span></td>' +
          '<td>' +
            '<button type="button" class="' + btnClass + '" onclick="event.stopPropagation(); openPaymentModal(' + item.id + ')">' + btnText + '</button>' +
          '</td>' +
          '</tr>';
      });

      tbody.innerHTML = html;
    }

    function openPaymentModal(id) {
      var item = pembayaranData.find(function (x) { return x.id === id; });
      if (!item) return;

      selectedAppointmentId = id;
      var badge = getStatusBadgeInfo(item.dp_status);

      document.getElementById('modalBookingCode').textContent = item.booking_code;
      var modalBadge = document.getElementById('modalStatusBadge');
      modalBadge.className = badge.cls;
      modalBadge.textContent = badge.label;

      document.getElementById('modalClientType').textContent = item.tipe_klien;
      document.getElementById('modalClientName').textContent = item.pelanggan;
      document.getElementById('modalClientPhone').textContent = item.telepon;
      var cleanWa = String(item.telepon || '').replace(/[^0-9]/g, '');
      if (cleanWa.startsWith('0')) cleanWa = '62' + cleanWa.substring(1);
      document.getElementById('modalClientPhoneLink').href = cleanWa ? ('https://wa.me/' + cleanWa) : '#';

      document.getElementById('modalSchedule').textContent = item.tanggal + ' (' + item.jam + ')';
      document.getElementById('modalArtistStation').textContent = item.artist + ' · ' + item.station;
      document.getElementById('modalAppointmentStatus').textContent = item.status;

      // Rincian item layanan
      var itemsHtml = '';
      if (item.items && item.items.length > 0) {
        item.items.forEach(function (svc) {
          itemsHtml += '<div class="adm-detail-row" style="font-size: 0.82rem;">' +
            '<span>' + escapeHtml(svc.name) + (svc.is_addon ? ' <em>(Add-on)</em>' : '') + '</span>' +
            '<strong>' + formatRupiah(svc.price) + '</strong>' +
            '</div>';
        });
      } else {
        itemsHtml = '<div class="adm-detail-row"><span>' + escapeHtml(item.layanan) + '</span><strong>' + formatRupiah(item.final_total) + '</strong></div>';
      }
      document.getElementById('modalServiceItems').innerHTML = itemsHtml;

      document.getElementById('modalFinalTotal').textContent = formatRupiah(item.final_total);
      document.getElementById('modalMethodLabel').textContent = item.dp_payment_method_label;
      document.getElementById('modalDpAmount').textContent = formatRupiah(item.dp_amount);
      document.getElementById('modalSisaTagihan').textContent = formatRupiah(item.sisa_tagihan);
      document.getElementById('modalNotes').textContent = item.notes || 'Tidak ada catatan khusus.';
      document.getElementById('rejectReasonInput').value = '';

      // Preview bukti transfer
      var imgEl = document.getElementById('modalProofImg');
      var noProofEl = document.getElementById('modalNoProofState');
      var fullLinkEl = document.getElementById('modalFullProofLink');

      if (item.dp_proof_url) {
        imgEl.src = item.dp_proof_url;
        imgEl.style.display = 'block';
        noProofEl.style.display = 'none';
        fullLinkEl.href = item.dp_proof_url;
        fullLinkEl.style.display = 'inline-block';
      } else {
        imgEl.src = '';
        imgEl.style.display = 'none';
        noProofEl.style.display = 'block';
        fullLinkEl.style.display = 'none';
      }

      var modalEl = document.getElementById('modalDetailPembayaran');
      var modal = bootstrap.Modal.getOrCreateInstance(modalEl);
      modal.show();
    }

    function fillRejectReason(text) {
      var input = document.getElementById('rejectReasonInput');
      if (input) input.value = text;
    }

    function showToast(message, isError) {
      var toast = document.getElementById('paymentToast');
      if (!toast) return;
      toast.style.display = 'block';
      toast.style.background = isError ? '#fdf2f2' : '#eef6ee';
      toast.style.color = isError ? '#a82323' : '#2e6930';
      toast.style.border = isError ? '1px solid #f9d4d4' : '1px solid #d4ebd4';
      toast.textContent = message;
      setTimeout(function () {
        toast.style.display = 'none';
      }, 4500);
    }

    async function submitPaymentDecision(action) {
      if (!selectedAppointmentId) return;

      var btnApprove = document.getElementById('btnApprovePayment');
      var btnReject = document.getElementById('btnRejectPayment');
      var reason = (document.getElementById('rejectReasonInput')?.value || '').trim();

      var url = action === 'approve'
        ? '/admin/pembayaran/' + selectedAppointmentId + '/approve'
        : '/admin/pembayaran/' + selectedAppointmentId + '/reject';

      btnApprove.disabled = true;
      btnReject.disabled = true;

      try {
        var response = await fetch(url, {
          method: 'PATCH',
          headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json',
            'X-CSRF-TOKEN': csrfToken
          },
          body: JSON.stringify({ reason: reason })
        });

        var result = await response.json();
        if (!response.ok || !result.success) {
          throw new Error(result.message || 'Gagal memperbarui status pembayaran.');
        }

        // Update local state
        var item = pembayaranData.find(function (x) { return x.id === selectedAppointmentId; });
        if (item) {
          item.dp_status = result.dp_status;
          item.status = result.status;
          if (typeof result.notes !== 'undefined') {
            item.notes = result.notes;
          }
        }

        updateStatsUI();
        renderPaymentTable();

        var modalEl = document.getElementById('modalDetailPembayaran');
        var modal = bootstrap.Modal.getInstance(modalEl);
        if (modal) modal.hide();

        showToast(result.message, action === 'reject');
      } catch (err) {
        alert(err.message || 'Terjadi kesalahan saat menyimpan verifikasi.');
      } finally {
        btnApprove.disabled = false;
        btnReject.disabled = false;
      }
    }

    document.addEventListener('DOMContentLoaded', function () {
      updateStatsUI();
      renderPaymentTable();
    });
  </script>
</body>

</html>
