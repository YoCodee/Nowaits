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
        Schema::create("chat_rooms", function (Blueprint $table) {
            // auto-increment id
            $table->id();

            // Use string IDs to match users.id_user (which is string)
            $table
                ->string("petani_id")
                ->index()
                ->comment("FK -> users.id_user (petani)");
            $table
                ->string("mitra_id")
                ->index()
                ->comment("FK -> users.id_user (mitra)");

            // Optional link to a post; posts.id_post is string per users table pattern
            $table
                ->string("post_id")
                ->nullable()
                ->index()
                ->comment("FK -> posts.id_post (nullable)");

            $table->timestamps();

            // Foreign key constraints (types must match referenced PKs)
            $table
                ->foreign("petani_id")
                ->references("id_user")
                ->on("users")
                ->cascadeOnDelete();
            $table
                ->foreign("mitra_id")
                ->references("id_user")
                ->on("users")
                ->cascadeOnDelete();
            // If a post is deleted, keep the chat but nullify the relation
            $table
                ->foreign("post_id")
                ->references("id_post")
                ->on("posts")
                ->nullOnDelete();

            // Ensure a single chat room per petani+mitra+post combination
            $table->unique(
                ["petani_id", "mitra_id", "post_id"],
                "chat_unique_participants_post",
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("chat_rooms");
    }
};
