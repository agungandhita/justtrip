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
        Schema::table('special_offers', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['layanan_id']);
            
            // Make layanan_id nullable
            $table->unsignedBigInteger('layanan_id')->nullable()->change();
            
            // Re-add the foreign key constraint with nullable support
            $table->foreign('layanan_id')->references('layanan_id')->on('layanan')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('special_offers', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['layanan_id']);
            
            // Make layanan_id not nullable again
            $table->unsignedBigInteger('layanan_id')->nullable(false)->change();
            
            // Re-add the original foreign key constraint
            $table->foreign('layanan_id')->references('layanan_id')->on('layanan')->onDelete('cascade');
        });
    }
};
