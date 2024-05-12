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
        Schema::create('data_harga', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_standar');
            $table->string('id_datastandar');
            $table->string('volume');
            $table->string('treatment');
            $table->decimal('bbb_standar', 65, 2);
            $table->decimal('btk_standar', 65, 2);
            $table->decimal('bop_standar', 65, 2);
            $table->decimal('hpp', 65, 2);
            $table->decimal('markup', 65, 2);
            $table->decimal('harga_jual', 65, 2);
            $table->timestamps();
        });

        Schema::table('data_harga', function (Blueprint $table) {
            $table->foreign('id_standar')->references('id')->on('data_hpp_feet')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_harga');
    }
};
