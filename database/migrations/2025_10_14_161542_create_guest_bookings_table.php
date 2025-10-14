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
        Schema::create('guest_bookings', function (Blueprint $table) {
            $table->id('guest_booking_id');
            $table->string('booking_number')->unique();
            $table->string('destinasi_dicari'); // Destinasi yang dicari user
            $table->unsignedBigInteger('layanan_id')->nullable(); // Jika ada layanan yang cocok
            $table->boolean('is_custom_request')->default(false); // Apakah ini custom request
            
            // Data pribadi guest
            $table->string('nama_lengkap');
            $table->string('email');
            $table->string('nomor_telepon');
            $table->text('alamat');
            $table->string('kota');
            $table->string('provinsi');
            $table->string('kode_pos')->nullable();
            
            // Detail booking
            $table->integer('jumlah_peserta')->default(1);
            $table->date('tanggal_keberangkatan_diinginkan');
            $table->integer('durasi_hari_diinginkan')->nullable();
            $table->decimal('budget_estimasi', 15, 2)->nullable();
            $table->text('kebutuhan_khusus')->nullable();
            $table->text('catatan_tambahan')->nullable();
            
            // Status dan follow-up
            $table->enum('status', ['baru', 'diproses', 'dikonfirmasi', 'ditolak', 'selesai'])->default('baru');
            $table->text('admin_notes')->nullable();
            $table->timestamp('processed_at')->nullable();
            $table->unsignedBigInteger('processed_by')->nullable();
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamp('rejected_at')->nullable();
            $table->text('rejection_reason')->nullable();
            
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('layanan_id')->references('layanan_id')->on('layanan')->onDelete('set null');
            $table->foreign('processed_by')->references('id')->on('users')->onDelete('set null');

            // Indexes
            $table->index(['status', 'created_at']);
            $table->index('booking_number');
            $table->index('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guest_bookings');
    }
};
