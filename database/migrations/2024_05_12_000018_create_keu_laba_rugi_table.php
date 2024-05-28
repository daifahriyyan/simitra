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
        Schema::create('keu_laba_rugi', function (Blueprint $table) {
            $table->id();
            $table->float('jumlah_laba_rugi', 65, 2);
            $table->date('tanggal_laporan');
            $table->date('tanggal_posting');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keu_laba_rugis');
    }
};
