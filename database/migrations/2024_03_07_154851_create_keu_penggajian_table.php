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
        Schema::create('keu_penggajian', function (Blueprint $table) {
            $table->id();
            $table->string('id_penggajian');
            $table->date('tanggal_input');
            $table->unsignedBigInteger('id_pegawai');
            $table->decimal('bonus', 65, 2);
            $table->decimal('tunjangan_lembur', 65, 2);
            $table->decimal('iuran', 65, 2);
            $table->decimal('gaji_bersih', 65, 2);
            $table->timestamps();
        });

        Schema::table('keu_penggajian', function (Blueprint $table) {
            $table->foreign('id_pegawai')->references('id')->on('data_pegawai')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keu_penggajian');
    }
};
