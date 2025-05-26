<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaksi;
use Carbon\Carbon;

class TransaksiSeeder extends Seeder
{
    public function run()
    {
        Transaksi::insert([
            [
                'pelanggan_id' => 1, // pastikan user dengan id 1 ada
                'produk_id' => 1,
                'tanggal_transaksi' => Carbon::now()->subDays(3),
                'jumlah' => 2,
                'total_harga' => 9000000, // harga produk * jumlah
                'status' => 'selesai',
                'created_at' => Carbon::now()->subDays(3),
                'updated_at' => Carbon::now()->subDays(3),
            ],
            [
                'pelanggan_id' => 2,
                'produk_id' => 2,
                'tanggal_transaksi' => Carbon::now()->subDays(1),
                'jumlah' => 5,
                'total_harga' => 375000,
                'status' => 'pending',
                'created_at' => Carbon::now()->subDays(1),
                'updated_at' => Carbon::now()->subDays(1),
            ],
            [
                'pelanggan_id' => 1,
                'produk_id' => 3,
                'tanggal_transaksi' => Carbon::now(),
                'jumlah' => 10,
                'total_harga' => 150000,
                'status' => 'selesai',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
