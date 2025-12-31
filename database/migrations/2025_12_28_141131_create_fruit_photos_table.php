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
        Schema::create('fruit_photos', function (Blueprint $table) {
            $table->string('id_photo')->primary();
            $table->string('id_fruit')->index()->comment('FK -> fruits.id_fruit');
            $table->string('image_path');
            $table->timestamps();
            
            $table->foreign('id_fruit')->references('id_fruit')->on('fruits')->cascadeOnDelete();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fruit_photos');
    }
};
