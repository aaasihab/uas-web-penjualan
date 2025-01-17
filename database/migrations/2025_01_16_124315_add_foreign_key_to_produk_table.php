<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            // Ubah tipe data kolom menjadi INT terlebih dahulu
            $table->integer('kategori_produk_id')->unsigned()->change();
        
            // Tambahkan foreign key
            $table->foreign('kategori_produk_id')
                  ->references('id_kategori_produk')
                  ->on('kategori_produk')
                  ->onDelete('no action')
                  ->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('produk', function (Blueprint $table) {
            // Hapus foreign key
            $table->dropForeign(['kategori_produk_id']);
        });
    }
};
