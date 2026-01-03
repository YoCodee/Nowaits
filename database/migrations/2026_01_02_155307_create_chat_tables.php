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
        // Tabel Percakapan (Room)
        Schema::create('conversations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            // Siapa user 1 dan user 2
            $table->char('user_one_id', 36);
            $table->char('user_two_id', 36);
            // Tambahkan ini agar chat terpisah per produk
            $table->char('id_posting', 36);
            
            $table->timestamps();

            // Relasi ke tabel users (id_pengguna)
            $table->foreign('user_one_id')->references('id_pengguna')->on('users')->onDelete('cascade');
            $table->foreign('user_two_id')->references('id_pengguna')->on('users')->onDelete('cascade');
            $table->foreign('id_posting')->references('id_posting')->on('postingans')->onDelete('cascade');
        });

        // Tabel Pesan
        Schema::create('messages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('conversation_id');
            $table->char('sender_id', 36); // Pengirim
            $table->text('body'); // Isi Pesan
            $table->boolean('is_read')->default(false);
            $table->timestamps();

            $table->foreign('conversation_id')->references('id')->on('conversations')->onDelete('cascade');
            $table->foreign('sender_id')->references('id_pengguna')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_tables');
    }
};
