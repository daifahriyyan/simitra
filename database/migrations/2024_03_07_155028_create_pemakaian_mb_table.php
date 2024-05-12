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
        Schema::create('pemakaian_mb', function (Blueprint $table) {
            $table->id();
            $table->string('id_pemakaian');
            $table->string('tanggal_mulai');
            $table->unsignedBigInteger('id_persediaan');
            $table->string('tanggal_selesai');
            $table->string('pemakaian_persediaan');
            $table->string('berat_akhir');
            $table->string('keterangan');
            $table->timestamps();
        });

        Schema::table('pemakaian_mb', function (Blueprint $table) {
            $table->foreign('id_persediaan')->references('id')->on('data_persediaan')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemakaian_mb');
    }
};
