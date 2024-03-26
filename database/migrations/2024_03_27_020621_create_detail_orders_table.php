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
        Schema::create('detail_order', function (Blueprint $table) {
            $table->id();
            $table->string('id_order');
            $table->string('id_data_standar');
            $table->date('stuffing_date');
            $table->string('id_data_harga');
            $table->string('container');
            $table->string('container_volume');
            $table->string('commodity');
            $table->string('vessel');
            $table->date('closing_time');
            $table->string('destination');
            $table->string('place_fumigation');
            $table->string('pic');
            $table->string('phone_pic');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_order');
    }
};
