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
            $table->string('id_order');
            $table->date('tanggal_order');
            $table->string('draft_pelayaran');
            $table->timestamps();
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
