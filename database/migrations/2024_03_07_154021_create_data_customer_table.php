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
        Schema::create('data_customer', function (Blueprint $table) {
            $table->id();
            $table->string('id_customer');
            $table->string('nama_customer');
            $table->string('alamat_customer');
            $table->string('telp_customer');
            $table->string('email_customer');
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
        Schema::dropIfExists('data_customer');
    }
};
