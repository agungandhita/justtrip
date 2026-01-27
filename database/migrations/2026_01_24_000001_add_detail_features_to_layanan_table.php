<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('layanan', function (Blueprint $table) {
            $table->string('information_image')->nullable()->after('deskripsi');
            $table->json('itinerary')->nullable()->after('information_image');
            $table->string('start_time')->nullable()->after('itinerary');
            $table->string('finish_time')->nullable()->after('start_time');
            $table->text('itinerary_note')->nullable()->after('finish_time');
            $table->json('include_services')->nullable()->after('itinerary_note');
            $table->json('exclude_services')->nullable()->after('include_services');
            $table->json('destinations')->nullable()->after('exclude_services');
            $table->json('pricing_options')->nullable()->after('destinations');
            $table->json('terms_conditions')->nullable()->after('pricing_options');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('layanan', function (Blueprint $table) {
            $table->dropColumn([
                'information_image',
                'itinerary',
                'start_time',
                'finish_time',
                'itinerary_note',
                'include_services',
                'exclude_services',
                'destinations',
                'pricing_options',
                'terms_conditions'
            ]);
        });
    }
};
