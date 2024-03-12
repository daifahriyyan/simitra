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
            $table->string('id_data_order');
            $table->string('id_sertifikat');
            $table->string('id_methyl_recordsheet');
            $table->string('id_data_harga');
            $table->date('tanggal_invoice');
            $table->string('nama_customer');
            $table->string('alamat_customer');
            $table->string('no_bl');
            $table->string('shipper');
            $table->string('destination');
            $table->string('commodity');
            $table->date('tanggal_in');
            $table->date('tanggal_out');
            $table->integer('applied_dose_rate');
            $table->string('treatment');
            $table->integer('quantity');
            $table->string('volume');
            $table->string('container');
            $table->decimal('harga_jual', 10, 2);
            $table->decimal('total_penjualan', 10, 2);
            $table->decimal('ppn', 10, 2);
            $table->decimal('jumlah_dibayar', 10, 2);
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
