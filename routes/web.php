<?php
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\BukuController;
use App\Http\Controllers\UserController;

// routes/web.php


Route::get('login', [AuthController::class, 'loginForm'])->name('login.form');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('unauthorized', [AuthController::class, 'unauthorized'])->name('unauthorized');

Route::get('register', [AuthController::class, 'registerForm'])->name('register.form'); // Menampilkan form register
Route::post('register', [AuthController::class, 'register'])->name('register'); // Memproses registrasi


Route::get('/', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
// Route::post('/{buku}/{user}', [DashboardController::class, 'createPeminjaman'])->middleware('auth')->name('createPeminjaman');
// Menampilkan form peminjaman
// Route::get('/peminjaman/create/{buku}', [PeminjamanController::class, 'create'])->middleware('role:pengguna')->name('createPeminjaman');

// Menyimpan peminjaman
// Route::post('/peminjaman/store/{buku}', [PeminjamanController::class, 'store'])->name('storePeminjaman');


Route::middleware(['auth'])->prefix('master-data')->name('master.data.')->group(function () {

    // Route::get('/peminjaman', [PeminjamanController::class, 'index'])
    //     ->name('peminjaman.index')
    //     ->middleware('auth');

    Route::prefix('peminjaman')->name('peminjaman.')->group(function () {
        Route::get('/', [PeminjamanController::class, 'index'])
            ->name('index');

        Route::get('/create/{buku}', [PeminjamanController::class, 'create'])
            ->middleware('role:pengguna')
            ->name('create');

        Route::post('/store/{buku}', [PeminjamanController::class, 'store'])
            ->name('store');
            
        Route::put('/{idPeminjaman}', [PeminjamanController::class, 'update'])
            ->name('update');
    });

    Route::resource('kategori', KategoriController::class)->middleware(['role:super_admin']);

    Route::middleware(['role:super_admin,admin'])->prefix('buku')->name('buku.')->group(function () {
        Route::get('/', [BukuController::class, 'index'])->name('index');
        Route::get('/create', [BukuController::class, 'create'])->name('create');
        Route::post('/', [BukuController::class, 'store'])->name('store');
        Route::get('/{buku}/edit', [BukuController::class, 'edit'])->name('edit');
        Route::put('/{buku}', [BukuController::class, 'update'])->name('update');
        Route::delete('/{buku}', [BukuController::class, 'destroy'])->name('destroy');
    });

    Route::middleware(['role:super_admin'])->prefix('user')->name('user.')->group(function () {
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
