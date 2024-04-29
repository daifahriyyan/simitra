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
        Schema::create('keu_aset_tetap', function (Blueprint $table) {
            $table->id();
            $table->string('kode_penyusutan_at');
            $table->string('kode_at');
            $table->string('jenis_at');
            $table->string('nama_at');
            $table->decimal('total_perolehan', 65, 2);
            $table->date('tanggal_penyusutan');
            $table->integer('tahun_ke');
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
        Schema::dropIfExists('keu_aset_tetap');
    }
};
