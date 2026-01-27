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
            $table->id('payment_confirmation_id');
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('invoice_id');
            $table->enum('destination_bank', ['mandiri', 'bca']); // Bank tujuan transfer PT TRISULA PANDU NUSANTARA
            $table->string('sender_bank_name'); // Nama bank pengirim
            $table->string('sender_account_number'); // Nomor rekening pengirim
            $table->string('sender_account_holder'); // Nama pemilik rekening pengirim
            $table->decimal('payment_amount', 15, 2); // Jumlah yang dibayar
            $table->datetime('payment_date'); // Tanggal pembayaran
            $table->string('payment_proof_path'); // Path file bukti pembayaran
            $table->text('payment_notes')->nullable(); // Catatan dari user
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->text('admin_notes')->nullable(); // Catatan dari admin
            $table->unsignedBigInteger('confirmed_by')->nullable(); // Admin yang konfirmasi
            $table->timestamp('confirmed_at')->nullable();
            $table->unsignedBigInteger('processed_by')->nullable(); // Admin yang memproses
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
