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
            $table->bigInteger('transaksi_id')->unsigned();
            $table->decimal('total_pembayaran', 10, 2);
            $table->timestamp('waktu_pembayaran');
            $table->timestamps();

            // Tambahkan foreign key
            $table->foreign('transaksi_id')
                ->references('id_transaksi')
                ->on('transaksi')
                ->onDelete('no action')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('pembayaran');
    }
};
