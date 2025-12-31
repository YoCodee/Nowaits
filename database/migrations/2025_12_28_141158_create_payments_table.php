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
        Schema::create('payments', function (Blueprint $table) {
            $table->string('id_payment')->primary();
            $table->string('id_user')->index()->comment('FK -> users.id_user');
            $table->string('id_post')->index()->comment('FK -> posts.id_post');
        
            $table->enum('status', ['DIBAYAR','BELUM_DIBAYAR','PROSES']);
            $table->enum('method', ['TRANSFER','EWALLET','CASH']);
        
            $table->float('subtotal');
            $table->float('admin_fee');
            $table->float('total');
        
            $table->timestamps();
            
            $table->foreign('id_user')->references('id_user')->on('users')->cascadeOnDelete();
            $table->foreign('id_post')->references('id_post')->on('posts')->cascadeOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
