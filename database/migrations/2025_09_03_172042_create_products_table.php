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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->text('short_description')->nullable();
            $table->enum('type', ['international', 'domestic']);
            $table->string('destination');
            $table->string('country')->nullable();
            $table->decimal('price', 12, 2);
            $table->decimal('original_price', 12, 2)->nullable();
            $table->integer('duration_days');
            $table->integer('duration_nights');
            $table->string('main_image');
            $table->json('gallery_images')->nullable();
            $table->json('itinerary')->nullable();
            $table->json('includes')->nullable();
            $table->json('excludes')->nullable();
            $table->text('terms_conditions')->nullable();
            $table->integer('max_participants')->default(0);
            $table->integer('min_participants')->default(1);
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('difficulty_level')->nullable();
            $table->decimal('rating', 3, 2)->default(0);
            $table->integer('total_reviews')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
