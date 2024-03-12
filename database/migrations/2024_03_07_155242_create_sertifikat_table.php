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
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->id();
            $table->string('id_reg');
            $table->string('id_order_container');
            $table->string('id_recordsheet');
            $table->tinyInteger('target');
            $table->string('commodity');
            $table->string('consignment');
            $table->string('country');
            $table->string('pol');
            $table->string('destination');
            $table->timestamps();
            $table->string('nama_customer');
            $table->string('telp_customer');
            $table->string('attn');
            $table->string('tin');
            $table->string('id_importer');
            $table->string('nama_importer');
            $table->string('alamat_importer');
            $table->string('telp_importer');
            $table->string('fax');
            $table->string('usci');
            $table->string('pic');
            $table->date('tanggal_selesai');
            $table->integer('daff_prescribed_doses_rate');
            $table->string('forecast_minimum_temperature');
            $table->string('exposure_periode');
            $table->integer('applied_dose_rate');
            $table->tinyInteger('fumigation_conducted');
            $table->string('container');
            $table->tinyInteger('wrapping');
            $table->date('tanggal_sertif');
            $table->string('no_reg');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikat');
    }
};
