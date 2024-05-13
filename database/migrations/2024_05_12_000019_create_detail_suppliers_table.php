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
            $table->unsignedBigInteger('id_supplier');
            $table->string('termin_pembayaran');
            $table->date('tanggal_input')->nullable();
            $table->date('tanggal_jatuh_tempo')->nullable();
            $table->decimal('pembelian', 65, 2);
            $table->decimal('pembayaran', 65, 2);
            $table->string('saldo_akhir_supplier');
            $table->string('status')->nullable();
            $table->timestamps();
        });

        Schema::table('keu_detail_supplier', function (Blueprint $table) {
            $table->foreign('id_supplier')->references('id')->on('keu_supplier')->onDelete('restrict')->onUpdate('cascade');
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
