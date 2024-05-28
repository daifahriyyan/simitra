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
            $table->unsignedBigInteger('id_order');
            $table->unsignedBigInteger('id_recordsheet');
            $table->unsignedBigInteger('id_importer');
            $table->string('id_sertif');
            $table->string('target');
            $table->string('commodity');
            $table->string('consignment');
            $table->string('country');
            $table->string('pol');
            $table->string('destination');
            $table->string('attn');
            $table->string('tin');
            $table->string('wrapping');
            $table->date('tanggal_sertif');
            $table->string('no_reg');
            $table->timestamps();
        });

        Schema::table('sertifikat', function (Blueprint $table) {
            $table->foreign('id_order')->references('id')->on('data_order')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_importer')->references('id')->on('data_importer')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_recordsheet')->references('id')->on('metil_recordsheet')->onDelete('restrict')->onUpdate('cascade');
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
