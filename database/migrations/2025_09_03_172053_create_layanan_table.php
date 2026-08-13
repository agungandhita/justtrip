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
            $table->uuid('layanan_id')->primary();
            $table->string('nama_layanan');
            $table->string('slug')->unique();
            $table->string('jenis_layanan');
            $table->text('deskripsi')->nullable();
            $table->string('information_image')->nullable();
            $table->json('itinerary')->nullable();
            $table->string('start_time')->nullable();
            $table->string('finish_time')->nullable();
            $table->text('itinerary_note')->nullable();
            $table->json('include_services')->nullable();
            $table->json('exclude_services')->nullable();
            $table->json('destinations')->nullable();
            $table->json('pricing_options')->nullable();
            $table->json('terms_conditions')->nullable();
            $table->decimal('harga_mulai', 15, 2);
            $table->integer('durasi_hari');
            $table->integer('maks_orang');
            $table->string('lokasi_tujuan');
            $table->json('fasilitas')->nullable();
            $table->json('gambar_destinasi')->nullable();
            $table->string('status')->default('aktif');
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