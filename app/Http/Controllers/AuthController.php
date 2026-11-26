<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Tentukan URL tujuan setelah login berdasarkan role pengguna.
     */
    private function redirectPathForRole(?User $user): string
    {
        return match ($user?->role) {
            'admin' => route('admin.dashboard'),
            'nail_artist' => route('terapis.dashboard'),
            default => route('home'),
        };
    }

    /**
     * Tampilkan formulir login.
     */
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect($this->redirectPathForRole(Auth::user()));
        }

        return view('auth.login');
    }

    /**
     * Proses otentikasi login pengguna.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            return redirect($this->redirectPathForRole(Auth::user()))
                ->with('success', 'Selamat datang kembali, '.Auth::user()->name.'!');
        }

        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Tampilkan formulir registrasi.
     */
    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect($this->redirectPathForRole(Auth::user()));
        }

        return view('auth.register');
    }

    /**
     * Proses registrasi pengguna baru.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Format alamat email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar. Silakan gunakan email lain atau login.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal harus 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'buyer',
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect($this->redirectPathForRole($user))->with('success', 'Pendaftaran berhasil! Selamat datang di Amanails Nail Bar.');
    }

    /**
     * Proses logout pengguna.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil logout.');
    }
}
