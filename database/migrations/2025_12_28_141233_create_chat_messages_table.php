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
        Schema::create("chat_messages", function (Blueprint $table) {
            // Auto-incrementing primary key
            $table->id();
            // chat_room id references chat_rooms.id (unsignedBigInteger)
            $table
                ->foreignId("chat_room_id")
                ->constrained("chat_rooms")
                ->cascadeOnDelete();
            // sender_id must match users.id_user which is a string, so store as string and add FK explicitly
            $table
                ->string("sender_id")
                ->index()
                ->comment("FK -> users.id_user (string)");

            $table->text("message");
            $table->boolean("is_read")->default(false);

            $table->timestamps();

            // Foreign key constraint for sender_id (users.id_user is string)
            $table
                ->foreign("sender_id")
                ->references("id_user")
                ->on("users")
                ->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("chat_messages");
    }
};
