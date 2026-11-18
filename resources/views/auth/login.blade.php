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
                  <input class="lq-input" type="password" id="password" name="password" placeholder="••••••••" required autocomplete="current-password">
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
  </body>
</html>
