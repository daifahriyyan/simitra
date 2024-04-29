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
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->id();
            $table->string('id_reg');
            $table->string('id_order');
            $table->string('id_order_container')->nullable();
            $table->string('id_recordsheet');
            $table->string('id_importer');
            $table->string('id_sertif');
            $table->string('target');
            $table->string('commodity');
            $table->string('consignment');
            $table->string('country');
            $table->string('pol');
            $table->string('destination');
            $table->string('attn');
            $table->string('tin');
            $table->string('wrapping');
            $table->date('tanggal_sertif');
            $table->string('no_reg');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikat');
    }
};
