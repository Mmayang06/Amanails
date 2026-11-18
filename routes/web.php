<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TerapisController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/services', function () {
    return view('services');
})->name('services');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Terapis Portal Routes (Mock Data)
Route::get('/terapis/dashboard', [TerapisController::class, 'dashboard'])->name('terapis.dashboard');
