<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\KategoriProduk;
use App\Models\Produk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategoriProduk')->where('status', 'aktif')->get();;
        return view('dashboard.index', compact('produks'));
    }

}