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
        Schema::create('keu_pembelians', function (Blueprint $table) {
            $table->id();
            $table->string('id_pembelian');
            $table->string('tanggal_beli');
            $table->string('termin_pembayaran');
            $table->string('id_supplier');
            $table->string('metode_beli');
            $table->string('id_persediaan');
            $table->integer('jumlah_beli');
            $table->decimal('harga_beli');
            $table->decimal('total_beli');
            $table->decimal('ppn_masukan');
            $table->decimal('total_bayar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keu_pembelians');
    }
};
