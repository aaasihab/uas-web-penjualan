<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pembayaran;
use Carbon\Carbon;

class PembayaranSeeder extends Seeder
{
    public function run()
    {
        Pembayaran::insert([
            [
                'transaksi_id' => 1, // pastikan transaksi dengan id 1 ada
                'total_pembayaran' => 9000000,
                'sisa_kembalian' => 0,
                'waktu_pembayaran' => Carbon::now()->subDays(2),
                'created_at' => Carbon::now()->subDays(2),
                'updated_at' => Carbon::now()->subDays(2),
            ],
            [
                'transaksi_id' => 3,
                'total_pembayaran' => 150000,
                'sisa_kembalian' => 0,
                'waktu_pembayaran' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
