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
        Schema::create('detail_order', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_order');
            $table->string('id_detailorder');
            $table->string('id_data_standar')->nullable();
            $table->date('stuffing_date');
            $table->string('id_data_harga')->nullable();
            $table->string('container');
            $table->string('container_volume');
            $table->string('commodity');
            $table->string('vessel');
            $table->dateTime('closing_time');
            $table->string('destination');
            // $table->string('place_fumigation');
            $table->string('nama_driver');
            $table->string('telp_driver');
            $table->string('shipment_instruction');
            $table->string('packing_list');
            // $table->string('pic');
            // $table->string('phone_pic');
            $table->timestamps();
        });

        Schema::table('detail_order', function (Blueprint $table) {
            // $table->foreign('id_order')->references('id')->on('invoice')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_order')->references('id')->on('data_order')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_order');
    }
};
