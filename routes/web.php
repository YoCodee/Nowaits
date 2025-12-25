<?php

use Illuminate\Support\Facades\Route;

// TODO: Teman -> Ini adalah file routing. Daftarkan URL baru di sini.

// Halaman Utama / Landing
Route::get('/', function () {
    return view('pages.home');
})->name('home');

// Routes untuk Authentication (Tampilan saja dulu)
Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');

Route::get('/register', function () {
    return view('pages.auth.register');
})->name('register');

// Route Fitur Khusus
Route::get('/calculator', function () {
    return view('pages.calculator');
})->name('calculator');

Route::get('/tracking', function () {
    return view('pages.tracking');
})->name('tracking');

// TODO: Tambahkan route untuk halaman Market/Jual Beli di masa depan
// Route::get('/market', ...);
