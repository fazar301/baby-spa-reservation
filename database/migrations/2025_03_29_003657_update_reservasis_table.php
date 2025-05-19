<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->foreignId('bayi_id')->nullable()->constrained('bayis')->onDelete('set null');
            $table->date('tanggal_reservasi');
            $table->string('waktu_reservasi');
            $table->decimal('harga', 10, 2);
            $table->text('catatan')->nullable();
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'completed'])->default('pending')->change();
        });
    }

    public function down()
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->dropForeign(['bayi_id']);
            $table->dropColumn([
                'bayi_id',
                'tanggal_reservasi',
                'waktu_reservasi',
                'harga',
                'catatan'
            ]);
            $table->string('status')->change();
        });
    }
}; 