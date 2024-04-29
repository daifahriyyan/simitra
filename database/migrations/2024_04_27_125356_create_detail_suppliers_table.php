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
        Schema::create('keu_detail_supplier', function (Blueprint $table) {
            $table->id();
            $table->string('id_detail_supplier');
            $table->string('id_supplier');
            $table->string('termin_pembayaran');
            $table->date('tanggal_input');
            $table->decimal('pembelian', 65, 2);
            $table->decimal('pembayaran', 65, 2);
            $table->string('saldo_akhir_supplier');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_suppliers');
    }
};
