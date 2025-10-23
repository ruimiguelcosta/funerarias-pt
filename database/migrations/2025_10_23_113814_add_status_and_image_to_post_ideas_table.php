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
        Schema::table('post_ideas', function (Blueprint $table) {
            $table->enum('status', ['waiting', 'processed'])->default('waiting')->after('category');
            $table->string('image')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_ideas', function (Blueprint $table) {
            $table->dropColumn(['status', 'image']);
        });
    }
};
