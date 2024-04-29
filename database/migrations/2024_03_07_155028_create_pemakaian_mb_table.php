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
            $table->string('id_persediaan');
            $table->string('tanggal_selesai');
            $table->string('pemakaian_persediaan');
            $table->string('berat_akhir');
            $table->string('keterangan');
            $table->timestamps();
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
