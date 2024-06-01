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
        Schema::create('verifikasi_order', function (Blueprint $table) {
            $table->id();
            $table->string('id_verifikasi');
            $table->unsignedBigInteger('id_order');
            $table->string('waktu');
            $table->string('tujuan');
            $table->string('packing');
            $table->string('kondisi_status');
            $table->string('place_fumigation');
            $table->string('kesimpulan');
            $table->timestamps();
        });

        Schema::table('verifikasi_order', function (Blueprint $table) {
            // $table->foreign('id_order')->references('id')->on('data_order')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_order')->references('id')->on('detail_order')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasi_order');
    }
};
