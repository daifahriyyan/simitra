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
        Schema::create('invoice', function (Blueprint $table) {
            $table->id();
            $table->string('id_order');
            $table->string('id_invoice');
            $table->string('id_sertif');
            $table->string('id_recordsheet');
            $table->string('id_data_standar');
            $table->date('tanggal_invoice');
            $table->string('no_bl');
            $table->string('shipper');
            $table->date('stuffing_date');
            $table->dateTime('closing_time');
            $table->decimal('total_penjualan', 65, 2);
            $table->decimal('ppn', 65, 2);
            $table->decimal('jumlah_dibayar', 65, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice');
    }
};
