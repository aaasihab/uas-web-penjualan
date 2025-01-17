<?php

namespace App\Http\Controllers;

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
            $transaksi = Transaksi::with('produk')
                ->where('pelanggan_id', $user->id)
                ->get();

            return view('transaksi.user', compact('transaksi'));
        }

        $transaksi = Transaksi::with(['produk', 'user'])->get();

        return view('transaksi.admin', compact('transaksi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($produkId)
    {
        $produks = Produk::findOrFail($produkId);

        if (!$produks || $produks->status != 'aktif') {
            return redirect()->route('transaksi.create')->with('error', 'Produk tidak tersedia untuk dibeli.');
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
        $transaksi = Transaksi::with('produk')->findOrFail($idTransaksi);

        if (!$transaksi->produk) {
            return redirect()->route('dashboard')->with('error', 'Data produk tidak ditemukan.');
        }

        $transaksi->produk->increment('stok', $transaksi->jumlah);

        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dibatalkan dan stok produk dikembalikan.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $transaksi->delete();

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }
}
