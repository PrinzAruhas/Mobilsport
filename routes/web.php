<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MobilController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\SewaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\TeknisiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PengembalianController;

Route::get('/', [AuthController::class, 'index'])->name('pageAuth');
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- TAMBAHKAN ROUTE REGISTER DI SINI ---
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'storeRegister'])->name('register.store');
// ----------------------------------------

Route::resource('users', UsersController::class);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('pageDashboard');
    Route::get('/users', [UsersController::class, 'index'])->name('pageUsers');
    Route::get('/roles', [DashboardController::class, 'index'])->name('pageRoles');
    Route::get('/menus', [DashboardController::class, 'index'])->name('pageMenus');
    Route::get('/sub-menus', [DashboardController::class, 'index'])->name('pageSubMenus');
});
Route::get('/mobil/katalog', [MobilController::class, 'katalog'])->name('mobil.katalog');
Route::get('/mobil', [MobilController::class, 'index'])->name('mobil.index');

// Route untuk form tambah mobil
Route::get('/mobil/create', [MobilController::class, 'create'])->name('mobil.create');

// Route untuk proses simpan data (AJAX yang kita buat sebelumnya)
Route::post('/mobil', [MobilController::class, 'store'])->name('mobil.store');

// Route untuk hapus mobil
Route::delete('/mobil/{id}', [MobilController::class, 'destroy'])->name('mobil.destroy');
Route::get('/mobil/{id}/edit', [MobilController::class, 'edit'])->name('mobil.edit');

// Proses untuk menyimpan perubahan data (Update)
Route::put('/mobil/{id}', [MobilController::class, 'update'])->name('mobil.update');
Route::get('/katalog', [App\Http\Controllers\KatalogController::class, 'index'])->name('katalog');
Route::get('/sewa/create', [SewaController::class, 'create'])->name('sewa.create');
Route::post('/proses-pembayaran', [SewaController::class, 'store'])->name('sewa.store');
Route::get('/mobil/{id}', [SewaController::class, 'show'])->name('mobil.show');
Route::get('/sewa/konfirmasi', [SewaController::class, 'create'])->name('sewa.create');
// Jika katalog adalah halaman utama mobil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Grouping agar lebih rapi
Route::middleware(['auth'])->group(function () {
    
    // Route untuk menampilkan halaman direktori (User List)
    Route::get('/users', [UsersController::class, 'index'])->name('users.index');

    // Route untuk update role (yang dipanggil di Modal)
    Route::put('/users/{id}', [UsersController::class, 'update'])->name('users.update');

    // Route untuk hapus user (yang dipanggil lewat SweetAlert)
    Route::delete('/users/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
});

// routes/web.php
Route::get('/transaksi', [TeknisiController::class, 'verifikasiIndex'])->name('teknisi.verifikasi');

// Route inilah yang menyebabkan error jika belum ada:
Route::patch('/transaksi/{id}/verifikasi', [TeknisiController::class, 'updateVerifikasi'])->name('teknisi.verifikasi.update');

Route::post('/mobil/store', [MobilController::class, 'store'])->name('mobil.store');

// Pastikan rutenya seperti ini di web.php
Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
// Pastikan menggunakan method POST karena di form modal kita menggunakan method="POST"
// Pastikan nama method-nya 'kembalikanMobil' sesuai dengan isi Controller
Route::post('/sewa/kembalikan/{id}', [SewaController::class, 'kembalikanMobil'])->name('booking.kembalikan');
Route::get('/lapor-kerusakan', [SewaController::class, 'laporanTeknisi'])->name('teknisi.laporan');
Route::post('/sewa/update-status/{id}', [SewaController::class, 'updateStatus'])->name('sewa.updateStatus');


Route::post('/laporan-admin/store', [DashboardController::class, 'storeLaporan'])->name('laporan.admin.store');
Route::post('/laporan-admin/reply', [DashboardController::class, 'replyLaporan'])->name('laporan.admin.reply');

// DARI INI:
Route::get('/riwayat-servis', [App\Http\Controllers\TeknisiController::class, 'index']);

Route::post('/pengembalian/store', [App\Http\Controllers\TeknisiController::class, 'storePengembalian'])->name('pengembalian.store');


Route::get('/promo', [PromoController::class, 'index']);
Route::post('/promo/update', [PromoController::class, 'updateDiskon'])->name('promo.update');

Route::get('/statistik', [SewaController::class, 'statistik'])->name('statistik.index');

Route::get('/servis', [ServiceController::class, 'index']);
Route::post('/servis/update/{id}', [ServiceController::class, 'updateStatus']);

Route::middleware(['auth'])->group(function () {
    Route::post('/komentar/simpan', [CommentController::class, 'store'])->name('komentar.store');
});

Route::post('/promo/update', [PromoController::class, 'update'])->name('promo.update');
    
    // TAMBAHKAN INI:
    Route::post('/promo/store-code', [PromoController::class, 'storeCode'])->name('promo.store_code');

    Route::delete('/admin/promo/code/{id}', [PromoController::class, 'destroyCode'])->name('promo.delete_code');

    Route::get('/redeem', [PromoController::class, 'showRedeem'])->name('booking.redeem');

// Route untuk memproses kode promo
Route::post('/redeem/apply', [PromoController::class, 'applyPromo'])->name('booking.apply_promo');

Route::post('/remove-promo', function() {
    session()->forget('applied_promo');
    return back()->with('success', 'Kode promo dilepas.');
})->name('booking.remove_promo');

Route::get('/booking', [BookingController::class, 'index'])->name('peminjam.booking');

Route::get('/peminjam/pengembalian', [BookingController::class, 'returnIndex'])->name('peminjam.booking');

Route::post('/pengembalian/store', [PengembalianController::class, 'store'])->name('pengembalian.store');

// Pastikan tidak menggunakan Route::view kalau butuh kirim data variabel
Route::get('/statistik', [App\Http\Controllers\StatistikController::class, 'index']);

// Gunakan parameter opsional {id?} agar tidak error "Too few arguments"
Route::post('/promo/update/{id?}', [PromoController::class, 'update'])->name('promo.update');
Route::post('/promo/store-code', [PromoController::class, 'storeCode'])->name('promo.store_code');
Route::delete('/promo/delete-code/{id}', [PromoController::class, 'destroyCode'])->name('promo.delete_code');