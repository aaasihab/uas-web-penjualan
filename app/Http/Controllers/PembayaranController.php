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
            // Ambil pembayaran berdasarkan pelanggan yang sedang login dan urutkan berdasarkan waktu dibuat
            $pembayaran = Pembayaran::with('transaksi') // Memuat relasi transaksi
                ->whereHas('transaksi', function ($query) use ($user) {
                    $query->where('pelanggan_id', $user->id); // Menyaring transaksi berdasarkan pelanggan_id
                })
                ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan waktu dibuat, terbaru pertama
                ->get();

            return view('pembayaran.pelanggan', compact('pembayaran'));
        }

        // Jika pengguna adalah admin, ambil semua data pembayaran beserta transaksi dan urutkan berdasarkan waktu dibuat
        $pembayaran = Pembayaran::with('transaksi')
            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan waktu dibuat, terbaru pertama
            ->get();

        // Tampilkan view untuk admin dengan semua data pembayaran
        return view('pembayaran.admin', compact('pembayaran'));
    }



    public function create($idTransaksi)
    {
        $transaksi = Transaksi::findOrFail($idTransaksi);

        // Pastikan transaksi valid dan statusnya belum bayar
        if (!$transaksi || $transaksi->status != 'belum bayar') {
            return redirect()->route('master.data.transaksi.index')->with('error', 'Transaksi tidak valid atau sudah dibayar.');
        }

        // Tampilkan halaman pembayaran dengan data transaksi
        return view('pembayaran.create', compact('transaksi'));
    }

    /**
     * Simpan pembayaran baru.
     */
    public function store(Request $request, $transaksiId)
    {
        $validated = $request->validate([
            'total_pembayaran' => 'required|numeric|min:0',
        ], [
            'total_pembayaran.required' => 'Total pembayaran wajib diisi.',
            'total_pembayaran.numeric' => 'Total pembayaran harus berupa angka.',
            'total_pembayaran.min' => 'Total pembayaran tidak boleh kurang dari 0.',
        ]);

        // Temukan transaksi berdasarkan ID
        $transaksi = Transaksi::findOrFail($transaksiId);

        // Cek apakah total pembayaran kurang dari total harga transaksi
        if ($validated['total_pembayaran'] < $transaksi->total_harga) {
            return redirect()->route('master.data.pembayaran.create', $transaksiId)
                ->with('error', 'Jumlah pembayaran kurang dari total harga transaksi.');
        }

        // Hitung sisa kembalian
        $kembalian = $validated['total_pembayaran'] - $transaksi->total_harga;

        // Buat data pembayaran baru
        Pembayaran::create([
            'transaksi_id' => $transaksi->id_transaksi,
            'total_pembayaran' => $validated['total_pembayaran'],
            'sisa_kembalian' => $kembalian,
            'waktu_pembayaran' => now(),
        ]);

        // Perbarui status transaksi menjadi "bayar"
        $transaksi->update(['status' => 'bayar']);

        // Redirect dengan pesan sukses dan kembalian (jika ada)
        return redirect()->route('master.data.pembayaran.index')->with(
            'success',
            'Pembayaran berhasil disimpan.' . ($kembalian > 0 ? ' Kembalian: Rp ' . number_format($kembalian, 0, ',', '.') : '')
        );
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
