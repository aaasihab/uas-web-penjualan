<?php

namespace App\Http\Controllers;

use App\Models\KategoriProduk;
use App\Models\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produks = Produk::with('kategoriProduk')->get();
        $kategoris = KategoriProduk::all();
        return view('produk.index', compact('produks', 'kategoris'));
    }

    public function create()
    {
        $kategoris = KategoriProduk::where('status', 'aktif')->get();
        return view('produk.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|unique:produk|max:255',
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:aktif,nonaktif',
            'kategori_produk_id' => 'required|exists:kategori_produk,id_kategori_produk',
        ], [
            'nama.required' => 'Nama produk wajib diisi.',
            'nama.unique' => 'Nama produk sudah terdaftar.',
            'nama.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',
            'deskripsi.required' => 'Deskripsi produk wajib diisi.',
            'harga.required' => 'Harga produk wajib diisi.',
            'stok.required' => 'Stok produk wajib diisi.',
            'gambar.required' => 'Gambar produk wajib diunggah.',
            'gambar.image' => 'File harus berupa gambar.',
            'kategori_produk_id.required' => 'Kategori produk wajib dipilih.',
            'status.required' => 'Status produk wajib dipilih.',
            'status.in' => 'Status produk harus bernilai "aktif" atau "nonaktif".',
        ]);


        $validated['gambar'] = $request->file('gambar')->store('gambar_produk', 'public');

        Produk::create($validated);

        return redirect()->route('master.data.produk.index')->with('success', 'Produk berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $produk = Produk::findOrFail($id);
        $kategoris = KategoriProduk::where('status', 'aktif')->get();
        return view('produk.edit', compact('produk', 'kategoris'));
    }

    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'nama' => 'required|unique:produk,nama,' . $id . ',id_produk|max:255',
            'deskripsi' => 'required|string|max:255',
            'harga' => 'required|numeric|min:0',
            'stok' => 'required|integer|min:0',
            'status' => [
                'required',
                'in:aktif,nonaktif',
                function ($attribute, $value, $fail) use ($request) {
                    // Validasi untuk memastikan status hanya bisa "nonaktif" jika stok adalah 0
                    if ($request->stok == 0 && $value == 'aktif') {
                        $fail('Status produk tidak bisa aktif jika stok 0.');
                    }
                }
            ],
            'kategori_produk_id' => 'required|exists:kategori_produk,id_kategori_produk',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'nama.required' => 'Nama produk wajib diisi.',
            'nama.unique' => 'Nama produk sudah terdaftar.',
            'nama.max' => 'Nama produk tidak boleh lebih dari 255 karakter.',
            'deskripsi.required' => 'Deskripsi produk wajib diisi.',
            'harga.required' => 'Harga produk wajib diisi.',
            'stok.required' => 'Stok produk wajib diisi.',
            'stok.integer' => 'Stok produk harus berupa angka.',
            'stok.min' => 'Stok produk tidak boleh kurang dari 0.',
            'gambar.required' => 'Gambar produk wajib diunggah.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Gambar produk harus berformat jpeg, png, jpg, atau gif.',
            'gambar.max' => 'Gambar produk tidak boleh lebih dari 2MB.',
            'kategori_produk_id.required' => 'Kategori produk wajib dipilih.',
            'kategori_produk_id.exists' => 'Kategori produk yang dipilih tidak valid.',
        ]);


        $produk = Produk::findOrFail($id);

        // Menambahkan kondisi untuk mengubah status jika stok 0
        if ($request->stok == 0) {
            $validated['status'] = 'nonaktif'; // Status menjadi nonaktif jika stok 0
        }

        if ($request->hasFile('gambar')) {
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('gambar_produk', 'public');
        } else {
            unset($validated['gambar']);
        }

        $produk->update($validated);

        return redirect()->route('master.data.produk.index')->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->transaksi()->count() > 0) {
            return redirect()->route('master.data.produk.index')->with('error', 'Produk tidak dapat dihapus karena terdapat di daftar transaksi.');
        }

        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()->route('master.data.produk.index')->with('success', 'Produk berhasil dihapus');
    }
}
