<!DOCTYPE html>
<html lang="id">
  <head>
    <script>document.documentElement.classList.add('js')</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jadwal Ketersediaan &mdash; Amanails Nail Bar</title>
    <meta name="description" content="Periksa jadwal ketersediaan waktu kunjungan dan reservasi kursi di Amanails Nail Bar.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400;1,9..144,500&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
      /* Date selection pills */
      .lq-date-pill {
        border: 1px solid var(--lq-line);
        background: var(--lq-white);
        border-radius: var(--lq-radius);
        padding: 0.75rem 1.1rem;
        text-align: center;
        cursor: pointer;
        transition: all 0.2s var(--lq-ease);
        min-width: 95px;
      }
      .lq-date-pill:hover { border-color: var(--lq-rose); }
      .lq-date-pill.is-selected {
        background: var(--lq-rose-deep);
        border-color: var(--lq-rose-deep);
        color: #fff;
      }
      .lq-date-pill.is-selected small { color: rgba(255,255,255,0.85); }

      /* Slot waktu penuh */
      .lq-slot.is-booked {
        opacity: 0.45;
        background: #e6dedc;
        border-color: #d8cecc;
        cursor: not-allowed;
        text-decoration: line-through;
      }

      /* Kartu Artist yang Ditugaskan Sistem (Read-Only) */
      .lq-assigned-artist-box {
        border: 1.5px solid var(--lq-line);
        border-radius: var(--lq-radius-lg);
        background: var(--lq-white);
        padding: 1.25rem 1.5rem;
        transition: all 0.3s var(--lq-ease);
      }
    </style>
  </head>
  <body>
    <a class="lq-skip" href="#main">Lewati ke konten utama</a>

    <!-- ===================== NAVBAR ===================== -->
    <header class="lq-nav is-scrolled" data-nav>
      <div class="container">
        <a class="lq-brand" href="{{ url('/') }}" aria-label="Amanails Nail Bar — Beranda">
          Amanails<span class="lq-dot">.</span>
          <small>Nail Bar</small>
        </a>

        <nav class="lq-nav-desktop" aria-label="Navigasi Utama">
          <ul class="lq-nav-links">
            <li><a href="{{ url('/katalog') }}">Katalog</a></li>
            <li><a href="{{ url('/jadwal') }}" class="is-active">Booking</a></li>
            <li><a href="{{ url('/services') }}">Menu Lengkap</a></li>
            <li><a href="{{ url('/bantuan') }}">Bantuan</a></li>
          </ul>
        </nav>

        <div class="lq-nav-cta d-flex align-items-center gap-2">
          @auth
            <span class="lq-nav-desktop me-2" style="font-size: 0.82rem; color: var(--lq-mauve);">Halo, <strong>{{ Auth::user()->name }}</strong></span>
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="lq-btn lq-btn-outline lq-btn-sm lq-nav-desktop">Keluar</button>
            </form>
          @else
            <a class="lq-btn lq-btn-outline lq-btn-sm lq-nav-desktop" href="{{ route('login') }}">Masuk</a>
          @endauth
          <a class="lq-btn lq-btn-outline lq-btn-sm lq-nav-desktop" href="{{ url('/katalog') }}">&larr; Ubah Layanan</a>
          <button class="lq-nav-toggle" type="button" data-nav-toggle aria-expanded="false" aria-controls="mobile-nav" aria-label="Buka menu navigasi">
            <span></span><span></span><span></span>
          </button>
        </div>
      </div>
    </header>

    <!-- Drawer Menu Mobile -->
    <div class="lq-nav-mobile" id="mobile-nav" data-nav-mobile>
      <ul>
        <li><a href="{{ url('/katalog') }}">Katalog Layanan</a></li>
        <li><a href="{{ url('/jadwal') }}" class="is-active">Booking &amp; Jadwal</a></li>
        <li><a href="{{ url('/services') }}">Menu Lengkap</a></li>
        <li><a href="{{ url('/bantuan') }}">Bantuan</a></li>
      </ul>
      <a class="lq-btn lq-btn-outline lq-btn-block mt-3" href="{{ url('/katalog') }}">&larr; Ubah Layanan</a>
    </div>

    <main id="main">

      <!-- ===================== PAGE HEADER ===================== -->
      <section class="lq-section lq-bg-panel lq-page-offset" style="padding-bottom:0.1rem">
        <div class="container">
          <div class="lq-head lq-head-center">
            <span class="lq-eyebrow lq-eyebrow-center">Ketersediaan &amp; Reservasi Kursi</span>
            <h1 class="lq-h2">Pilih Jadwal Kunjungan</h1>
          </div>
        </div>
      </section>

      <!-- ===================== BOOKING FORM & SCHEDULE WRAP (Template Style) ===================== -->
      <section class="lq-section lq-bg-cream" style="padding-top:2.5rem; padding-bottom:5rem;">
        <div class="container">
          
          <div class="lq-booking-wrap">
            <div class="lq-booking-grid">

              <!-- Sisi Kiri: Ringkasan Reservasi (Booking Side Template) -->
              <div class="lq-booking-side">
                <img src="{{ asset('img/booking-side.jpg') }}" alt="Amanails Nail Bar Booking Side" width="720" height="900" loading="lazy">
                
                <div class="lq-booking-side-inner">
                  <span class="lq-eyebrow" style="color: var(--lq-gold-soft);">Ringkasan Pemesanan</span>
                  <h3>Amanails Nail Bar</h3>

                  <ul class="lq-booking-perks">
                    <li>Layanan: <strong>{{ $primaryService['name'] }}</strong></li>
                    <li>Kreator Model: <strong>{{ $primaryService['uploaded_by'] }}</strong></li>
                    <li>Durasi: <strong>{{ $primaryService['duration'] }} Menit</strong></li>
                    <li>Tanggal: <strong id="sumDate">Kamis, 20 Nov 2026</strong></li>
                    <li>Jam Kunjungan: <strong id="sumTime">{{ $timeSlots[0]['time'] }}</strong></li>
                    <li>
                      Terapis Bertugas: <strong id="sumArtistName">{{ $timeSlots[0]['assigned_artist']['name'] }}</strong>
                      <small id="sumArtistBadge" style="display:block; font-size:0.75rem; color:var(--lq-gold-soft); margin-top:0.2rem;">
                        {{ $timeSlots[0]['assignment_type'] === 'creator' ? '✨ Kreator Desain' : '🎲 Auto-Assign Sistem' }}
                      </small>
                    </li>
                  </ul>

                  <div class="mt-4 pt-3" style="border-top: 1px solid rgba(255,255,255,0.2);">
                    <small style="text-transform: uppercase; letter-spacing: 0.12em; color: rgba(255,255,255,0.7); font-size: 0.75rem;">Estimasi Total</small>
                    <div style="font-family: var(--lq-serif); font-size: 1.85rem; color: var(--lq-gold-soft); line-height: 1.2;">
                      Rp {{ number_format($primaryService['price'], 0, ',', '.') }}
                    </div>
                  </div>

                  <div class="mt-3">
                    <button type="button" class="lq-btn lq-btn-gold lq-btn-block" id="btnContinueBooking">
                      Lanjut Buat Janji &rarr;
                    </button>
                    <a href="{{ url('/katalog') }}" class="d-block text-center mt-2" style="color: rgba(255,255,255,0.7); font-size: 0.8rem; text-decoration: underline;">
                      &larr; Ubah Pilihan Layanan
                    </a>
                  </div>
                </div>
              </div>

              <!-- Sisi Kanan: Form Pemilihan Tanggal & Jadwal Ketersediaan -->
              <div class="lq-booking-form">
                
                <!-- Steps Wizard Bawaan Template -->
                <div class="lq-steps">
                  <span class="lq-step-pill is-done"><span>01</span>Layanan</span>
                  <span class="lq-step-pill is-done"><span>02</span>Tanggal &amp; Waktu</span>
                  <span class="lq-step-pill"><span>03</span>Pembayaran</span>
                </div>

                <!-- Info Model Kuku Terpilih -->
                <div class="p-3 mb-4" style="background:var(--lq-blush-soft); border:1px solid var(--lq-blush); border-radius:var(--lq-radius);">
                  <div class="d-flex align-items-center gap-3">
                    <img src="{{ $primaryService['image'] }}" alt="{{ $primaryService['name'] }}" style="width:55px; height:55px; object-fit:cover; border-radius:var(--lq-radius);">
                    <div>
                      <span style="font-size:0.75rem; text-transform:uppercase; letter-spacing:0.1em; color:var(--lq-rose-deep); font-weight:600;">Model Terpilih</span>
                      <h5 style="margin:0; font-size:1.05rem;">{{ $primaryService['name'] }}</h5>
                      <span style="font-size:0.82rem; color:var(--lq-mauve);">Nail Artist: <strong>{{ $primaryService['uploaded_by'] }}</strong></span>
                    </div>
                  </div>
                </div>

                <!-- 1. PILIH TANGGAL -->
                <div class="lq-field">
                  <label>1. Pilih Tanggal Kunjungan <span class="req">*</span></label>
                  <div class="d-flex gap-2 flex-wrap">
                    <div class="lq-date-pill is-selected" data-label="Kamis, 20 Nov 2026">
                      <div style="font-size:0.72rem; text-transform:uppercase;">Kamis</div>
                      <div style="font-size:1.15rem; font-weight:700;">20</div>
                      <small>Nov</small>
                    </div>
                    <div class="lq-date-pill" data-label="Jumat, 21 Nov 2026">
                      <div style="font-size:0.72rem; text-transform:uppercase;">Jumat</div>
                      <div style="font-size:1.15rem; font-weight:700;">21</div>
                      <small>Nov</small>
                    </div>
                    <div class="lq-date-pill" data-label="Sabtu, 22 Nov 2026">
                      <div style="font-size:0.72rem; text-transform:uppercase;">Sabtu</div>
                      <div style="font-size:1.15rem; font-weight:700;">22</div>
                      <small>Nov</small>
                    </div>
                    <div class="lq-date-pill" data-label="Minggu, 23 Nov 2026">
                      <div style="font-size:0.72rem; text-transform:uppercase;">Minggu</div>
                      <div style="font-size:1.15rem; font-weight:700;">23</div>
                      <small>Nov</small>
                    </div>
                    <div class="lq-date-pill" data-label="Senin, 24 Nov 2026">
                      <div style="font-size:0.72rem; text-transform:uppercase;">Senin</div>
                      <div style="font-size:1.15rem; font-weight:700;">24</div>
                      <small>Nov</small>
                    </div>
                  </div>
                </div>

                <!-- 2. LIAT JADWAL AVAIL (Slot Waktu Bawaan Template .lq-slots) -->
                <div class="lq-field mt-4">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <label class="mb-0">2. Jadwal Ketersediaan Jam <span class="req">*</span></label>
                    <small style="font-size:0.75rem; color:var(--lq-mauve);">Klik jam yang tersedia</small>
                  </div>

                  <div class="lq-slots">
                    @foreach($timeSlots as $index => $slot)
                      <button type="button" 
                              class="lq-slot {{ $slot['status'] === 'booked' ? 'is-booked' : '' }} {{ $index === 0 ? 'is-selected' : '' }}"
                              data-time="{{ $slot['time'] }}"
                              data-artist-name="{{ $slot['assigned_artist']['name'] }}"
                              data-artist-role="{{ $slot['assigned_artist']['role'] }}"
                              data-artist-spec="{{ $slot['assigned_artist']['specialty'] }}"
                              data-artist-avatar="{{ $slot['assigned_artist']['avatar'] }}"
                              data-assign-type="{{ $slot['assignment_type'] }}"
                              data-assign-note="{{ $slot['assignment_note'] }}"
                              {{ $slot['status'] === 'booked' ? 'disabled' : '' }}>
                        {{ $slot['time'] }}
                        @if($slot['status'] === 'booked')
                          <small>(Penuh)</small>
                        @endif
                      </button>
                    @endforeach
                  </div>
                </div>

                <!-- 3. NAIL ARTIST BERTUGAS (Ditugaskan Sistem Otomatis - Tidak Bisa Dipilih User) -->
                <div class="lq-field mt-4">
                  <div class="d-flex justify-content-between align-items-center mb-2">
                    <label class="mb-0">3. Nail Artist yang Ditugaskan Sistem</label>
                  </div>

                  <div class="lq-assigned-artist-box" id="artistBox">
                    <div class="d-flex align-items-center gap-3">
                      <img id="artistAvatar" 
                           src="{{ $timeSlots[0]['assigned_artist']['avatar'] }}" 
                           alt="{{ $timeSlots[0]['assigned_artist']['name'] }}" 
                           style="width: 58px; height: 58px; border-radius: 50%; object-fit: cover; border: 2px solid var(--lq-rose);">
                      
                      <div class="flex-grow-1">
                        <div class="d-flex flex-wrap align-items-center gap-2 mb-1">
                          <h4 id="artistName" style="margin: 0; font-size: 1.1rem; color: var(--lq-ink);">
                            {{ $timeSlots[0]['assigned_artist']['name'] }}
                          </h4>
                          <span id="assignmentBadge" class="badge" style="background: #e8f5e9; color: #2e7d32; font-size: 0.72rem; padding: 0.25rem 0.6rem; border-radius: 999px;">
                            {{ $timeSlots[0]['assignment_type'] === 'creator' ? '✨ Kreator Model Kuku' : '🎲 Auto-Assign Sistem' }}
                          </span>
                        </div>
                        <div id="artistRole" class="lq-tech-role" style="font-size: 0.74rem;">
                          {{ $timeSlots[0]['assigned_artist']['role'] }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>

            </div>
          </div>

        </div>
      </section>

    </main>

    <div class="modal fade" id="previewModal" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: var(--lq-radius-lg); overflow: hidden; border: 1px solid var(--lq-line);">
          <div class="modal-header" style="background: var(--lq-plum); color: #fff;">
            <h5 class="modal-title" style="font-family: var(--lq-serif); color: #fff; font-size: 1.2rem;">
              Konfirmasi &amp; Upload Bukti Bayar
            </h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
          </div>
          <div class="modal-body p-4" style="background: var(--lq-cream);">
            <div class="lq-field">
              <label>Nama Pemesan</label>
              <input type="text" class="lq-input" value="Sela (Pelanggan)" readonly>
            </div>
            <div class="lq-field">
              <label>Nomor WhatsApp</label>
              <input type="text" class="lq-input" value="0812-9876-5432" placeholder="08xxxxxxxx">
            </div>
            <div class="lq-field mb-0">
              <label>Upload Bukti Pembayaran (Transfer/QRIS)</label>
              <input type="file" class="lq-input">
            </div>
          </div>
          <div class="modal-footer" style="background: var(--lq-cream-2);">
            <button type="button" class="lq-btn lq-btn-outline lq-btn-sm" data-bs-dismiss="modal">Tutup</button>
            <button type="button" class="lq-btn lq-btn-primary lq-btn-sm" onclick="alert('Simulasi Booking Berhasil Dikirim!'); location.href='{{ url('/katalog') }}';">
              Kirim Reservasi (Simulasi)
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
            <h5>Jelajahi</h5>
            <ul>
              <li><a href="{{ url('/katalog') }}">Katalog</a></li>
              <li><a href="{{ url('/jadwal') }}">Jadwal &amp; Booking</a></li>
              <li><a href="{{ url('/services') }}">Menu Lengkap</a></li>
              <li><a href="{{ url('/bantuan') }}">Bantuan</a></li>
            </ul>
          </div>
          <div class="col-6 col-lg-2">
            <h5>Kunjungan</h5>
            <ul>
              <li><a href="#">Selasa &ndash; Minggu: 09:00 - 20:00</a></li>
              <li><a href="tel:+6281234567890">(021) 555-0142</a></li>
              <li><a href="mailto:halo@amanails.com">halo@amanails.com</a></li>
            </ul>
          </div>
        </div>

        <div class="lq-footer-bottom">
          <p style="margin:0">&copy; {{ date('Y') }} Amanails Nail Bar. Seluruh hak cipta dilindungi.</p>
          <p style="margin:0"><a href="#main">Kembali ke atas &uarr;</a></p>
        </div>
      </div>
    </footer>

    <!-- Bootstrap Bundle JS & Main Template JS -->
    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
        const datePills = document.querySelectorAll('.lq-date-pill');
        const slots = document.querySelectorAll('.lq-slot:not(.is-booked)');
        
        const sumDate = document.getElementById('sumDate');
        const sumTime = document.getElementById('sumTime');
        const sumArtistName = document.getElementById('sumArtistName');
        const sumArtistBadge = document.getElementById('sumArtistBadge');

        const artistAvatar = document.getElementById('artistAvatar');
        const artistName = document.getElementById('artistName');
        const artistRole = document.getElementById('artistRole');
        const artistNote = document.getElementById('artistNote');
        const assignmentBadge = document.getElementById('assignmentBadge');

        const btnContinueBooking = document.getElementById('btnContinueBooking');
        const modal = new bootstrap.Modal(document.getElementById('previewModal'));

        datePills.forEach(pill => {
          pill.addEventListener('click', function () {
            datePills.forEach(p => p.classList.remove('is-selected'));
            this.classList.add('is-selected');
            sumDate.textContent = this.getAttribute('data-label');
          });
        });

        slots.forEach(slot => {
          slot.addEventListener('click', function () {
            slots.forEach(s => s.classList.remove('is-selected'));
            this.classList.add('is-selected');

            const time = this.getAttribute('data-time');
            const name = this.getAttribute('data-artist-name');
            const role = this.getAttribute('data-artist-role');
            const avatar = this.getAttribute('data-artist-avatar');
            const type = this.getAttribute('data-assign-type');
            const note = this.getAttribute('data-assign-note');

            sumTime.textContent = time;
            sumArtistName.textContent = name;
            sumArtistBadge.textContent = (type === 'creator') ? '✨ Kreator Desain' : '🎲 Auto-Assign Sistem';

            artistName.textContent = name;
            artistRole.textContent = role;
            artistAvatar.src = avatar;
            artistNote.textContent = note;

            if (type === 'creator') {
              assignmentBadge.textContent = '✨ Kreator Model Kuku';
              assignmentBadge.style.background = '#e8f5e9';
              assignmentBadge.style.color = '#2e7d32';
            } else {
              assignmentBadge.textContent = '🎲 Auto-Assign Sistem';
              assignmentBadge.style.background = '#fff3e0';
              assignmentBadge.style.color = '#e65100';
            }
          });
        });

        btnContinueBooking.addEventListener('click', function () {
          modal.show();
        });
      });
    </script>
  </body>
</html>
