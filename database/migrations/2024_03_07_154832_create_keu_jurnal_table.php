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
        Schema::create('keu_jurnal', function (Blueprint $table) {
            $table->id();
            $table->string('no_jurnal')->nullable();
            $table->date('tanggal_jurnal')->nullable();
            $table->string('no_bukti')->nullable();
            $table->string('uraian_jurnal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keu_jurnal');
    }
};
