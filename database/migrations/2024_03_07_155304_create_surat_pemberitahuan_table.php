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
            $table->string('id_data_order');
            $table->string('commodity');
            $table->string('container');
            $table->string('place_fumigation');
            $table->string('fumigan');
            $table->date('tanggal');
            $table->date('tanggal_selesai');
            $table->tinyInteger('dimohon_kesediaan');
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
