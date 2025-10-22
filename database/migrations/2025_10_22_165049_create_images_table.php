<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funeral_home_id')->constrained()->onDelete('cascade');
            $table->string('original_url');
            $table->string('local_path')->nullable();
            $table->string('filename')->nullable();
            $table->string('mime_type')->nullable();
            $table->integer('file_size')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->string('category')->nullable();
            $table->boolean('is_downloaded')->default(false);
            $table->timestamp('downloaded_at')->nullable();
            $table->timestamps();
            
            $table->index(['funeral_home_id', 'category']);
            $table->index('is_downloaded');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
