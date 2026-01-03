<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add 'stok' to 'buahs' table
        Schema::table('buahs', function (Blueprint $table) {
            $table->integer('stok')->default(0)->after('harga_akhir');
        });

        // 2. Remove 'skor_massa' and 'deskripsi_massa' from 'penilaian_buahs' table
        Schema::table('penilaian_buahs', function (Blueprint $table) {
            $table->dropColumn(['skor_massa', 'deskripsi_massa']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('buahs', function (Blueprint $table) {
            $table->dropColumn('stok');
        });

        Schema::table('penilaian_buahs', function (Blueprint $table) {
            $table->double('skor_massa')->default(0);
            $table->text('deskripsi_massa')->nullable();
        });
    }
};
