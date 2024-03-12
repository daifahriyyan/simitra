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
        Schema::create('verifikasi_order', function (Blueprint $table) {
            $table->id();
            $table->string('id_data_order');
            $table->date('tanggal_order');
            $table->string('id_customer');
            $table->string('nama_customer');
            $table->string('alamat_customer');
            $table->string('commodity');
            $table->date('stuffing_date');
            $table->date('closing_time');
            $table->tinyInteger('waktu');
            $table->tinyInteger('export_status');
            $table->string('destination');
            $table->tinyInteger('import_status');
            $table->string('origin');
            $table->tinyInteger('packing_status');
            $table->tinyInteger('kondisi_status');
            $table->string('place_fumigation');
            $table->tinyInteger('kesimpulan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verifikasi_order');
    }
};
