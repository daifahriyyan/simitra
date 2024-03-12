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
            $table->string('id_order');
            $table->string('id_order_container');
            $table->string('input_scan');
            $table->timestamps();
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
