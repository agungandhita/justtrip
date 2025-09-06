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
        Schema::create('special_offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('layanan_id');
            $table->foreign('layanan_id')->references('layanan_id')->on('layanan')->onDelete('cascade');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->decimal('original_price', 12, 2);
            $table->decimal('discounted_price', 12, 2);
            $table->decimal('discount_percentage', 5, 2);
            $table->string('main_image')->nullable();
            $table->json('gallery_images')->nullable();
            $table->date('valid_from');
            $table->date('valid_until');
            $table->text('terms_conditions')->nullable();
            $table->integer('max_bookings')->nullable();
            $table->integer('current_bookings')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('badge_text')->nullable(); // Flash Sale, Limited Time, etc.
            $table->string('badge_color')->default('red');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('special_offers');
    }
};
