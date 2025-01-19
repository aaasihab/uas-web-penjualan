<?php
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\KategoriProdukController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;

// routes/web.php


Route::get('login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('unauthorized', [AuthController::class, 'unauthorized'])->name('unauthorized');

Route::get('register', [AuthController::class, 'registerForm'])->name('register.form'); // Menampilkan form register
Route::post('register', [AuthController::class, 'register'])->name('register'); // Memproses registrasi

Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::middleware(['auth'])->prefix('master-data')->name('master.data.')->group(function () {

    Route::prefix('transaksi')->name('transaksi.')->group(function () {
        Route::get('/', [TransaksiController::class, 'index'])
            ->name('index');

        Route::get('/create/{produk}', [TransaksiController::class, 'create'])
            ->middleware('role:pelanggan')
            ->name('create');

        Route::post('/store/{produk}', [TransaksiController::class, 'store'])
            ->middleware('role:pelanggan')
            ->name('store');

        Route::put('/{idtransaksi}', [TransaksiController::class, 'update'])
            ->middleware('role:pelanggan')
            ->name('update');
        Route::put('/transaksi/{idTransaksi}', [TransaksiController::class, 'cancel'])
            ->name('cancel');
    });

    Route::prefix('pembayaran')->name('pembayaran.')->group(function () {
        Route::get('/', [PembayaranController::class, 'index'])
            ->name('index');
        Route::get('/create/{transaksi}', [PembayaranController::class, 'create'])
            ->middleware('role:pelanggan')
            ->name('create');
        Route::post('/store/{transaksi}', [PembayaranController::class, 'store'])
            ->middleware('role:pelanggan')
            ->name('store');
    });

    // Route::resource('pembayaran', PembayaranController::class);

    Route::resource('kategoriProduk', KategoriProdukController::class)->middleware(['role:admin']);

    Route::middleware(['role:admin'])->prefix('produk')->name('produk.')->group(function () {
        Route::get('/', [ProdukController::class, 'index'])->name('index');
        Route::get('/create', [ProdukController::class, 'create'])->name('create');
        Route::post('/', [ProdukController::class, 'store'])->name('store');
        Route::get('/{produk}/edit', [ProdukController::class, 'edit'])->name('edit');
        Route::put('/{produk}', [ProdukController::class, 'update'])->name('update');
        Route::delete('/{produk}', [ProdukController::class, 'destroy'])->name('destroy');
    });

    Route::middleware(['role:admin'])->prefix('user')->name('user.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('destroy');
    });
});

Route::middleware(['auth'])->prefix('profile')->name('profile.')->group(function () {
    Route::get('/', [ProfileController::class, 'index'])->name('index');
    Route::put('/{user}', [ProfileController::class, 'update'])->name('update');
});
