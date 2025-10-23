<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('people_also_search', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funeral_home_id')->constrained()->onDelete('cascade');
            $table->string('category');
            $table->string('title');
            $table->integer('reviews_count')->default(0);
            $table->decimal('total_score', 3, 1)->nullable();
            $table->timestamps();

            $table->index(['funeral_home_id', 'title']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('people_also_search');
    }
};
