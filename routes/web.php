<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BuyerController;
use App\Http\Controllers\TerapisController;
use Illuminate\Support\Facades\Route;

// Buyer Flow (Sela) - POV Buyer
Route::get('/', [BuyerController::class, 'katalog'])->name('home');
Route::get('/katalog', [BuyerController::class, 'katalog'])->name('katalog');
Route::get('/jadwal', [BuyerController::class, 'jadwal'])->name('jadwal');
Route::get('/jadwal/availability', [BuyerController::class, 'availability'])->name('jadwal.availability');
Route::get('/booking', [BuyerController::class, 'jadwal'])->name('booking');
Route::post('/booking', [BuyerController::class, 'storeBooking'])->name('booking.store');
Route::get('/bantuan', [BuyerController::class, 'bantuan'])->name('bantuan');

// Halaman Template Asli (Menu Lengkap & Showcase)
Route::get('/services', function () {
    return view('buyer.services');
})->name('services');

// Auth Routes (Aurel / Mayang / Sela)
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Terapis / Nail Artist Portal Routes (Aurel)
Route::get('/terapis/dashboard', [TerapisController::class, 'dashboard'])->name('terapis.dashboard');
Route::get('/terapis/karya', [TerapisController::class, 'karya'])->name('terapis.karya');
Route::get('/terapis/cuti', [TerapisController::class, 'cuti'])->name('terapis.cuti');

// Appointment & Kasir Hari-H API (Terapis & Admin)
Route::post('/appointments/{appointment}/addons', [TerapisController::class, 'addAddon'])->name('appointments.addons.store');
Route::delete('/appointments/{appointment}/addons/{item}', [TerapisController::class, 'removeAddon'])->name('appointments.addons.destroy');
Route::patch('/appointments/{appointment}/start', [TerapisController::class, 'startAppointment'])->name('appointments.start');
Route::patch('/appointments/{appointment}/complete', [TerapisController::class, 'completeAppointment'])->name('appointments.complete');

// Admin Routes (Maria)
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/cuti', [AdminController::class, 'cuti'])->name('admin.cuti');
Route::get('/admin/katalog', [AdminController::class, 'katalog'])->name('admin.katalog');
Route::get('/admin/laporan', [AdminController::class, 'dashboard'])->name('admin.laporan');
