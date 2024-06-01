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
        Schema::create('ceklist_fumigasi', function (Blueprint $table) {
            $table->id();
            $table->string('id_ceklist');
            $table->unsignedBigInteger('id_order');
            // $table->date('tanggal_order');
            $table->string('ceklist_fumigasi');
            $table->timestamps();
        });

        Schema::table('ceklist_fumigasi', function (Blueprint $table) {
            $table->foreign('id_order')->references('id')->on('detail_order')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ceklist_fumigasi');
    }
};
