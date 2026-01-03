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
        // 1. Tabel Posting (Untuk Petani Jualan)
        Schema::create('postingans', function (Blueprint $table) {
            $table->uuid('id_posting')->primary();
            $table->foreignUuid('id_pengguna')->constrained('users', 'id_pengguna')->onDelete('cascade');
            $table->foreignUuid('id_buah')->constrained('buahs', 'id_buah')->onDelete('cascade');
            
            $table->enum('tipe_postingan', ['jual', 'cari'])->default('jual'); // Sesuai request, meski disini mayoritas 'jual'
            $table->string('judul_posting');
            $table->text('keterangan')->nullable();
            
            // Total harga saat posting dibuat (Snapshot harga)
            $table->decimal('total_harga', 15, 2); 
            
            $table->enum('status', ['aktif', 'terjual', 'dibatalkan'])->default('aktif');
            $table->timestamps();
        });

        // 2. Tabel Permintaan Mitra (Untuk Mitra Cari Barang)
        Schema::create('permintaan_mitras', function (Blueprint $table) {
            $table->uuid('id_permintaan')->primary();
            $table->foreignUuid('id_pengguna')->constrained('users', 'id_pengguna')->onDelete('cascade');
            
            $table->string('nama_buah_dicari'); // Generic name, e.g. "Apel Malang"
            $table->integer('jumlah_dicari_kg');
            $table->decimal('harga_ajuan_per_kg', 15, 2);
            
            // Kriteria Minimun
            $table->double('min_skor_kualitas')->default(0.5); // e.g. minimal skor 0.7
            $table->text('deskripsi_tambahan')->nullable();
            
            $table->enum('status_tawaran', ['aktif', 'terpenuhi', 'dibatalkan'])->default('aktif');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan_mitras');
        Schema::dropIfExists('postingans');
    }
};
