<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('funeral_home_categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funeral_home_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['funeral_home_id', 'category_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('funeral_home_categories');
    }
};
