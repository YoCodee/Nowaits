<?php

use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return view('pages.intro');
})->name('intro');

Route::get('/home', function () {
    $wasteSavedKg = \App\Models\Transaksi::where('status', 'selesai')->sum('jumlah_kg');
    $pendapatanPetani = \App\Models\Transaksi::where('status', 'selesai')->sum('total_harga_barang');
    $mitraAktif = \App\Models\User::where('peran', 'mitra')->count();

    return view('pages.home', compact('wasteSavedKg', 'pendapatanPetani', 'mitraAktif'));
})->name('home');

Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\AuthController::class, 'login']);
Route::get('/register', [App\Http\Controllers\AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [App\Http\Controllers\AuthController::class, 'register']);
Route::post('/logout', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    // Buah Routes
    Route::get('/buah/template', [App\Http\Controllers\BuahController::class, 'downloadTemplate'])->name('buah.template');
    Route::get('/buah/import', [App\Http\Controllers\BuahController::class, 'import'])->name('buah.import');
    Route::post('/buah/import', [App\Http\Controllers\BuahController::class, 'storeImport'])->name('buah.storeImport');
    Route::resource('buah', App\Http\Controllers\BuahController::class);

    // Postingan Routes (Petani)
    Route::resource('postingan', App\Http\Controllers\PostinganController::class);

    // Permintaan Mitra Routes (Mitra)
    Route::resource('permintaan-mitra', App\Http\Controllers\PermintaanMitraController::class);

    // Transaksi / Checkout
    Route::get('/transaksi', [App\Http\Controllers\TransaksiController::class, 'index'])->name('transaksi.index');
    Route::get('/transaksi/sales', [App\Http\Controllers\TransaksiController::class, 'incomingOrders'])->name('transaksi.sales'); // Seller view

    Route::get('/transaksi/{id}/payment', [App\Http\Controllers\TransaksiController::class, 'showPayment'])->name('transaksi.payment');
    Route::post('/transaksi/{id}/payment', [App\Http\Controllers\TransaksiController::class, 'updatePayment'])->name('transaksi.payment.update');

    Route::post('/transaksi/{id}/confirm', [App\Http\Controllers\TransaksiController::class, 'confirmOrder'])->name('transaksi.confirm');
    Route::post('/transaksi/{id}/ship', [App\Http\Controllers\TransaksiController::class, 'shipOrder'])->name('transaksi.ship');
    Route::get('/transaksi/{id}/track', [App\Http\Controllers\TransaksiController::class, 'trackOrder'])->name('transaksi.track');

    Route::get('/marketplace/{id}/checkout', [App\Http\Controllers\TransaksiController::class, 'checkout'])->name('transaksi.checkout');
    Route::post('/transaksi', [App\Http\Controllers\TransaksiController::class, 'store'])->name('transaksi.store');

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');

    // Admin Routes
    Route::resource('admin/petani', App\Http\Controllers\Admin\PetaniController::class, ['as' => 'admin']);
    Route::resource('admin/mitra', App\Http\Controllers\Admin\MitraController::class, ['as' => 'admin']);
    Route::get('admin/transaksi', [App\Http\Controllers\Admin\TransactionReportController::class, 'index'])->name('admin.transaksi.index');
    Route::get('admin/pengiriman', [App\Http\Controllers\Admin\ShippingReportController::class, 'index'])->name('admin.pengiriman.index');

    // Penawaran Routes
    Route::get('/permintaan/{id}/offer', [App\Http\Controllers\PenawaranController::class, 'create'])->name('penawaran.create');
    Route::post('/permintaan/{id}/offer', [App\Http\Controllers\PenawaranController::class, 'store'])->name('penawaran.store');

    Route::post('/penawaran/{id}/accept', [App\Http\Controllers\PenawaranController::class, 'accept'])->name('penawaran.accept');
    Route::post('/penawaran/{id}/reject', [App\Http\Controllers\PenawaranController::class, 'reject'])->name('penawaran.reject');
    Route::get('/penawaran/{id}/checkout', [App\Http\Controllers\PenawaranController::class, 'checkout'])->name('penawaran.checkout');
    
    // Chat Routes
    Route::get('/chat', [App\Http\Controllers\ChatController::class, 'index'])->name('chat.index');
    Route::post('/chat/start', [App\Http\Controllers\ChatController::class, 'startChat'])->name('chat.start');
    
    // Perhatikan parameternya sekarang {conversation_id}
    Route::get('/chat/{conversation_id}', [App\Http\Controllers\ChatController::class, 'show'])->name('chat.show');
    
    // API Routes untuk Axios
    Route::get('/chat/{conversation_id}/messages', [App\Http\Controllers\ChatController::class, 'fetch']);
    Route::post('/chat/store', [App\Http\Controllers\ChatController::class, 'store'])->name('chat.store');
    Route::post('/chat/{conversation_id}/send', [App\Http\Controllers\ChatController::class, 'sendMessage']);
});


Route::get('/marketplace', [App\Http\Controllers\MarketplaceController::class, 'index'])->name('marketplace.index');
Route::get('/marketplace/{id}', [App\Http\Controllers\MarketplaceController::class, 'show'])->name('marketplace.show');




Route::get('/petani', function () {
    return view('pages.petani');
})->name('petani');

Route::get('/mitra', function () {
    return view('pages.mitra');
})->name('mitra');

Route::get('/kalkulasi-kriteria', function () {
    return view('pages.kalkulasi_kriteria');
})->name('kalkulasi.kriteria');
