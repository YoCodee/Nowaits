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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id_pengguna')->primary(); // String ID as requested
            $table->string('name');
            $table->string('email')->unique();
            $table->string('sandi');
            $table->enum('peran', ['petani', 'mitra', 'admin'])->default('petani');
            $table->string('no_telepon')->nullable();
            $table->timestamp('tgl_registrasi')->useCurrent();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');

    }
};
