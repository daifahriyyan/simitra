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
        Schema::create('surat_perintah_kerja', function (Blueprint $table) {
            $table->id();
            $table->string('id_spk');
            $table->unsignedBigInteger('id_order');
            $table->date('tanggal');
            $table->string('place_fumigation');
            $table->integer('jumlah_container');
            $table->string('fumigan');
            $table->string('dosis');
            $table->string('fumigator');
            $table->string('helper1');
            $table->string('helper2');
            $table->string('helper3');
            $table->timestamps();
        });

        Schema::table('surat_perintah_kerja', function (Blueprint $table) {
            // $table->foreign('id_order')->references('id')->on('data_order')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_order')->references('id')->on('detail_order')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_perintah_kerja');
    }
};
