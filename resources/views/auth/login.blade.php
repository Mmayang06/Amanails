<!DOCTYPE html>
<html lang="id">
  <head>
    <script>document.documentElement.classList.add('js')</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Masuk &mdash; Amanails Nail Bar</title>
    <meta name="description" content="Masuk ke akun pelanggan Amanails Nail Bar Anda untuk mengelola janji temu dan menikmati promo eksklusif.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;1,9..144,400;1,9..144,500&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  </head>
  <body style="min-height: 100vh; display: flex; flex-direction: column; justify-content: center; background: var(--lq-cream);">

    <!-- ===================== MAIN CONTENT (NO NAVBAR) ===================== -->
    <main id="main" class="py-5">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-sm-10 col-md-8 col-lg-5 col-xl-5">

            <!-- Logo -->
            <div class="text-center mb-4">
              <a class="lq-brand" href="{{ url('/') }}" aria-label="Amanails Nail Bar — Beranda" style="display: inline-block;">
                Amanails<span class="lq-dot">.</span>
                <small style="display: block; font-size: 0.75rem; letter-spacing: 0.15em; color: var(--lq-mauve); margin-top: 2px;">Nail Bar</small>
              </a>
            </div>

            <!-- Card Box -->
            <div class="lq-booking-wrap" style="background: var(--lq-white); border-radius: var(--lq-radius-lg); box-shadow: var(--lq-shadow); padding: 2.75rem 2.25rem;">
              <div class="text-center mb-4">
                <h1 style="font-size: 1.85rem; margin-top: 0.25rem; margin-bottom: 0.5rem;">Masuk ke Akun</h1>
                <p style="color: var(--lq-mauve); font-size: 0.92rem; margin-bottom: 0;">
                  Masukkan email dan kata sandi Anda untuk mengakses akun Amanails Nail Bar.
                </p>
              </div>

              @if(session('success'))
                <div class="alert alert-success" role="alert" style="background: #eef6ee; color: #2e6930; border: 1px solid #d4ebd4; border-radius: var(--lq-radius); padding: 0.85rem 1rem; font-size: 0.88rem; margin-bottom: 1.5rem;">
                  {{ session('success') }}
                </div>
              @endif

              @if(session('error'))
                <div class="alert alert-danger" role="alert" style="background: #fdf2f2; color: #a82323; border: 1px solid #f9d4d4; border-radius: var(--lq-radius); padding: 0.85rem 1rem; font-size: 0.88rem; margin-bottom: 1.5rem;">
                  {{ session('error') }}
                </div>
              @endif

              <form action="{{ route('login') }}" method="POST" novalidate>
                @csrf

                <!-- Email Field -->
                <div class="lq-field @error('email') has-error @enderror">
                  <label for="email">Alamat Email <span class="req">*</span></label>
                  <input class="lq-input" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autocomplete="email" autofocus>
                  @error('email')
                    <span class="lq-field-error" style="display:block;">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Password Field -->
                <div class="lq-field @error('password') has-error @enderror">
                  <label for="password">Kata Sandi <span class="req">*</span></label>
                  <div style="position: relative; width: 100%; display: flex; align-items: center;">
                    <input class="lq-input" type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password" style="padding-right: 2.75rem; width: 100%;">
                    <button type="button" id="togglePasswordBtn" aria-label="Tampilkan atau sembunyikan kata sandi" title="Tampilkan / sembunyikan kata sandi" style="position: absolute; right: 0.75rem; background: none; border: none; padding: 0.25rem 0.35rem; color: var(--lq-mauve); cursor: pointer; display: flex; align-items: center; justify-content: center; border-radius: 4px; transition: color 0.2s ease;">
                      <!-- Eye Icon (Password hidden, click to show) -->
                      <svg id="eyeIconOpen" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                        <circle cx="12" cy="12" r="3"></circle>
                      </svg>
                      <!-- Eye Off Icon (Password visible, click to hide) -->
                      <svg id="eyeIconClosed" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: none;">
                        <path d="M9.88 9.88a3 3 0 1 0 4.24 4.24"></path>
                        <path d="M10.73 5.08A10.43 10.43 0 0 1 12 5c7 0 10 7 10 7a13.16 13.16 0 0 1-1.67 2.68"></path>
                        <path d="M6.61 6.61A13.526 13.526 0 0 0 2 12s3 7 10 7a9.74 9.74 0 0 0 5.39-1.61"></path>
                        <line x1="2" x2="22" y1="2" y2="22"></line>
                      </svg>
                    </button>
                  </div>
                  @error('password')
                    <span class="lq-field-error" style="display:block;">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Remember Me -->
                <div class="d-flex justify-content-between align-items-center mb-4" style="font-size: 0.85rem;">
                  <label style="cursor: pointer; display: flex; align-items: center; gap: 0.5rem; color: var(--lq-mauve); margin-bottom: 0; text-transform: none; letter-spacing: normal;">
                    <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }} style="accent-color: var(--lq-rose); width: 16px; height: 16px; cursor: pointer;">
                    Ingat saya
                  </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="lq-btn lq-btn-primary lq-btn-block">Masuk</button>

                <!-- Switch Link -->
                <p class="text-center mt-4 mb-0" style="font-size: 0.9rem; color: var(--lq-mauve);">
                  Belum punya akun? <a href="{{ route('register') }}" style="color: var(--lq-rose-deep); font-weight: 500;">Daftar akun baru</a>
                </p>
              </form>
            </div>

            <!-- Footer & Back to Site -->
            <div class="text-center mt-4">
              <a href="{{ url('/') }}" style="color: var(--lq-mauve); font-size: 0.88rem; text-decoration: none;">&larr; Kembali ke Beranda Amanails Nail Bar</a>
              <p class="mt-2 mb-0" style="font-size: 0.8rem; color: var(--lq-mauve-soft);">&copy; {{ date('Y') }} Amanails Nail Bar. Seluruh hak cipta dilindungi.</p>
            </div>

          </div>
        </div>
      </div>
    </main>

    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script>
      (function() {
        const toggleBtn = document.getElementById('togglePasswordBtn');
        const passInput = document.getElementById('password');
        const eyeOpen = document.getElementById('eyeIconOpen');
        const eyeClosed = document.getElementById('eyeIconClosed');

        if (toggleBtn && passInput && eyeOpen && eyeClosed) {
          toggleBtn.addEventListener('click', function() {
            const isPassword = passInput.getAttribute('type') === 'password';
            passInput.setAttribute('type', isPassword ? 'text' : 'password');
            eyeOpen.style.display = isPassword ? 'none' : 'block';
            eyeClosed.style.display = isPassword ? 'block' : 'none';
            toggleBtn.setAttribute('aria-label', isPassword ? 'Sembunyikan kata sandi' : 'Tampilkan kata sandi');
          });
        }
      })();
    </script>
  </body>
</html>
