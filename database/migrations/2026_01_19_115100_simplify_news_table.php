<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Simplify news table by removing unnecessary fields
     */
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            // Drop unused columns for better performance
            $table->dropColumn([
                'excerpt',
                'gallery_images',
                'tags',
                'author_image',
                'author_bio',
                'read_time',
                'is_published',
                'meta_title',
                'meta_description'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            // Re-add columns if needed to rollback
            $table->text('excerpt')->after('slug');
            $table->json('gallery_images')->nullable()->after('featured_image');
            $table->json('tags')->nullable()->after('category');
            $table->string('author_image')->nullable()->after('author_name');
            $table->string('author_bio')->nullable()->after('author_image');
            $table->integer('read_time')->default(5)->after('author_bio');
            $table->boolean('is_published')->default(false)->after('is_featured');
            $table->string('meta_title')->nullable()->after('published_at');
            $table->text('meta_description')->nullable()->after('meta_title');
        });
    }
};
