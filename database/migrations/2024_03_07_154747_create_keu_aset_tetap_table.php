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
            $table->string('kode_at');
            $table->string('jenis_at');
            $table->string('nama_at');
            $table->integer('jumlah_at');
            $table->string('keberadaan');
            $table->integer('tahun_perolehan');
            $table->integer('umur_ekonomis');
            $table->decimal('harga_perolehan', 65, 2);
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
