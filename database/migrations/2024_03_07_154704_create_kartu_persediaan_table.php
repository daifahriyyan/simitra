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
            $table->unsignedBigInteger('id_persediaan');
            $table->dateTime('tanggal_input');
            $table->bigInteger('harga_masuk');
            $table->bigInteger('jumlah_masuk');
            $table->bigInteger('total_masuk');
            $table->bigInteger('harga_keluar');
            $table->bigInteger('jumlah_keluar');
            $table->bigInteger('total_keluar');
            $table->bigInteger('harga_saldo');
            $table->bigInteger('jumlah_saldo');
            $table->bigInteger('total_saldo');
            $table->timestamps();
        });

        Schema::table('kartu_persediaan', function (Blueprint $table) {
            $table->foreign('id_persediaan')->references('id')->on('data_persediaan')->onDelete('restrict')->onUpdate('cascade');
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
