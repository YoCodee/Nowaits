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
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['no_rekening', 'nama_bank']);
        });

        Schema::table('alamat_penggunas', function (Blueprint $table) {
            $table->string('no_rekening')->nullable();
            $table->string('nama_bank')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('alamat_penggunas', function (Blueprint $table) {
            $table->dropColumn(['no_rekening', 'nama_bank']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('no_rekening')->nullable();
            $table->string('nama_bank')->nullable();
        });
    }
};
