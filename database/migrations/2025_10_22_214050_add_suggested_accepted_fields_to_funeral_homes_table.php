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
        Schema::table('funeral_homes', function (Blueprint $table) {
            $table->boolean('is_suggested')->default(false);
            $table->boolean('is_accepted')->default(false);
        });
    }

    public function down(): void
    {
        Schema::table('funeral_homes', function (Blueprint $table) {
            $table->dropColumn(['is_suggested', 'is_accepted']);
        });
    }
};
