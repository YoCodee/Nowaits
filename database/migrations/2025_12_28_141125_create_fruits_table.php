<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("fruits", function (Blueprint $table) {
            $table->string('id_fruit')->primary();
            $table->string("id_user")->index()->comment('FK -> users.id_user');

            $table->string("name");

            $table->enum("grade", ["A", "B", "C", "REJECT"])->default("C");

            $table->float("harga_awal_petani");
            $table->float("harga_pasar")->nullable();

            $table
                ->enum("status_kelayakan", ["LAYAK", "TIDAK_LAYAK"])
                ->default("LAYAK");

            $table->timestamps();
            
            $table->foreign('id_user')->references('id_user')->on('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("fruits");
    }
};
