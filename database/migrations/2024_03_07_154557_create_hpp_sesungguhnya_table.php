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
        Schema::create('hpp_sesungguhnya', function (Blueprint $table) {
            $table->id();
            $table->string('id_beban_hpp');
            $table->date('tanggal_input');
            $table->decimal('bbb_sesungguhnya', 20, 0);
            $table->decimal('btk_sesungguhnya', 20, 0);
            $table->decimal('bop_sesungguhnya', 20, 0);
            $table->decimal('hpp_sesungguhnya', 20, 0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hpp_sesungguhnya');
    }
};
