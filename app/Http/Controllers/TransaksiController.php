<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'pelanggan') {
            // Ambil transaksi pelanggan dan urutkan 'belum bayar' lebih dulu
            $transaksi = Transaksi::with('produk')
                ->where('pelanggan_id', $user->id)
                ->whereIn('status', ['belum bayar', 'batal'])
                ->orderByRaw("FIELD(status, 'belum bayar', 'batal')")
                ->get();

            return view('transaksi.pelanggan', compact('transaksi'));
        }

        // Ambil semua transaksi untuk admin dan urutkan 'belum bayar' lebih dulu
        $transaksi = Transaksi::with(['produk', 'user'])
            ->whereIn('status', ['belum bayar', 'batal'])
            ->orderByRaw("FIELD(status, 'belum bayar', 'batal')")
            ->get();

        return view('transaksi.admin', compact('transaksi'));
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create($produkId)
    {
        $produks = Produk::findOrFail($produkId);

        if (!$produks || $produks->status != 'aktif') {
            return redirect()->route('dashboard')->with('error', 'Produk tidak tersedia untuk dipinjam.');
        }

        return view('transaksi.create', compact('produks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $produkId)
    {
        $validated = $request->validate([
            'jumlah' => 'required|integer|min:1',
        ], [
            'jumlah.required' => 'Jumlah produk wajib diisi.',
            'jumlah.integer' => 'Jumlah harus berupa angka.',
            'jumlah.min' => 'Jumlah minimal 1.',
        ]);

        $produk = Produk::findOrFail($produkId);

        if (!$produk || $produk->status != 'aktif') {
            return redirect()->route('dashboard')->with('error', 'Produk tidak tersedia untuk dipinjam.');
        }
        if ($produk->stok < $validated['jumlah']) {
            return redirect()->route('dashboard')->with('error', 'Stok produk tidak mencukupi.');
        }

        $totalHarga = $produk->harga * $validated['jumlah'];

        Transaksi::create([
            'pelanggan_id' => auth()->id(),
            'produk_id' => $produk->id_produk,
            'tanggal_transaksi' => now(),
            'jumlah' => $validated['jumlah'],
            'total_harga' => $totalHarga,
        ]);

        $produk->decrement('stok', $validated['jumlah']);
        if ($produk->stok == 0) {
            $produk->update(['status' => 'nonaktif']);
        }

        return redirect()->route('dashboard')->with('success', 'Berhasil dimasukkan ke keranjang!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idTransaksi)
    {

        // Menemukan transaksi beserta produk yang terkait
        $transaksi = Transaksi::with('produk')->findOrFail($idTransaksi);

        if (!$transaksi->produk) {
            return redirect()->route('dashboard')->with('error', 'Data produk tidak ditemukan.');
        }

        // Mengubah status transaksi menjadi 'bayar'
        $transaksi->update(['status' => 'bayar']);

        // Menambahkan data pembayaran ke tabel pembayaran
        Pembayaran::create([
            'transaksi_id' => $transaksi->id_transaksi,
            'total_pembayaran' => $transaksi->total_harga,
            'waktu_pembayaran' => now(), // Waktu pembayaran adalah waktu saat ini
        ]);

        // Redirect kembali dengan pesan sukses
        return redirect()->route('master.data.transaksi.index')->with('success', 'Transaksi berhasil dibayar dan data pembayaran telah dicatat.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idTransaksi)
    {
        // Menemukan transaksi beserta produk yang terkait
        $transaksi = Transaksi::with('produk')->findOrFail($idTransaksi);

        // Mengecek jika produk ada atau tidak
        if (!$transaksi->produk) {
            return redirect()->route('dashboard')->with('error', 'Data produk tidak ditemukan.');
        }

        // Mendapatkan produk terkait dengan transaksi
        $produk = Produk::findOrFail($transaksi->produk_id);

        // Mengembalikan stok produk yang dibatalkan
        $produk->increment('stok', $transaksi->jumlah);

        // Mengubah status transaksi menjadi 'batal'
        $transaksi->update(['status' => 'batal']);

        // Mengarahkan kembali dengan pesan sukses
        return redirect()->route('master.data.transaksi.index')->with('success', 'Transaksi berhasil dibatalkan.');
    }


}
