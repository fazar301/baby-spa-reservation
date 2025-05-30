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
        Schema::create('reservasis', function (Blueprint $table) {
            $table->id();
            $table->string('kode',8)->unique();
            $table->foreignId('user_id')->constrained(
                table: 'users', 
                indexName: 'reservasis_user_id'
            );
            $table->foreignId('layanan_id')->constrained(
                table: 'layanans', 
                indexName: 'reservasis_layanan_id'
            );
            $table->foreignId('sesi_id')->constrained(
                table: 'sesis', 
                indexName: 'reservasis_sesi_id'
            );
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasis');
    }
};
