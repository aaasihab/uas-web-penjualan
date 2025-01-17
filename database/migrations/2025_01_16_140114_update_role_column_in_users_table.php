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
        Schema::table('users', function (Blueprint $table) {
            // Drop enum column terlebih dahulu
            $table->dropColumn('role');
        });

        // Menambahkan kembali kolom dengan enum yang baru
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['admin', 'pelanggan'])->after('password');
        });
    }

    public function down()
    {
        // Mengembalikan perubahan jika rollback dilakukan
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });

        // Menambahkan kembali kolom dengan enum yang lama
        Schema::table('users', function (Blueprint $table) {
            $table->enum('role', ['super_admin', 'admin', 'pengguna'])->after('password');
        });
    }
};
