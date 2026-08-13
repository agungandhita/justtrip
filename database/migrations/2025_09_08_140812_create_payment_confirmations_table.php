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
        Schema::create('payment_confirmations', function (Blueprint $table) {
            $table->uuid('payment_confirmation_id')->primary();
            $table->uuid('booking_id');
            $table->uuid('invoice_id');
            $table->string('destination_bank');
            $table->string('sender_bank_name');
            $table->string('sender_account_number');
            $table->string('sender_account_holder');
            $table->decimal('payment_amount', 15, 2);
            $table->datetime('payment_date');
            $table->string('payment_proof_path');
            $table->text('payment_notes')->nullable();
            $table->string('status')->default('pending');
            $table->text('admin_notes')->nullable();
            $table->unsignedBigInteger('confirmed_by')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->unsignedBigInteger('processed_by')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('booking_id')->references('booking_id')->on('bookings')->onDelete('cascade');
            $table->foreign('invoice_id')->references('invoice_id')->on('invoices')->onDelete('cascade');
            $table->foreign('confirmed_by')->references('id')->on('users')->onDelete('set null');
            $table->foreign('processed_by')->references('id')->on('users')->onDelete('set null');

            // Indexes
            $table->index(['status', 'created_at']);
            $table->index('payment_date');
            $table->index('booking_id');
            $table->index('invoice_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_confirmations');
    }
};