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
        // Check and modify the news table to ensure all columns exist
        Schema::table('news', function (Blueprint $table) {
            // Make sure all required columns exist and have the right types
            if (!Schema::hasColumn('news', 'title')) {
                $table->string('title');
            }
            
            if (!Schema::hasColumn('news', 'slug')) {
                $table->string('slug')->unique();
            }
            
            if (!Schema::hasColumn('news', 'content')) {
                $table->longText('content')->nullable();
            }
            
            if (!Schema::hasColumn('news', 'featured_image')) {
                $table->string('featured_image')->nullable();
            }
            
            if (!Schema::hasColumn('news', 'category')) {
                $table->string('category')->nullable();
            }
            
            if (!Schema::hasColumn('news', 'author_name')) {
                $table->string('author_name')->nullable();
            }
            
            if (!Schema::hasColumn('news', 'views')) {
                $table->integer('views')->default(0);
            }
            
            if (!Schema::hasColumn('news', 'is_featured')) {
                $table->boolean('is_featured')->default(false);
            }
            
            if (!Schema::hasColumn('news', 'status')) {
                $table->string('status')->default('draft');
            }
            
            if (!Schema::hasColumn('news', 'published_at')) {
                $table->timestamp('published_at')->nullable();
            }
        });
        
        // Make content nullable if it exists but is not nullable
        if (Schema::hasColumn('news', 'content')) {
            Schema::table('news', function (Blueprint $table) {
                $table->longText('content')->nullable()->change();
            });
        }
        
        // Make featured_image nullable if it exists but is not nullable
        if (Schema::hasColumn('news', 'featured_image')) {
            Schema::table('news', function (Blueprint $table) {
                $table->string('featured_image')->nullable()->change();
            });
        }
        
        // Make category nullable if it exists but is not nullable
        if (Schema::hasColumn('news', 'category')) {
            Schema::table('news', function (Blueprint $table) {
                $table->string('category')->nullable()->change();
            });
        }
        
        // Make author_name nullable if it exists but is not nullable
        if (Schema::hasColumn('news', 'author_name')) {
            Schema::table('news', function (Blueprint $table) {
                $table->string('author_name')->nullable()->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We don't want to reverse this migration as it's a safety fix
    }
};
