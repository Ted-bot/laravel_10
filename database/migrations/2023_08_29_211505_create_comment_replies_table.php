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
        Schema::create('comment_replies', function (Blueprint $table) {
            $table->id();
            // $table->integer('comment_id');
            $table->foreignId('comment_id')->constraint()->onDelete('cascade');
            $table->integer('is_active')->default(0);
            $table->string('author');
            $table->string('photo')->nullable;
            $table->string('email');
            $table->text('body');
            $table->timestamps();

            // $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_replies');
    }
};
