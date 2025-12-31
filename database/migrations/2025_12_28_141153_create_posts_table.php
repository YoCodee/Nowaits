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
        Schema::create('posts', function (Blueprint $table) {
            $table->string('id_post')->primary();
            $table->string('id_fruit')->index()->comment('FK -> fruits.id_fruit');
            $table->string('id_user')->index()->comment('FK -> users.id_user');
        
            $table->enum('type', ['JUAL', 'CARI']);
            $table->string('title');
        
            $table->float('price_per_kg');
            $table->integer('stock_kg');
        
            $table->timestamps();
            
            $table->foreign('id_fruit')->references('id_fruit')->on('fruits')->cascadeOnDelete();
            $table->foreign('id_user')->references('id_user')->on('users')->cascadeOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
