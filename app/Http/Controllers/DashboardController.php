<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // $bukus = Buku::with('kategori')->where('status', 'aktif')->get();
        $bukus = Buku::with('kategori')->get();
        $kategoris = Kategori::all();
        return view('dashboard.index', compact('bukus', 'kategoris'));
    }

    // public function createPeminjaman(Request $request, string $bukuId, string $userId)
    // {
    //     $validated = $request->validate(
    //         [
    //             'tanggal_pinjam' => 'required|date|after_or_equal:today',
    //             'tanggal_kembali' => [
    //                 'required',
    //                 'date',
    //                 'after:' . $request->tanggal_pinjam, // Validasi tanggal_kembali harus setelah tanggal_pinjam
    //             ],
    //         ],
    //         [
    //             // Pesan kustom untuk validasi
    //             'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi.',
    //             'tanggal_pinjam.date' => 'Tanggal pinjam harus berupa format tanggal yang valid.',
    //             'tanggal_pinjam.after_or_equal' => 'Tanggal pinjam tidak boleh sebelum hari ini.',
    //             'tanggal_kembali.required' => 'Tanggal kembali wajib diisi.',
    //             'tanggal_kembali.date' => 'Tanggal kembali harus berupa format tanggal yang valid.',
    //             'tanggal_kembali.after' => 'Tanggal kembali harus setelah tanggal pinjam.',
    //         ]
    //     );

    //     // Validasi tambahan (opsional, jika diperlukan untuk logika tambahan)
    //     if (strtotime($validated['tanggal_kembali']) <= strtotime($validated['tanggal_pinjam'])) {
    //         return redirect()->route('dashboard')->with('error', 'Tanggal kembali harus setelah tanggal pinjam.');
    //     }

    //     // Pastikan buku dan pengguna valid
    //     $user = User::findOrFail($userId);
    //     // $buku = $user->buku()->where('id_buku', $bukuId)->firstOrFail();
    //     $buku = Buku::findOrFail($bukuId);

    //     if (!$user || !$buku) {
    //         return redirect()->route('dashboard')->with('error', 'Data buku atau pengguna tidak valid.');
    //     }


    //     // Periksa apakah buku sudah tidak aktif
    //     if ($buku->status === 'tidak aktif') {
    //         return redirect()->route('dashboard')->with('error', 'Buku ini sedang tidak tersedia untuk dipinjam.');
    //     }

    //     // Simpan data peminjaman
    //     Peminjaman::create([
    //         'user_id' => $user->id,
    //         'buku_id' => $buku->id_buku,
    //         'tanggal_pinjam' => $validated['tanggal_pinjam'],
    //         'tanggal_kembali' => $validated['tanggal_kembali'],
    //     ]);

    //     // Perbarui status buku menjadi tidak aktif
    //     $buku->update(['status' => 'tidak aktif']);

    //     // Redirect dengan pesan sukses
    //     return redirect()->route('dashboard')->with('success', 'Peminjaman berhasil ditambahkan!');

    // }

}
