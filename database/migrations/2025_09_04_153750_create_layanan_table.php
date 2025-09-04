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
        Schema::create('layanan', function (Blueprint $table) {
            $table->id('layanan_id');
            $table->string('nama_layanan');
            $table->enum('jenis_layanan', [
                'paket_wisata',
                'tour_domestik', 
                'tour_internasional',
                'honeymoon',
                'family_trip',
                'adventure',
                'cultural_tour',
                'business_trip',
                'pilgrimage',
                'cruise',
                'backpacker',
                'luxury_tour'
            ]);
            $table->text('deskripsi')->nullable();
            $table->decimal('harga_mulai', 15, 2);
            $table->integer('durasi_hari');
            $table->string('lokasi_tujuan');
            $table->json('fasilitas')->nullable();
            $table->json('gambar_destinasi')->nullable(); // Array untuk menyimpan path gambar (maksimal 5)
            $table->enum('status', ['aktif', 'nonaktif'])->default('aktif');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan');
    }
};
