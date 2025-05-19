<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservasi_id')->constrained('reservasis')->onDelete('cascade');
            $table->timestamp('tanggal');
            $table->decimal('jumlah', 10, 2);
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->string('status');
            $table->string('metode');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
}; 