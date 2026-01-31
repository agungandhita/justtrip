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
            // Add indices for frequently queried columns
            $table->index('booking_number', 'idx_booking_number');
            $table->index('user_id', 'idx_user_id');
            $table->index('status', 'idx_status');
            $table->index(['special_offer_id', 'status'], 'idx_special_offer_status');
            $table->index('booking_date', 'idx_booking_date');
            $table->index('tanggal_keberangkatan', 'idx_tanggal_keberangkatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop indices in reverse order
            $table->dropIndex('idx_tanggal_keberangkatan');
            $table->dropIndex('idx_booking_date');
            $table->dropIndex('idx_special_offer_status');
            $table->dropIndex('idx_status');
            $table->dropIndex('idx_user_id');
            $table->dropIndex('idx_booking_number');
        });
    }
};
