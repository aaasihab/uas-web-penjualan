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
        if (!Schema::hasTable('produk')) {
            Schema::create('produk', function (Blueprint $table) {
                $table->id('id_produk'); // Primary key
                $table->string('nama', 150);
                $table->foreignId('kategori_produk_id')->constrained('kategori_produk', 'id_kategori_produk')->onDelete('cascade');
                $table->text('deskripsi')->nullable();
                $table->integer('stok')->default(0);
                $table->decimal('harga', 10, 2);
                $table->timestamps();

                $table->foreign('kategori_produk_id')->references('id_kategori_produk')->on('kategori_produk')
                    ->onDelete('no action')
                    ->onUpdate('no action');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
