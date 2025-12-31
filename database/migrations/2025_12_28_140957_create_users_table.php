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
            $table->string('id_user')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            $table->enum('role', ['admin', 'petani', 'mitra']);
            $table->string('phone')->nullable();
        
            $table->dateTime('registration_date');
            $table->timestamp('last_login')->nullable();
        
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
