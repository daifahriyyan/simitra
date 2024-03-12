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
        Schema::create('rekap_hpp', function (Blueprint $table) {
            $table->id();
            $table->string('id_rekap_penjualan');
            $table->string('id_data_harga');
            $table->string('volume');
            $table->integer('quantity');
            $table->decimal('hpp', 10, 2);
            $table->decimal('total_hpp', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rekap_hpp');
    }
};
