<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('funeral_homes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('price')->nullable();
            $table->string('category_name')->nullable();
            $table->text('address')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('street')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('state')->nullable();
            $table->string('country_code', 2)->default('PT');
            $table->string('phone')->nullable();
            $table->string('phone_unformatted')->nullable();
            $table->string('website')->nullable();
            $table->text('description')->nullable();
            $table->string('sub_title')->nullable();
            $table->string('located_in')->nullable();
            $table->string('plus_code')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->boolean('permanently_closed')->default(false);
            $table->boolean('temporarily_closed')->default(false);
            $table->boolean('claim_this_business')->default(false);
            $table->string('place_id')->nullable();
            $table->string('fid')->nullable();
            $table->string('cid')->nullable();
            $table->integer('reviews_count')->default(0);
            $table->integer('images_count')->default(0);
            $table->decimal('total_score', 3, 1)->nullable();
            $table->string('image_url')->nullable();
            $table->string('kgmid')->nullable();
            $table->string('url')->nullable();
            $table->string('search_page_url')->nullable();
            $table->string('search_string')->nullable();
            $table->string('language', 5)->default('pt-PT');
            $table->integer('rank')->nullable();
            $table->boolean('is_advertisement')->default(false);
            $table->timestamp('scraped_at')->nullable();
            $table->timestamps();
            
            $table->index(['city', 'country_code']);
            $table->index('place_id');
            $table->index('total_score');
            $table->index('reviews_count');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('funeral_homes');
    }
};
