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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->uuid('id_transaksi')->primary();
            
            // Relasi
            $table->foreignUuid('id_postingan')->constrained('postingans', 'id_posting')->onDelete('cascade');
            $table->foreignUuid('id_pembeli')->constrained('users', 'id_pengguna')->onDelete('cascade');
            $table->foreignUuid('id_penjual')->constrained('users', 'id_pengguna')->onDelete('cascade');
            
            // Produk Info (Snapshot)
            $table->integer('jumlah_kg');
            $table->decimal('harga_per_kg', 15, 2);
            $table->decimal('total_harga_barang', 15, 2);
            
            // Pengiriman Info
            $table->decimal('biaya_ongkir', 15, 2);
            $table->double('jarak_km')->nullable();
            $table->text('alamat_pengiriman_snapshot')->nullable(); // JSON string
            
            // Total
            $table->decimal('total_bayar', 15, 2);
            
            // Status & Pembayaran
            $table->enum('status', [
                'menunggu_pembayaran', 
                'menunggu_konfirmasi', // Petani confirm
                'diproses', // Petani packing
                'dikirim', // Kurir/Petani send
                'selesai', // Mitra terima
                'dibatalkan'
            ])->default('menunggu_pembayaran');
            
            $table->string('bukti_bayar')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
