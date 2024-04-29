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
            $table->string('id_rekap');
            $table->date('tanggal_input');
            $table->string('id_data_harga');
            $table->string('id_rekap_penjualan');
            $table->decimal('total_hpp', 65, 2);
            $table->timestamps();
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
