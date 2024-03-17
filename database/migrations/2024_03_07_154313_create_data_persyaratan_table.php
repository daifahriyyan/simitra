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
        Schema::create('data_persyaratan', function (Blueprint $table) {
            $table->id();
            $table->string('id_data_order');
            $table->string('nama_driver');
            $table->integer('telp_driver');
            $table->string('shipment_instruction');
            $table->string('packing_list');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_persyaratan');
    }
};