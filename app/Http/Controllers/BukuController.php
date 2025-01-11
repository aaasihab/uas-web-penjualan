<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Storage;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori')->get();
        $kategoris = Kategori::all();
        return view('buku.index', compact('bukus', 'kategoris'));
    }

    public function create()
    {
        $kategoris = Kategori::where('status', 'aktif')->get();
        return view('buku.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // Validasi judul buku
            'judul' => 'required|unique:buku|max:255',
            // Validasi deskripsi buku
            'deskripsi' => 'required|string|max:255',
            // Validasi nama penulis
            'penulis' => 'required|string|max:255',
            // Validasi nama penerbit
            'penerbit' => 'required|string|max:255',
            // Validasi file cover (wajib diunggah)
            'cover' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            // Validasi status buku
            'status' => 'required|in:aktif,nonaktif',
            // Validasi kategori (kategori_id harus valid)
            'kategori_id' => 'required|exists:kategori,id_kategori',
        ], [
            // Pesan kustom untuk validasi 'judul'
            'judul.required' => 'Kolom judul wajib diisi.',
            'judul.unique' => 'Judul buku ini sudah terdaftar. Silakan gunakan judul lain.',
            'judul.max' => 'Judul buku tidak boleh lebih dari 255 karakter.',

            // Pesan kustom untuk validasi 'deskripsi'
            'deskripsi.required' => 'Kolom deskripsi wajib diisi.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'deskripsi.max' => 'Deskripsi tidak boleh lebih dari 255 karakter.',

            // Pesan kustom untuk validasi 'penulis'
            'penulis.required' => 'Kolom penulis wajib diisi.',
            'penulis.string' => 'Nama penulis harus berupa teks.',
            'penulis.max' => 'Nama penulis tidak boleh lebih dari 255 karakter.',

            // Pesan kustom untuk validasi 'penerbit'
            'penerbit.required' => 'Kolom penerbit wajib diisi.',
            'penerbit.string' => 'Nama penerbit harus berupa teks.',
            'penerbit.max' => 'Nama penerbit tidak boleh lebih dari 255 karakter.',

            // Pesan kustom untuk validasi 'cover'
            'cover.required' => 'File cover wajib diunggah.',
            'cover.image' => 'File cover harus berupa gambar.',
            'cover.mimes' => 'File cover harus memiliki format jpeg, png, jpg, atau gif.',
            'cover.max' => 'Ukuran file cover tidak boleh lebih dari 2MB.',

            // Pesan kustom untuk validasi 'status'
            'status.required' => 'Kolom status wajib dipilih.',
            'status.in' => 'Status yang dipilih tidak valid. Silakan pilih antara "aktif" atau "nonaktif".',

            // Pesan kustom untuk validasi 'kategori_id'
            'kategori_id.required' => 'Kolom kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak ditemukan atau tidak valid.',
        ]);


        // Menyimpan file cover dan mendapatkan path-nya
        $validated['cover'] = $request->file('cover')->store('covers', 'public');

        // Menyimpan data buku baru ke database
        Buku::create($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('master.data.buku.index')->with('success', 'Buku berhasil ditambahkan');
    }


    public function show(string $id)
    {

    }
    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);
        $kategori = Kategori::where('status', 'aktif')->get();
        return view('buku.edit', compact('buku', 'kategori'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'judul' => 'required|unique:buku,judul,' . $id . ',id_buku|max:255',
            'deskripsi' => 'required|string|max:255',
            'penulis' => 'required|string|max:255',
            'penerbit' => 'required|string|max:255',
            'status' => 'required|in:aktif,nonaktif',
            'kategori_id' => 'required|exists:kategori,id_kategori',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validasi cover
        ], [
            // Pesan kustom untuk 'judul'
            'judul.required' => 'Judul buku wajib diisi.',
            'judul.unique' => 'Judul buku sudah terdaftar. Gunakan judul yang berbeda.',
            'judul.max' => 'Judul buku tidak boleh lebih dari 255 karakter.',

            // Pesan kustom untuk 'deskripsi'
            'deskripsi.required' => 'Deskripsi buku wajib diisi.',
            'deskripsi.string' => 'Deskripsi harus berupa teks.',
            'deskripsi.max' => 'Deskripsi tidak boleh lebih dari 255 karakter.',

            // Pesan kustom untuk 'penulis'
            'penulis.required' => 'Nama penulis wajib diisi.',
            'penulis.string' => 'Nama penulis harus berupa teks.',
            'penulis.max' => 'Nama penulis tidak boleh lebih dari 255 karakter.',

            // Pesan kustom untuk 'penerbit'
            'penerbit.required' => 'Nama penerbit wajib diisi.',
            'penerbit.string' => 'Nama penerbit harus berupa teks.',
            'penerbit.max' => 'Nama penerbit tidak boleh lebih dari 255 karakter.',

            // Pesan kustom untuk 'status'
            'status.required' => 'Status buku wajib dipilih.',
            'status.in' => 'Status yang dipilih tidak valid. Pilih antara "aktif" atau "nonaktif".',

            // Pesan kustom untuk 'kategori_id'
            'kategori_id.required' => 'Kategori buku wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',

            // Pesan kustom untuk 'cover'
            'cover.image' => 'File yang diunggah harus berupa gambar.',
            'cover.mimes' => 'Cover harus berformat jpeg, png, jpg, atau gif.',
            'cover.max' => 'Ukuran file cover tidak boleh lebih dari 2MB.',
        ]);


        // Cari buku berdasarkan ID
        $buku = Buku::findOrFail($id);

        if ($buku->peminjaman()->count() > 0 && $request->status == 'aktif') {
            return redirect()->route('master.data.buku.index')->with('error', 'Status buku tidak dapat diubah karena sedang dipinjam.');
        }

        // Jika ada file cover baru, simpan dan hapus yang lama
        if ($request->hasFile('cover')) {
            if ($buku->cover && Storage::disk('public')->exists($buku->cover)) {
                Storage::disk('public')->delete($buku->cover);
            }

            $validated['cover'] = $request->file('cover')->store('covers', 'public');
        } else {
            // Jika tidak ada cover baru, gunakan cover lama
            unset($validated['cover']);
        }

        // Perbarui data buku
        $buku->update($validated);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('master.data.buku.index')->with('success', 'Buku berhasil diperbarui');
    }


    public function destroy(string $id)
    {
        $buku = Buku::findOrFail($id);

        if ($buku->peminjaman()->count() > 0) {
            return redirect()->route('master.data.buku.index')->with('error', 'Buku tidak dapat dihapus karena sedang dipinjam.');
        }

        // Hapus file cover jika ada
        if ($buku->cover && Storage::disk('public')->exists($buku->cover)) {
            Storage::disk('public')->delete($buku->cover);
        }

        $buku->delete();

        return redirect()->route('master.data.buku.index')->with('success', 'Buku berhasil dihapus');
    }
}
