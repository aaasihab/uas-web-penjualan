<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use Illuminate\Http\Request;

class KategoriProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kategoris = KategoriProduk::all();
        // Mengirim data kategori ke view index
        return view('kategoriProduk.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kategoriProduk.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'nama' => 'required|max:255|unique:kategori_produk',
                'keterangan' => 'required|string|max:255',
                'status' => 'required|in:aktif,nonaktif',
            ],
            [
                // Pesan kustom untuk field 'nama'
                'nama.required' => 'Nama kategori wajib diisi.',
                'nama.max' => 'Nama kategori tidak boleh lebih dari 255 karakter.',
                'nama.unique' => 'Nama kategori sudah terdaftar. Silakan gunakan nama yang lain.',

                // Pesan kustom untuk field 'keterangan'
                'keterangan.required' => 'Keterangan wajib diisi.',
                'keterangan.string' => 'Keterangan harus berupa teks.',
                'keterangan.max' => 'Keterangan tidak boleh lebih dari 255 karakter.',

                // Pesan kustom untuk field 'status'
                'status.required' => 'Status kategori wajib dipilih.',
                'status.in' => 'Status kategori yang dipilih tidak valid. Pilih antara "aktif" atau "nonaktif".',
            ]
        );

        // Menyimpan data kategori baru ke database
        KategoriProduk::create($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('master.data.kategoriProduk.index')->with('success', 'Kategori berhasil ditambahkan');
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
        $kategori = KategoriProduk::findOrFail($id);
        // Mengembalikan view form untuk mengedit kategori
        return view('kategoriProduk.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $validated = $request->validate([
            'nama' => 'required|string|max:255|unique:kategori_produk,nama,' . $id . ',id_kategori_produk',
            'keterangan' => 'nullable|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
        ], [
            // Pesan kustom untuk field 'nama'
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.string' => 'Nama kategori harus berupa teks.',
            'nama.max' => 'Nama kategori tidak boleh lebih dari 255 karakter.',
            'nama.unique' => 'Nama kategori sudah terdaftar. Silakan gunakan nama yang lain.',

            // Pesan kustom untuk field 'keterangan'
            'keterangan.nullable' => 'Keterangan tidak wajib diisi.',
            'keterangan.string' => 'Keterangan harus berupa teks.',
            'keterangan.max' => 'Keterangan tidak boleh lebih dari 255 karakter.',

            // Pesan kustom untuk field 'status'
            'status.required' => 'Status kategori wajib dipilih.',
            'status.in' => 'Status kategori yang dipilih tidak valid. Pilih antara "aktif" atau "nonaktif".',
        ]);

        // Cari kategori berdasarkan ID
        $kategori = KategoriProduk::findOrFail($id);

        // Update kategori dengan data baru
        $kategori->update($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('master.data.kategoriProduk.index')->with('success', 'Kategori berhasil diperbarui');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Cari kategori berdasarkan ID
        $kategori = KategoriProduk::findOrFail($id);

        // Cek apakah kategori memiliki relasi dengan buku
        if ($kategori->produk()->count() > 0) {
            // Jika ada relasi dengan buku, kembalikan pesan error
            return redirect()->route('master.data.kategoriProduk.index')
                ->with('error', 'Kategori ini tidak bisa dihapus karena memiliki relasi dengan buku');
        }

        // Hapus kategori jika tidak ada relasi dengan buku
        $kategori->delete();

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('master.data.kategoriProduk.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}
