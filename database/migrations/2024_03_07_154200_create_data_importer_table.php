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
        Schema::create('data_importer', function (Blueprint $table) {
            $table->id();
            $table->string('id_importer');
            $table->string('nama_importer');
            $table->string('alamat_importer');
            $table->string('telp_importer');
            $table->string('fax');
            $table->string('usci');
            $table->string('pic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_importer');
    }
};
