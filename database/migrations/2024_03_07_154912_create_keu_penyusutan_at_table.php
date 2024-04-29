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
        Schema::create('keu_penyusutan_at', function (Blueprint $table) {
            $table->id();
            $table->string('kode_penyusutan_at');
            $table->string('kode_at');
            $table->date('tanggal_penyusutan');
            $table->string('tahun_ke');
            $table->decimal('beban_penyusutan', 65, 2);
            $table->decimal('akumulasi_penyusutan', 65, 2);
            $table->decimal('nilai_buku', 65, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keu_penyusutan_at');
    }
};
