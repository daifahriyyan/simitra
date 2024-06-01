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
        Schema::create('draft_pelayaran', function (Blueprint $table) {
            $table->id();
            $table->string('id_draft');
            $table->unsignedBigInteger('id_order');
            $table->date('tanggal_order');
            $table->string('draft_pelayaran');
            $table->timestamps();
        });

        Schema::table('draft_pelayaran', function (Blueprint $table) {
            $table->foreign('id_order')->references('id')->on('detail_order')->onDelete('restrict')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('draft_pelayaran');
    }
};
