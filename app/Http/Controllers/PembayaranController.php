<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Transaksi;
use Auth;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    /**
     * Tampilkan daftar pembayaran.
     */
    public function index()
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();
    
        // Jika pengguna adalah pelanggan
        if ($user->role === 'pelanggan') {
            // Ambil pembayaran berdasarkan pelanggan yang sedang login
            $pembayaran = Pembayaran::with('transaksi') // Memuat relasi transaksi
                ->whereHas('transaksi', function ($query) use ($user) {
                    $query->where('pelanggan_id', $user->id); // Menyaring transaksi berdasarkan pelanggan_id
                })
                ->get();
    
            return view('pembayaran.pelanggan', compact('pembayaran'));
        }
    
        // Jika pengguna adalah admin, ambil semua data pembayaran beserta transaksi
        $pembayaran = Pembayaran::with('transaksi')->get();
    
        // Tampilkan view untuk admin dengan semua data pembayaran
        return view('pembayaran.admin', compact('pembayaran'));
    }
    

    /**
     * Simpan pembayaran baru.
     */
    public function store(Request $request, $transaksiId)
    {
        $request->validate([
            'total_pembayaran' => 'required|numeric|min:0',
            'waktu_pembayaran' => 'required|date',
        ]);

        $transaksi = Transaksi::findOrFail($transaksiId);

        $pembayaran = Pembayaran::create([
            'transaksi_id' => $transaksi->id_transaksi,
            'total_pembayaran' => $request->total_pembayaran,
            'waktu_pembayaran' => $request->waktu_pembayaran,
        ]);

        // Perbarui status transaksi menjadi "bayar"
        $transaksi->update(['status' => 'bayar']);

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil disimpan.');
    }

    /**
     * Hapus pembayaran.
     */
    public function destroy($id)
    {
        $pembayaran = Pembayaran::findOrFail($id);
        $pembayaran->delete();

        return redirect()->route('pembayaran.index')->with('success', 'Pembayaran berhasil dihapus.');
    }
}
