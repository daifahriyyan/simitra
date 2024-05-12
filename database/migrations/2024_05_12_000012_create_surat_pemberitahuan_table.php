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
        Schema::create('surat_pemberitahuan', function (Blueprint $table) {
            $table->id();
            $table->string('id_sp');
            $table->unsignedBigInteger('id_order');
            $table->string('place_fumigation');
            $table->string('fumigan');
            $table->date('tanggal');
            $table->date('tanggal_selesai');
            $table->string('dimohon_kesediaan');
            $table->timestamps();
        });

        Schema::table('surat_pemberitahuan', function (Blueprint $table) {
            // $table->foreign('id_order')->references('id')->on('data_order')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('id_order')->references('id')->on('detail_order')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('surat_pemberitahuan');
    }
};
