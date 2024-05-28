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
        Schema::create('pemberitahuan', function (Blueprint $table) {
            $table->id();
            $table->string('id_kegiatan');
            $table->unsignedBigInteger('id_order');
            $table->dateTime('jam_mulai');
            $table->dateTime('jam_selesai');
            $table->string('keterangan');
            $table->timestamps();
        });

        Schema::table('pemberitahuan', function (Blueprint $table) {
            $table->foreign('id_order')->references('id')->on('data_order')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemberitahuan');
    }
};
