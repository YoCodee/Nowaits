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
        Schema::create('criteria_descriptions', function (Blueprint $table) {
            // Primary key: id_kriteria
            $table->id('id_kriteria');

            // Kategori: enum - examples: Kulit, Bentuk, Dll
            // Stored in uppercase to keep consistency
            $table->enum('category', ['KULIT', 'BENTUK', 'DLL'])
                  ->comment('Kategori kriteria: KULIT, BENTUK, DLL');

            // Pilihan: enum - examples: Mulus, Becak, Dll
            $table->enum('option', ['MULUS', 'BECAK', 'DLL'])
                  ->comment('Pilihan spesifik untuk kategori, mis: MULUS, BECAK, DLL');

            // Deskripsi teks: detail/penjelasan untuk pilihan tersebut
            $table->text('description')->nullable()
                  ->comment('Penjelasan atau deskripsi teks untuk pilihan kriteria');

            // Optional: enforce uniqueness per kategori+pilihan to avoid duplicate entries
            // $table->unique(['kategori', 'pilihan'], 'criteria_kategori_pilihan_unique');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criteria_descriptions');
    }
};
