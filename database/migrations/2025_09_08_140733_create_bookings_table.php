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
        Schema::create('bookings', function (Blueprint $table) {
            $table->uuid('booking_id')->primary();
            $table->unsignedBigInteger('user_id');
            $table->uuid('layanan_id')->nullable(false);
            $table->uuid('special_offer_id')->nullable();
            $table->string('booking_number')->unique();
            $table->datetime('booking_date');
            $table->decimal('original_amount', 15, 2);
            $table->decimal('discount_amount', 15, 2)->default(0);
            $table->decimal('total_amount', 15, 2);
            $table->string('status')->default('pending');
            $table->json('customer_info');
            $table->json('custom_booking_info')->nullable();
            $table->integer('jumlah_peserta')->default(1);
            $table->date('tanggal_keberangkatan');
            $table->text('catatan_khusus')->nullable();
            $table->text('admin_notes')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->unsignedBigInteger('rejected_by')->nullable();
            $table->text('rejection_reason')->nullable();
            $table->timestamp('cancelled_at')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('layanan_id')->references('layanan_id')->on('layanan')->onDelete('cascade');
            $table->foreign('special_offer_id')->references('id')->on('special_offers')->onDelete('set null');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('rejected_by')->references('id')->on('users')->onDelete('set null');

            // Indexes
            $table->index('booking_number', 'idx_booking_number');
            $table->index('user_id', 'idx_user_id');
            $table->index('status', 'idx_status');
            $table->index(['special_offer_id', 'status'], 'idx_special_offer_status');
            $table->index('booking_date', 'idx_booking_date');
            $table->index('tanggal_keberangkatan', 'idx_tanggal_keberangkatan');
            $table->index(['status', 'booking_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};