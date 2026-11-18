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
      .lq-pulse-dot {
        width: 8px;
        height: 8px;
        background: #27ae60;
        border-radius: 50%;
        display: inline-block;
        margin-right: 6px;
        box-shadow: 0 0 0 0 rgba(39, 174, 96, 0.7);
        animation: pulse 1.6s infinite;
      }
      @keyframes pulse {
        0% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(39, 174, 96, 0.7); }
        70% { transform: scale(1); box-shadow: 0 0 0 6px rgba(39, 174, 96, 0); }
        100% { transform: scale(0.95); box-shadow: 0 0 0 0 rgba(39, 174, 96, 0); }
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

          <!-- Status Ketersediaan Terapis -->
          <div class="d-flex align-items-center">
            <div class="d-flex align-items-center gap-2 px-3 py-1 rounded-pill" style="background: var(--lq-cream-2); border: 1px solid var(--lq-line-soft);">
              <span class="lq-pulse-dot" id="statusDot"></span>
              <span id="statusText" style="font-size: 0.82rem; font-weight: 500; color: var(--lq-ink); letter-spacing: 0.02em;">Status: {{ $terapis['status'] }}</span>
              <button type="button" class="btn btn-sm btn-link text-decoration-none p-0 ms-1" onclick="toggleStatus()" style="color: var(--lq-rose-deep); font-size: 0.78rem;">(Ubah)</button>
            </div>
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
              <div class="d-flex align-items-center gap-3 mb-2">
                <img src="{{ $terapis['foto'] }}" alt="{{ $terapis['nama'] }}" width="68" height="68" style="border-radius: 50%; object-fit: cover; border: 2px solid var(--lq-gold);">
                <div>
                  <span class="lq-pkg-tag" style="position: static; display: inline-block; margin-bottom: 0.35rem; font-size: 0.62rem;">
                    {{ $terapis['meja_kerja'] }}
                  </span>
                  <h2 style="color: #fff; font-size: 1.85rem; margin-bottom: 0.2rem; font-family: var(--lq-serif);">
                    Selamat Bekerja, {{ $terapis['nama'] }}!
                  </h2>
                  <p style="color: var(--lq-mauve-soft); margin-bottom: 0; font-size: 0.88rem;">
                    {{ $terapis['role'] }} &middot; Bergabung sejak {{ $terapis['bergabung_sejak'] }}
                  </p>
                </div>
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
          <!-- ================= KONTEN KIRI: DAFTAR JANJI TEMU HARI INI ================= -->
          <div class="col-lg-8">
            <div class="d-flex justify-content-between align-items-center mb-3">
              <div>
                <span class="lq-eyebrow" style="margin-bottom: 0.15rem;">Jadwal Perawatan</span>
                <h2 style="font-size: 1.5rem; margin-bottom: 0; font-family: var(--lq-serif);">Janji Temu Hari Ini ({{ count($jadwalHariIni) }})</h2>
              </div>
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
                <a href="{{ url('/') }}#gallery" target="_blank" style="font-size: 0.78rem; color: var(--lq-rose-deep); text-decoration: none;">Lihat Galeri &rarr;</a>
              </div>
              <p class="lq-pkg-sub" style="margin-bottom: 1.25rem;">Dokumentasi hasil karya manikur &amp; nail art terbaru</p>

              <div class="row g-2">
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
              <button type="button" class="lq-btn lq-btn-outline lq-btn-block lq-btn-sm mt-3" onclick="alert('Fitur upload foto portofolio baru akan aktif saat database dihubungkan!')">
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

    <!-- Footer Khusus Portal -->
    <footer style="padding: 1.8rem 0; border-top: 1px solid var(--lq-line-soft); text-align: center; font-size: 0.82rem; color: var(--lq-mauve); background: var(--lq-cream);">
      &copy; {{ date('Y') }} Amanails Nail Bar &middot; Khusus Akses Internal Terapis
    </footer>

    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script>
      // Simulasi Interaksi Tanpa Database (Mock Actions)
      function toggleStatus() {
        var statusDot = document.getElementById('statusDot');
        var statusText = document.getElementById('statusText');
        if (statusText.innerText.includes('Tersedia')) {
          statusText.innerText = 'Status: Sedang Istirahat';
          statusDot.style.background = '#e67e22';
          alert('Status Anda diubah menjadi "Sedang Istirahat". Reservasi baru akan diarahkan ke jam berikutnya.');
        } else {
          statusText.innerText = 'Status: Tersedia (Melayani)';
          statusDot.style.background = '#27ae60';
          alert('Status Anda kembali "Tersedia & Siap Melayani"!');
        }
      }

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

      function lihatDetail(klien, layanan) {
        if (!klien) {
          alert('Informasi riwayat perawatan klien ini tersimpan aman di sistem.');
          return;
        }
        alert('Klien: ' + klien + '\nLayanan: ' + layanan + '\nStatus: Terjadwal di Meja Amanails Nail Bar');
      }
    </script>
  </body>
</html>
