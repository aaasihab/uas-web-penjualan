<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserAdminSeeder::class, // pastikan UserAdminSeeder sudah dibuat
            KategoriProdukSeeder::class,
            ProdukSeeder::class,
            TransaksiSeeder::class,
            PembayaranSeeder::class,
        ]);
    }
}
