<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Jika pengguna memiliki peran admin
        if ($user->role === 'pengguna') {

            // Jika pengguna adalah user biasa
            // Ambil data peminjaman hanya untuk pengguna yang sedang login
            $peminjaman = Peminjaman::with('buku')
                ->where('user_id', $user->id)
                ->get();

            // Tampilkan view untuk user dengan data peminjaman miliknya
            return view('peminjaman.user', compact('peminjaman'));
        }
        // Ambil semua data peminjaman beserta relasinya
        $peminjaman = Peminjaman::with(['buku', 'user'])->get();

        // Tampilkan view untuk admin dengan semua data peminjaman
        return view('peminjaman.admin', compact('peminjaman'));
    }

    public function create($bukuId)
    {
        $buku = Buku::findOrFail($bukuId);

        if (!$buku || $buku->status != 'aktif') {
            // Buku tidak ditemukan atau statusnya bukan 'aktif'
            return redirect()->route('dashboard')->with('error', 'Buku tidak tersedia untuk dipinjam.');
        }

        return view('peminjaman.create', compact('buku'));
    }

    public function store(Request $request, string $bukuId)
    {
        $validated = $request->validate(
            [
                'tanggal_pinjam' => 'required|date|after_or_equal:today',
                'tanggal_kembali' => [
                    'required',
                    'date',
                    'after:' . $request->tanggal_pinjam, // Validasi tanggal_kembali harus setelah tanggal_pinjam
                ],
            ],
            [
                // Pesan kustom untuk validasi
                'tanggal_pinjam.required' => 'Tanggal pinjam wajib diisi.',
                'tanggal_pinjam.date' => 'Tanggal pinjam harus berupa format tanggal yang valid.',
                'tanggal_pinjam.after_or_equal' => 'Tanggal pinjam tidak boleh sebelum hari ini.',
                'tanggal_kembali.required' => 'Tanggal kembali wajib diisi.',
                'tanggal_kembali.date' => 'Tanggal kembali harus berupa format tanggal yang valid.',
                'tanggal_kembali.after' => 'Tanggal kembali harus setelah tanggal pinjam.',
            ]
        );

        // Validasi tambahan (opsional, jika diperlukan untuk logika tambahan)
        if (strtotime($validated['tanggal_kembali']) <= strtotime($validated['tanggal_pinjam'])) {
            return redirect()->route('dashboard')->with('error', 'Tanggal kembali harus setelah tanggal pinjam.');
        }

        $buku = Buku::findOrFail($bukuId);

        if (!$buku) {
            return redirect()->route('dashboard')->with('error', 'Data buku atau pengguna tidak valid.');
        }


        // Periksa apakah buku sudah tidak aktif
        if ($buku->status === 'tidak aktif') {
            return redirect()->route('dashboard')->with('error', 'Buku ini sedang tidak tersedia untuk dipinjam.');
        }

        // Simpan data peminjaman
        Peminjaman::create([
            'user_id' => auth()->id(),
            'buku_id' => $buku->id_buku,
            'tanggal_pinjam' => $validated['tanggal_pinjam'],
            'tanggal_kembali' => $validated['tanggal_kembali'],
        ]);

        // Perbarui status buku menjadi tidak aktif
        $buku->update(['status' => 'tidak aktif']);

        // Redirect dengan pesan sukses
        return redirect()->route('dashboard')->with('success', 'Peminjaman buku berhasil dilakukan!');

    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idPeminjaman)
    {
        // Cari data peminjaman berdasarkan ID
        $peminjaman = Peminjaman::with('buku')->findOrFail($idPeminjaman);

        // Pastikan buku terkait ditemukan
        if (!$peminjaman->buku) {
            return redirect()->route('dashboard')->with('error', 'Data buku tidak ditemukan.');
        }

        // Periksa apakah status buku saat ini sudah aktif
        if ($peminjaman->buku->status === 'aktif') {
            return redirect()->route('dashboard')->with('error', 'Buku ini sudah dikembalikan.');
        }

        // Perbarui status buku menjadi aktif
        $peminjaman->buku->update(['status' => 'aktif']);

        // Hapus data peminjaman atau ubah statusnya jika perlu
        // Misalnya, jika data peminjaman tetap disimpan untuk riwayat, tambahkan kolom `status` ke tabel peminjaman.
        $peminjaman->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('master.data.peminjaman.index')->with('success', 'Buku berhasil dikembalikan!');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
