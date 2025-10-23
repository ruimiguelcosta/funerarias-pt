<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funeral_home_id')->constrained()->onDelete('cascade');
            $table->string('author_name')->nullable();
            $table->string('author_photo_url')->nullable();
            $table->integer('rating')->nullable();
            $table->text('text')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->string('review_id')->nullable();
            $table->timestamps();

            $table->index(['funeral_home_id', 'rating']);
            $table->index('published_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
