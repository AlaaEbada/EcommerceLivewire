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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();  // For the commenter's name
            $table->text('comment')->nullable();  // For the actual comment
            $table->unsignedBigInteger('user_id')->nullable();  // Foreign key to the users table
            $table->unsignedBigInteger('post_id');  // Foreign key to the posts table
            $table->timestamps();

            // Adding foreign key constraints (optional)
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};
