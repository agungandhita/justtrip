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
        Schema::table('bookings', function (Blueprint $table) {
            // Store selected optional pricing items chosen by customer
            $table->json('selected_options')->nullable()->after('catatan_khusus');
            // Store additional amount from optional pricing
            $table->decimal('options_amount', 15, 2)->default(0)->after('selected_options');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['selected_options', 'options_amount']);
        });
    }
};
