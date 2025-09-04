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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->string('destination');
            $table->string('trip_date');
            $table->string('main_image')->nullable();
            $table->json('images'); // Array of image URLs
            $table->string('category')->default('trip'); // trip, destination, activity, etc.
            $table->json('tags')->nullable();
            $table->integer('participants_count')->nullable();
            $table->text('trip_highlights')->nullable();
            $table->string('photographer')->nullable();
            $table->string('alt_text')->nullable();
            $table->string('caption')->nullable();
            $table->string('status')->default('active')->nullable();
            $table->boolean('featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->string('location')->nullable();
            $table->date('date_taken')->nullable();
            $table->boolean('is_public')->default(true);
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
