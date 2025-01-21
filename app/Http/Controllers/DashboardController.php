<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\KategoriProduk;
use App\Models\Pembayaran;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategoriProduk')->where('status', 'aktif')->get();
        ;
        return view('dashboard.index', compact('produks'));
    }
    public function admin()
    {
        // Menghitung jumlah produk aktif
        $jumlahProduk = Produk::where('status', 'aktif')->count();

        // Menghitung jumlah kategori
        $jumlahKategori = KategoriProduk::count();

        // Menghitung jumlah pendaftaran pengguna
        $jumlahPengguna = User::count();

        // Menghitung jumlah transaksi yang berstatus "belum bayar" atau "dibatalkan"
        $jumlahTransaksi = Transaksi::whereIn('status', ['belum bayar', 'batal'])->count();

        // Menghitung total penjualan (misal berdasarkan total harga transaksi)
        $totalPenjualan = Pembayaran::count();

        // Kirim data ke tampilan
        return view('dashboard.admin', compact(
            'jumlahProduk',
            'jumlahKategori',
            'jumlahPengguna',
            'jumlahTransaksi',
            'totalPenjualan'
        ));
    }

}