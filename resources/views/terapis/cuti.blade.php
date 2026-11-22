<!DOCTYPE html>
<html lang="id">
  <head>
    <script>document.documentElement.classList.add('js')</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pengajuan Cuti Terapis &mdash; Amanails Nail Bar</title>
    <meta name="description" content="Manajemen dan pengajuan cuti terapis Amanails Nail Bar.">

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
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
          <!-- Logo & Nav Breadcrumb -->
          <div class="d-flex align-items-center gap-3">
            <a class="lq-brand" href="{{ route('terapis.dashboard') }}" style="font-size: 1.45rem;">
              Amanails<span class="lq-dot">.</span>
              <small style="font-size: 0.65rem;">Nail Bar</small>
            </a>
            <span style="color: var(--lq-line-soft);">|</span>
            <span style="font-size: 0.84rem; font-weight: 500; color: var(--lq-mauve);">Pengajuan Cuti</span>
          </div>

          <!-- Tombol Aksi Topbar (Menu Burger) -->
          <div class="dropdown">
            <button class="lq-menu-burger" type="button" id="menuTerapisToggle" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Buka Menu Navigasi" title="Menu Navigasi">
              <span></span>
              <span></span>
              <span></span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end lq-portal-dropdown" aria-labelledby="menuTerapisToggle">
              <li>
                <a class="dropdown-item" href="{{ route('terapis.dashboard') }}">
                  Kembali ke Dashboard
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="{{ route('terapis.karya') }}">
                  Portofolio Saya
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

        <!-- Header Section -->
        <div class="mb-4">
          <span class="lq-eyebrow" style="font-size: 0.72rem; margin-bottom: 0.35rem; display: block;">Internal Terapis</span>
          <h1 style="font-family: var(--lq-serif); font-size: 2.2rem; color: var(--lq-ink); margin-bottom: 0.35rem;">
            Pengajuan &amp; Kuota Cuti
          </h1>
          <p style="color: var(--lq-mauve); margin-bottom: 0; font-size: 0.95rem;">
            Alokasi cuti aktif periode {{ date('F Y') }} untuk <strong>{{ $terapis['nama'] }}</strong> &middot; {{ $terapis['role'] }} ({{ $terapis['meja_kerja'] }}).
          </p>
        </div>

        <!-- 3 Baris Ringkasan Kuota Cuti -->
        <div class="row g-3 mb-4">
          <div class="col-md-4">
            <div class="lq-cuti-card text-center p-4">
              <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Jatah Kuota</span>
              <div style="font-family: var(--lq-serif); font-size: 2.8rem; color: var(--lq-rose-deep); line-height: 1; margin-bottom: 0.35rem;">
                {{ $dataCuti['kuota_bulanan'] }} <small style="font-size: 1.1rem; color: var(--lq-mauve);">Hari</small>
              </div>
              <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Kuota Bulanan Reguler</div>
              <small style="font-size: 0.8rem; color: var(--lq-mauve);">8 hari istirahat per bulan kalender</small>
            </div>
          </div>

          <div class="col-md-4">
            <div class="lq-cuti-card text-center p-4">
              <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Pemakaian</span>
              <div style="font-family: var(--lq-serif); font-size: 2.8rem; color: var(--lq-mauve); line-height: 1; margin-bottom: 0.35rem;">
                {{ $dataCuti['cuti_terpakai'] }} <small style="font-size: 1.1rem; color: var(--lq-mauve);">Hari</small>
              </div>
              <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Cuti Terpakai</div>
              <small style="font-size: 0.8rem; color: var(--lq-mauve);">Telah disetujui manajer salon</small>
            </div>
          </div>

          <div class="col-md-4">
            <div class="lq-cuti-card text-center p-4">
              <span class="lq-eyebrow" style="font-size: 0.7rem; margin-bottom: 0.35rem; display: block;">Sisa Tersedia</span>
              <div style="font-family: var(--lq-serif); font-size: 2.8rem; color: var(--lq-gold); line-height: 1; margin-bottom: 0.35rem;">
                {{ $dataCuti['sisa_cuti'] }} <small style="font-size: 1.1rem; color: var(--lq-mauve);">Hari</small>
              </div>
              <div style="font-size: 0.95rem; font-weight: 500; color: var(--lq-ink); margin-bottom: 0.2rem;">Sisa Kuota Cuti</div>
              <small style="font-size: 0.8rem; color: var(--lq-mauve);">Dapat diajukan untuk bulan berjalan</small>
            </div>
          </div>
        </div>

        <!-- Layout 2 Kolom: Riwayat (Kiri) & Form Pengajuan (Kanan) -->
        <div class="row g-4">
          <!-- Kolom Kiri: Riwayat Pengajuan -->
          <div class="col-lg-7">
            <div class="lq-cuti-card">
              <div class="d-flex justify-content-between align-items-baseline mb-3 pb-2" style="border-bottom: 1px solid var(--lq-line-soft);">
                <div>
                  <span class="lq-eyebrow" style="font-size: 0.68rem; margin-bottom: 0.15rem;">Daftar Riwayat</span>
                  <h3 style="font-family: var(--lq-serif); font-size: 1.45rem; margin: 0; color: var(--lq-ink);">
                    Riwayat Pengajuan Cuti
                  </h3>
                </div>
                <span class="lq-pkg-tag" style="position: static; font-size: 0.72rem; padding: 0.35rem 0.85rem; background: var(--lq-cream-2); color: var(--lq-mauve);">
                  {{ count($dataCuti['riwayat']) }} Pengajuan
                </span>
              </div>

              <div id="riwayatCutiList">
                @foreach($dataCuti['riwayat'] as $cuti)
                  <div class="p-3 rounded mb-3" style="background: var(--lq-cream-2); border: 1px solid var(--lq-line-soft); font-size: 0.86rem;">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                      <strong style="color: var(--lq-ink); font-family: var(--lq-serif); font-size: 1.05rem;">{{ $cuti['tipe'] }}</strong>
                      <span class="lq-pkg-tag" style="position: static; font-size: 0.62rem; padding: 0.25rem 0.65rem; background: #eef6ee; color: #27ae60;">
                        {{ $cuti['status'] }}
                      </span>
                    </div>
                    <div style="font-size: 0.82rem; color: var(--lq-mauve); margin-bottom: 0.35rem;">
                      Tanggal: <strong>{{ $cuti['tanggal'] }}</strong> &middot; Durasi: <strong>{{ $cuti['durasi'] }}</strong>
                    </div>
                    <div style="font-size: 0.84rem; color: var(--lq-ink); font-style: italic;">
                      &ldquo;{{ $cuti['alasan'] }}&rdquo;
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          </div>

          <!-- Kolom Kanan: Form Pengajuan Langsung -->
          <div class="col-lg-5">
            <div class="lq-cuti-card">
              <span class="lq-eyebrow" style="font-size: 0.68rem; margin-bottom: 0.2rem; display: block;">Formulir Pengajuan</span>
              <h3 style="font-family: var(--lq-serif); font-size: 1.45rem; margin-bottom: 0.35rem; color: var(--lq-ink);">
                Ajukan Cuti Baru
              </h3>
              <p style="font-size: 0.85rem; color: var(--lq-mauve); margin-bottom: 1.25rem;">
                Pilih jenis cuti dan tanggal untuk diteruskan ke manajer salon.
              </p>

              <form id="formCuti" onsubmit="event.preventDefault(); submitCuti();">
                <div class="lq-field mb-3">
                  <label for="jenisCuti">Jenis Cuti / Izin <span class="req">*</span></label>
                  <select class="lq-select" id="jenisCuti" required>
                    <option value="">Pilih jenis cuti...</option>
                    <option value="Cuti Bulanan">Cuti Bulanan Reguler</option>
                    <option value="Izin Sakit">Izin Sakit</option>
                    <option value="Keperluan Keluarga">Keperluan Keluarga / Mendesak</option>
                    <option value="Cuti Khusus">Cuti Khusus (Acara Keluarga / Penting)</option>
                  </select>
                </div>

                <div class="row g-2 mb-3">
                  <div class="col-6">
                    <div class="lq-field mb-0">
                      <label for="tglMulai">Tanggal Mulai <span class="req">*</span></label>
                      <input type="date" class="lq-input" id="tglMulai" required>
                    </div>
                  </div>
                  <div class="col-6">
                    <div class="lq-field mb-0">
                      <label for="tglSelesai">Tanggal Selesai <span class="req">*</span></label>
                      <input type="date" class="lq-input" id="tglSelesai" required>
                    </div>
                  </div>
                </div>

                <div class="lq-field mb-3">
                  <label for="alasanCuti">Alasan / Keterangan <span class="req">*</span></label>
                  <textarea class="lq-textarea" id="alasanCuti" placeholder="Jelaskan alasan pengajuan cuti secara singkat..." required style="min-height: 90px;"></textarea>
                </div>

                <div class="p-3 rounded mb-3" style="background: var(--lq-cream-2); font-size: 0.82rem; color: var(--lq-mauve); line-height: 1.45;">
                  <em>Catatan:</em> Kuota cuti terapis adalah <strong>8 hari sebulan</strong>. Mohon ajukan paling lambat 2 hari sebelumnya agar resepsionis dapat mengelola jadwal reservasi klien.
                </div>

                <button type="submit" class="lq-btn lq-btn-primary lq-btn-block">
                  Kirim Pengajuan Cuti
                </button>
              </form>
            </div>
          </div>
        </div>

      </div>
    </main>

    <!-- Footer -->
    <footer style="padding: 1.8rem 0; border-top: 1px solid var(--lq-line-soft); text-align: center; font-size: 0.82rem; color: var(--lq-mauve); background: var(--lq-cream);">
      &copy; {{ date('Y') }} Amanails Nail Bar &middot; Khusus Akses Internal Terapis
    </footer>

    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script>
      function submitCuti() {
        var jenis = document.getElementById('jenisCuti').value;
        var tglMulai = document.getElementById('tglMulai').value;
        var tglSelesai = document.getElementById('tglSelesai').value;
        var alasan = document.getElementById('alasanCuti').value;

        if (!jenis || !tglMulai || !tglSelesai || !alasan) {
          alert('Silakan lengkapi semua data formulir pengajuan cuti.');
          return;
        }

        var riwayatContainer = document.getElementById('riwayatCutiList');
        var itemBaru = document.createElement('div');
        itemBaru.className = 'p-3 rounded mb-3';
        itemBaru.style.cssText = 'background: var(--lq-cream-2); border: 1px solid var(--lq-line-soft); font-size: 0.86rem;';
        itemBaru.innerHTML = '<div class="d-flex justify-content-between align-items-center mb-1">' +
                             '<strong style="color: var(--lq-ink); font-family: var(--lq-serif); font-size: 1.05rem;">' + jenis + '</strong>' +
                             '<span class="lq-pkg-tag" style="position: static; font-size: 0.62rem; padding: 0.25rem 0.65rem; background: var(--lq-gold); color: var(--lq-plum-deep);">Menunggu Persetujuan</span>' +
                             '</div>' +
                             '<div style="font-size: 0.82rem; color: var(--lq-mauve); margin-bottom: 0.35rem;">' +
                             'Tanggal: <strong>' + tglMulai + ' s/d ' + tglSelesai + '</strong>' +
                             '</div>' +
                             '<div style="font-size: 0.84rem; color: var(--lq-ink); font-style: italic;">&ldquo;' + alasan + '&rdquo;</div>';
        
        riwayatContainer.insertBefore(itemBaru, riwayatContainer.firstChild);

        alert('Pengajuan cuti (' + jenis + ') berhasil dikirim ke manajer salon!');
        document.getElementById('formCuti').reset();
      }
    </script>
  </body>
</html>