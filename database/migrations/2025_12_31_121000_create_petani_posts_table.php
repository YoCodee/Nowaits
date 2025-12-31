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
        Schema::create('petani_posts', function (Blueprint $table) {
            // Primary key as string to allow custom identifiers
            $table->string('id_penawaran')->primary()->comment('Primary key (string)');

            // FK columns as string to match referenced PK types
            $table->string('id_post')->index()->comment('FK -> posts.id_post (string)');
            $table->string('id_fruit')->index()->comment('FK -> fruits.id_fruit (string)');

            // Harga yang diajukan oleh petani
            $table->float('harga_ajuan')->comment('Harga yang diajukan');

            // Status tawaran: Menunggu / Diterima / Ditolak
            $table->enum('status_tawaran', ['MENUNGGU', 'DITERIMA', 'DITOLAK'])
                  ->default('MENUNGGU')
                  ->comment('Status tawaran: MENUNGGU, DITERIMA, DITOLAK');

            $table->timestamps();

            // Foreign key constraints (types must match the referenced columns)
            $table->foreign('id_post')->references('id_post')->on('posts')->cascadeOnDelete();
            $table->foreign('id_fruit')->references('id_fruit')->on('fruits')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petani_posts');
    }
};
