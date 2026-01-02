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
        Schema::create('buahs', function (Blueprint $table) {
            $table->uuid('id_buah')->primary();
            $table->foreignUuid('id_pengguna')->constrained('users', 'id_pengguna')->onDelete('cascade');
            $table->string('nama_buah');
            $table->decimal('harga_awal', 15, 2);
            $table->decimal('harga_akhir', 15, 2)->nullable();
            $table->string('gambar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buahs');
    }
};
