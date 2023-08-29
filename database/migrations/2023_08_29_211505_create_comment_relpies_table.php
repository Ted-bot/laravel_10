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
        Schema::create('comment_relpies', function (Blueprint $table) {
            $table->id();
            $table->integer('post_id')->index();
            $table->integer('is_active')->default(0);
            $table->string('author');
            $table->string('email');
            $table->text('body');
            $table->timestamps();

            $table->foreign('comment_id')->reference('id')->on('comments')->onDelete('casade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comment_relpies');
    }
};
