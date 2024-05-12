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
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_order');
            $table->string('id_invoice');
            $table->unsignedBigInteger('id_sertif');
            $table->unsignedBigInteger('id_recordsheet');
            $table->unsignedBigInteger('id_data_standar');
            $table->string('termin');
            $table->date('tanggal_invoice');
            $table->string('no_bl');
            $table->string('shipper');
            $table->date('stuffing_date');
            $table->dateTime('closing_time');
            $table->decimal('total_penjualan', 65, 2);
            $table->decimal('ppn', 65, 2);
            $table->decimal('jumlah_dibayar', 65, 2);
            $table->date('tanggal_jatuh_tempo');
            $table->timestamps();
        });

        Schema::table('invoice', function (Blueprint $table) {
            $table->foreign('id_sertif')->references('id')->on('sertifikat')->onDelete('restrict')->onUpdate('cascade');
            // $table->foreign('id_order')->references('id')->on('data_order')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_order')->references('id')->on('detail_order')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_recordsheet')->references('id')->on('metil_recordsheet')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_data_standar')->references('id')->on('data_harga')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};
