<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['funeral_home_id']);
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['funeral_home_id']);
        });

        Schema::table('opening_hours', function (Blueprint $table) {
            $table->dropForeign(['funeral_home_id']);
        });

        Schema::table('people_also_search', function (Blueprint $table) {
            $table->dropForeign(['funeral_home_id']);
        });

        Schema::table('funeral_home_categories', function (Blueprint $table) {
            $table->dropForeign(['funeral_home_id']);
        });

        Schema::rename('funeral_homes', 'entities');

        Schema::rename('funeral_home_categories', 'category_entity');

        Schema::table('images', function (Blueprint $table) {
            $table->renameColumn('funeral_home_id', 'entity_id');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->renameColumn('funeral_home_id', 'entity_id');
        });

        Schema::table('opening_hours', function (Blueprint $table) {
            $table->renameColumn('funeral_home_id', 'entity_id');
        });

        Schema::table('people_also_search', function (Blueprint $table) {
            $table->renameColumn('funeral_home_id', 'entity_id');
        });

        Schema::table('category_entity', function (Blueprint $table) {
            $table->renameColumn('funeral_home_id', 'entity_id');
        });

        Schema::table('images', function (Blueprint $table) {
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
        });

        Schema::table('opening_hours', function (Blueprint $table) {
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
        });

        Schema::table('people_also_search', function (Blueprint $table) {
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
        });

        Schema::table('category_entity', function (Blueprint $table) {
            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropForeign(['entity_id']);
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['entity_id']);
        });

        Schema::table('opening_hours', function (Blueprint $table) {
            $table->dropForeign(['entity_id']);
        });

        Schema::table('people_also_search', function (Blueprint $table) {
            $table->dropForeign(['entity_id']);
        });

        Schema::table('category_entity', function (Blueprint $table) {
            $table->dropForeign(['entity_id']);
        });

        Schema::table('images', function (Blueprint $table) {
            $table->renameColumn('entity_id', 'funeral_home_id');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->renameColumn('entity_id', 'funeral_home_id');
        });

        Schema::table('opening_hours', function (Blueprint $table) {
            $table->renameColumn('entity_id', 'funeral_home_id');
        });

        Schema::table('people_also_search', function (Blueprint $table) {
            $table->renameColumn('entity_id', 'funeral_home_id');
        });

        Schema::table('category_entity', function (Blueprint $table) {
            $table->renameColumn('entity_id', 'funeral_home_id');
        });

        Schema::rename('entities', 'funeral_homes');

        Schema::rename('category_entity', 'funeral_home_categories');

        Schema::table('images', function (Blueprint $table) {
            $table->foreign('funeral_home_id')->references('id')->on('funeral_homes')->onDelete('cascade');
        });

        Schema::table('reviews', function (Blueprint $table) {
            $table->foreign('funeral_home_id')->references('id')->on('funeral_homes')->onDelete('cascade');
        });

        Schema::table('opening_hours', function (Blueprint $table) {
            $table->foreign('funeral_home_id')->references('id')->on('funeral_homes')->onDelete('cascade');
        });

        Schema::table('people_also_search', function (Blueprint $table) {
            $table->foreign('funeral_home_id')->references('id')->on('funeral_homes')->onDelete('cascade');
        });

        Schema::table('category_entity', function (Blueprint $table) {
            $table->foreign('funeral_home_id')->references('id')->on('funeral_homes')->onDelete('cascade');
        });
    }
};
