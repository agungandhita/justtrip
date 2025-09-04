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
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('excerpt');
            $table->longText('content');
            $table->string('featured_image');
            $table->json('gallery_images')->nullable();
            $table->string('category'); // destinasi, tips, guide, etc.
            $table->json('tags')->nullable();
            $table->string('author_name');
            $table->string('author_image')->nullable();
            $table->string('author_bio')->nullable();
            $table->integer('read_time')->default(5); // in minutes
            $table->integer('views')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_published')->default(false);
            $table->enum('status', ['draft', 'published'])->default('draft');
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('news');
    }
};
