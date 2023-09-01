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
            // $table->integer('post_id');
            $table->foreignId('post_id')->constraint()->onDelete('cascade');
            $table->integer('is_active')->default(0);
            $table->string('author');
            $table->string('photo')->nullable;
            $table->string('email');
            $table->text('body');
            $table->timestamps();

            // $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
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
