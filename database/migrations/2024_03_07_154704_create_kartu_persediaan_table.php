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
        Schema::create('kartu_persediaan', function (Blueprint $table) {
            $table->id();
            $table->string('id_kartu_persediaan');
            $table->string('id_persediaan');
            $table->dateTime('tanggal_input');
            $table->integer('harga_masuk');
            $table->integer('jumlah_masuk');
            $table->integer('total_masuk');
            $table->integer('harga_keluar');
            $table->integer('jumlah_keluar');
            $table->integer('total_keluar');
            $table->integer('harga_saldo');
            $table->integer('jumlah_saldo');
            $table->integer('total_saldo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kartu_persediaan');
    }
};
