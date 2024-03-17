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
        Schema::create('data_hpp_feet', function (Blueprint $table) {
            $table->id();
            $table->string('id_standar');
            $table->string('bbb_feet');
            $table->string('btk_feet');
            $table->string('bop_feet');
            $table->string('jumlah_hpp_feet');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_hpp_feet');
    }
};
