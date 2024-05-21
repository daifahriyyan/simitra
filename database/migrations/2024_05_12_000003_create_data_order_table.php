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
        Schema::create('data_order', function (Blueprint $table) {
            $table->id();
            $table->string('id_order');
            $table->unsignedBigInteger('id_data_harga');
            $table->date('tanggal_order');
            $table->unsignedBigInteger('id_customer');
            $table->string('treatment');
            $table->string('volume');
            $table->string('place_fumigation');
            $table->integer('jumlah_order');
            $table->integer('verifikasi')->nullable();
            $table->timestamps();
        });

        Schema::table('data_order', function (Blueprint $table) {
            $table->foreign('id_data_harga')->references('id')->on('data_harga')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_customer')->references('id')->on('data_customer')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_order');
    }
};
