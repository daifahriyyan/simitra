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
            $table->string('volume');
            $table->integer('quantity');
            $table->decimal('total_penjualan', 10, 2);
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
