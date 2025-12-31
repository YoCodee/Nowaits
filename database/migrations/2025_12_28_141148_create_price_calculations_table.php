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
        Schema::create('price_calculations', function (Blueprint $table) {
            $table->string('id_calculation')->primary();
            $table->string('id_fruit')->index()->comment('FK -> fruits.id_fruit');
        
        
            $table->float('harga_awal');
            $table->float('potongan_kualitas');
            $table->float('biaya_admin');
        
            $table->float('harga_jual_petani');
            $table->float('harga_jual_mitra');
        
            $table->timestamps();
            
            $table->foreign('id_fruit')->references('id_fruit')->on('fruits')->cascadeOnDelete();
            
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('price_calculation');
    }
};
