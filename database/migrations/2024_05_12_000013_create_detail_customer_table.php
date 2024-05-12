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
        Schema::create('detail_customer', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_customer');
            $table->string('termin');
            $table->date('tanggal_input');
            $table->integer('saldo_awal');
            $table->integer('total_penjualan');
            $table->integer('penerimaan');
            $table->integer('saldo_akhir');
            $table->string('status');
            $table->timestamps();
        });

        Schema::table('detail_customer', function (Blueprint $table) {
            $table->foreign('id_customer')->references('id')->on('data_customer')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_customer');
    }
};
