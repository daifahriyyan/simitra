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
        Schema::create('keu_detail_jurnal', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('no_jurnal');
            $table->unsignedBigInteger('kode_akun');
            $table->string('debet')->nullable();
            $table->string('kredit')->nullable();
            $table->timestamps();
        });

        Schema::table('keu_detail_jurnal', function (Blueprint $table) {
            $table->foreign('no_jurnal')->references('id')->on('keu_jurnal')->onDelete('restrict')->onUpdate('cascade');
            $table->foreign('kode_akun')->references('id')->on('keu_akun')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keu_detail_jurnal');
    }
};
