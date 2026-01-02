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
        Schema::create('penawarans', function (Blueprint $table) {
            $table->uuid('id_penawaran')->primary();
            $table->foreignUuid('id_permintaan')->constrained('permintaan_mitras', 'id_permintaan')->onDelete('cascade');
            $table->foreignUuid('id_petani')->constrained('users', 'id_pengguna')->onDelete('cascade');
            $table->foreignUuid('id_buah')->constrained('buahs', 'id_buah')->onDelete('cascade');
            $table->decimal('harga_tawaran', 12, 2);
            $table->text('pesan')->nullable();
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penawarans');
    }
};
