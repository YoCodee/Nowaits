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
        Schema::create("fruit_classifications", function (Blueprint $table) {
            $table->string("id_classification")->primary();
            $table->string('id_fruit')->index()->comment('FK -> fruits.id_fruit');

            // Slider-friendly decimal: 0.0 | 0.5 | 1.0
            $table
                ->decimal("kondisi_kulit", 2, 1)
                ->comment(
                    "0=kulit keriput & berlubang, 0.5=salah satu (keriput atau berlubang), 1=sempurna",
                );
            // Ubah menjadi text untuk menyimpan detail mengenai nutrisi saat pertumbuhan buah
            $table
                ->text("bentuk")
                ->nullable()
                ->comment("Detail mengenai nutrisi saat pertumbuhan buah");
            // Massa tetap sebagai float karena mempengaruhi harga
            $table
                ->float("massa")
                ->comment("Massa tidak diubah (mempengaruhi harga)");
            // Slider-friendly decimal: 0.0 | 0.5 | 1.0
            $table
                ->decimal("tekstur", 2, 1)
                ->comment(
                    "0=warna kulit pucat & saat dipegang firm, 0.5=warna kulit tua/gelap & saat dipegang lembek, 1=warna kulit cerah pekat & firm",
                );

            $table->timestamps();
            $table->foreign('id_fruit')->references('id_fruit')->on('fruits')->cascadeOnDelete();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("fruit_classifications");
    }
};
