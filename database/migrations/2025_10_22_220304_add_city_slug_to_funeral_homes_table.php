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
            $table->string('city_slug')->nullable()->after('city');
            $table->index('city_slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('funeral_homes', function (Blueprint $table) {
            $table->dropIndex(['city_slug']);
            $table->dropColumn('city_slug');
        });
    }
};
