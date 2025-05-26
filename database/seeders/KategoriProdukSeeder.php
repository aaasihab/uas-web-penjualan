<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriProduk;

class KategoriProdukSeeder extends Seeder
{
    public function run()
    {
        KategoriProduk::insert([
            [
                'nama' => 'Elektronik',
                'keterangan' => 'Produk elektronik seperti TV, radio, dan lain-lain',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Pakaian',
                'keterangan' => 'Berbagai jenis pakaian pria dan wanita',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Makanan',
                'keterangan' => 'Produk makanan dan minuman',
                'status' => 'aktif',
            ],
            [
                'nama' => 'Peralatan Rumah Tangga',
                'keterangan' => 'Peralatan dan perlengkapan rumah tangga',
                'status' => 'nonaktif',
            ],
        ]);
    }
}
