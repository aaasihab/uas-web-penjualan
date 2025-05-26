<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produk;

class ProdukSeeder extends Seeder
{
    public function run()
    {
        Produk::insert([
            [
                'kategori_produk_id' => 1, // pastikan kategori dengan id 1 sudah ada
                'nama' => 'TV Samsung 42 Inch',
                'deskripsi' => 'Televisi LED Samsung dengan layar 42 inch dan resolusi Full HD.',
                'harga' => 4500000,
                'stok' => 10,
                'gambar' => '/public/assets/img/samsung.jpg',
                'status' => 'aktif',
            ],
            [
                'kategori_produk_id' => 2,
                'nama' => 'Kaos Polos Hitam',
                'deskripsi' => 'Kaos polos warna hitam berbahan katun nyaman dipakai.',
                'harga' => 75000,
                'stok' => 50,
                'gambar' => '/public/assets/img/kaos_hitam.jpg',
                'status' => 'aktif',
            ],
            [
                'kategori_produk_id' => 3,
                'nama' => 'Snack Keripik Kentang',
                'deskripsi' => 'Keripik kentang rasa original, gurih dan renyah.',
                'harga' => 15000,
                'stok' => 100,
                'gambar' => '/public/assets/img/kentang.webp',
                'status' => 'aktif',
            ],
            [
                'kategori_produk_id' => 4,
                'nama' => 'Set Alat Masak',
                'deskripsi' => 'Set alat masak lengkap, termasuk panci, wajan, dan spatula.',
                'harga' => 350000,
                'stok' => 5,
                'gambar' => '/public/assets/img/alat_masak.jpg',
                'status' => 'nonaktif',
            ],
        ]);
    }
}
