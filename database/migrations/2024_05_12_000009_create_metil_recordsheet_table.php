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
        Schema::create('metil_recordsheet', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_order');
            $table->string('id_recordsheet');
            $table->date('tanggal_selesai');
            $table->integer('daff_prescribed_doses_rate');
            $table->string('forecast_minimum_temperature');
            $table->string('exposure_period');
            $table->integer('applied_dose_rate');
            $table->string('dokumen_metil_recordsheet');
            $table->timestamps();
        });

        Schema::table('metil_recordsheet', function (Blueprint $table) {
            $table->foreign('id_order')->references('id')->on('data_order')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('metil_recordsheet');
    }
};
