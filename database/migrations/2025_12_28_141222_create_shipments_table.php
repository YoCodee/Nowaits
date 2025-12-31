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
        Schema::create('shipments', function (Blueprint $table) {
            $table->string('id_shipment')->primary();
            $table->string('id_payment')->index()->comment('FK payments.id_payment');
        
            $table->string('no_resi')->nullable();
            $table->enum('status', ['DIPROSES','DALAM_PERJALANAN','TIBA']);
        
            $table->timestamp('tanggal_kirim')->nullable();
            $table->timestamp('tanggal_tiba')->nullable();
        
            $table->timestamps();
            
            $table->foreign('id_payment')->references('id_payment')->on('payments');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
