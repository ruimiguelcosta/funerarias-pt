<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('opening_hours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funeral_home_id')->constrained()->onDelete('cascade');
            $table->string('day');
            $table->string('hours');
            $table->timestamps();

            $table->index(['funeral_home_id', 'day']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('opening_hours');
    }
};
