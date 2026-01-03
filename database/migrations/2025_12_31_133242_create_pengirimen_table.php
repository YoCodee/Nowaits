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
        Schema::create('pengirimans', function (Blueprint $table) {
            $table->uuid('id_pengiriman')->primary();
            $table->foreignUuid('id_transaksi')->constrained('transaksis', 'id_transaksi')->onDelete('cascade');
            
            $table->string('ekspedisi'); 
            $table->string('no_resi')->nullable(); 
            $table->string('foto_bukti_kirim')->nullable(); 
            
            $table->text('catatan')->nullable(); 
            $table->timestamp('tgl_dikirim')->useCurrent();
            $table->timestamp('tgl_diterima')->nullable();
            
            $table->enum('status', ['diproses', 'dikirim', 'sampai'])->default('diproses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengirimans');
    }
};
