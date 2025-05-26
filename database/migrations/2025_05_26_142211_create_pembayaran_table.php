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
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->foreignId('transaksi_id')
                ->constrained('transaksi', 'id_transaksi')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('total_pembayaran');
            $table->integer('sisa_kembalian')->default(0);
            $table->timestamp('waktu_pembayaran');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};
