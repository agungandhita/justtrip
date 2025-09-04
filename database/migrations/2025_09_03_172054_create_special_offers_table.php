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
            $table->string('title');
            $table->text('description');
            $table->string('offer_type'); // flash_sale, early_bird, group_discount, etc.
            $table->decimal('original_price', 12, 2);
            $table->decimal('discounted_price', 12, 2);
            $table->integer('discount_percentage')->nullable();
            $table->string('destination');
            $table->string('main_image');
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
