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
            $table->string('no_jurnal')->nullable();
            $table->string('id_akun')->nullable();
            $table->string('debet')->nullable();
            $table->string('kredit')->nullable();
            $table->timestamps();
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
