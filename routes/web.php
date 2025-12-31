<?php

use Illuminate\Support\Facades\Route;

// TODO: Teman -> Ini adalah file routing. Daftarkan URL baru di sini.


Route::get('/', function () {
    return view('pages.home');
})->name('home');


Route::get('/login', function () {
    return view('pages.auth.login');
})->name('login');

Route::get('/register', function () {
    return view('pages.auth.register');
})->name('register');


Route::get('/calculator', function () {
    return view('pages.calculator');
})->name('calculator');

Route::get('/tracking', function () {
    return view('pages.tracking');
})->name('tracking');

Route::get('/petani', function () {
    return view('pages.petani');
})->name('petani');

Route::get('/mitra', function () {
    return view('pages.mitra');
})->name('mitra');

Route::get('/kalkulasi-kriteria', function () {
    return view('pages.kalkulasi_kriteria');
})->name('kalkulasi.kriteria');
