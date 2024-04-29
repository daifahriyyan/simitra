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
        Schema::create('rekap_penjualan', function (Blueprint $table) {
            $table->id();
            $table->string('id_invoice');
            $table->string('id_rekap_penjualan');
            $table->string('id_order');
            $table->decimal('total_penjualan', 65, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_penjualan');
    }
};
