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
        Schema::table('permintaan_mitras', function (Blueprint $table) {
            $table->dropColumn('min_skor_kualitas');
            $table->double('min_skor_kulit')->default(0.5)->after('harga_ajuan_per_kg');
            $table->double('min_skor_bentuk')->default(0.5)->after('min_skor_kulit');
            $table->double('min_skor_tekstur')->default(0.5)->after('min_skor_bentuk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permintaan_mitras', function (Blueprint $table) {
            $table->dropColumn(['min_skor_kulit', 'min_skor_bentuk', 'min_skor_tekstur']);
            $table->double('min_skor_kualitas')->default(0.5);
        });
    }
};
