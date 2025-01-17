<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            // Memperbarui kolom 'status' untuk menambahkan 'batal'
            $table->enum('status', ['belum bayar', 'bayar', 'batal'])
                ->default('belum bayar')  // Default masih 'belum bayar'
                ->change();  // Mengubah kolom yang sudah ada
        });
    }

    public function down()
    {
        Schema::table('transaksi', function (Blueprint $table) {
            // Menghapus 'batal' jika rollback
            $table->enum('status', ['belum bayar', 'bayar'])
                ->default('belum bayar')  // Default kembali ke 'belum bayar'
                ->change();  // Mengubah kolom kembali
        });
    }
};
