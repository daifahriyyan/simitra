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
            $table->unsignedBigInteger('id_invoice');
            $table->string('id_rekap_penjualan');
            $table->unsignedBigInteger('id_order');
            $table->decimal('total_penjualan', 65, 2);
            $table->timestamps();
        });

        Schema::table('rekap_penjualan', function (Blueprint $table) {
            $table->foreign('id_order')->references('id')->on('data_order')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_invoice')->references('id')->on('invoice')->onDelete('restrict')->onUpdate('cascade');
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
