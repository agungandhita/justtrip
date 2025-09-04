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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->text('story');
            $table->string('hero_image')->nullable();
            $table->string('about_image')->nullable();
            $table->integer('happy_customers')->default(0);
            $table->integer('years_experience')->default(0);
            $table->integer('destinations')->default(0);
            $table->integer('satisfaction_rate')->default(0);
            $table->json('values')->nullable(); // For company values
            $table->json('team_members')->nullable(); // For team information
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
