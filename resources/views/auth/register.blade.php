<!DOCTYPE html>
<html lang="id">
  <head>
    <script>document.documentElement.classList.add('js')</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar Akun Baru &mdash; Amanails Nail Bar</title>
    <meta name="description" content="Daftar akun pelanggan Amanails Nail Bar untuk menikmati kemudahan reservasi, diskon member, dan poin reward.">

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
          <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5">

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
                <span class="lq-eyebrow">Pelanggan Baru</span>
                <h1 style="font-size: 1.85rem; margin-top: 0.25rem; margin-bottom: 0.5rem;">Buat Akun Baru</h1>
                <p style="color: var(--lq-mauve); font-size: 0.92rem; margin-bottom: 0;">
                  Lengkapi data diri Anda di bawah ini untuk bergabung dengan Amanails Nail Bar.
                </p>
              </div>

              @if(session('error'))
                <div class="alert alert-danger" role="alert" style="background: #fdf2f2; color: #a82323; border: 1px solid #f9d4d4; border-radius: var(--lq-radius); padding: 0.85rem 1rem; font-size: 0.88rem; margin-bottom: 1.5rem;">
                  {{ session('error') }}
                </div>
              @endif

              <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf

                <!-- Full Name Field -->
                <div class="lq-field @error('name') has-error @enderror">
                  <label for="name">Nama Lengkap <span class="req">*</span></label>
                  <input class="lq-input" type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Contoh: Sarah Azhari" required autocomplete="name" autofocus>
                  @error('name')
                    <span class="lq-field-error" style="display:block;">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Email Address Field -->
                <div class="lq-field @error('email') has-error @enderror">
                  <label for="email">Alamat Email <span class="req">*</span></label>
                  <input class="lq-input" type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required autocomplete="email">
                  @error('email')
                    <span class="lq-field-error" style="display:block;">{{ $message }}</span>
                  @enderror
                </div>

                <!-- Password Field Row -->
                <div class="lq-field-row">
                  <!-- Password -->
                  <div class="lq-field @error('password') has-error @enderror">
                    <label for="password">Kata Sandi <span class="req">*</span></label>
                    <input class="lq-input" type="password" id="password" name="password" placeholder="Min. 8 karakter" required autocomplete="new-password">
                    @error('password')
                      <span class="lq-field-error" style="display:block;">{{ $message }}</span>
                    @enderror
                  </div>

                  <!-- Confirm Password -->
                  <div class="lq-field">
                    <label for="password_confirmation">Konfirmasi Sandi <span class="req">*</span></label>
                    <input class="lq-input" type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" required autocomplete="new-password">
                  </div>
                </div>

                <!-- Terms & Conditions note -->
                <p style="font-size: 0.8rem; color: var(--lq-mauve-soft); line-height: 1.5; margin-bottom: 1.5rem;">
                  Dengan mendaftar, Anda menyetujui kebijakan reservasi, privasi, dan syarat layanan Amanails Nail Bar.
                </p>

                <!-- Submit Button -->
                <button type="submit" class="lq-btn lq-btn-primary lq-btn-block">Daftar Sekarang</button>

                <!-- Switch Link -->
                <p class="text-center mt-4 mb-0" style="font-size: 0.9rem; color: var(--lq-mauve);">
                  Sudah punya akun? <a href="{{ route('login') }}" style="color: var(--lq-rose-deep); font-weight: 500;">Masuk di sini</a>
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
