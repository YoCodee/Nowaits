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
        Schema::create('penilaian_buahs', function (Blueprint $table) {
            $table->uuid('id_penilaian')->primary();
            $table->foreignUuid('id_buah')->constrained('buahs', 'id_buah')->onDelete('cascade');
            
            $table->double('skor_kulit')->default(0);
            $table->text('deskripsi_kulit')->nullable();
            
            $table->double('skor_bentuk')->default(0);
            $table->text('deskripsi_bentuk')->nullable();
            
            $table->double('skor_massa')->default(0);
            $table->text('deskripsi_massa')->nullable();
            
            $table->double('skor_tekstur')->default(0);
            $table->text('deskripsi_tekstur')->nullable();
            
            $table->double('total_skor_akhir')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penilaian_buahs');
    }
};
