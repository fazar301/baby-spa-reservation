<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reservasis', function (Blueprint $table) {
            // $table->enum('status', ['pending', 'confirmed', 'cancelled'])->default('pending');
            // $table->foreignId('voucher_id')->nullable()->constrained()->nullOnDelete();
            $table->decimal('discount_amount', 10, 2)->default(0);
            $table->decimal('final_amount', 10, 2);
            // $table->foreignId('bayi_id')->nullable()->constrained()->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->dropForeign(['voucher_id']);
            $table->dropForeign(['bayi_id']);
            $table->dropColumn(['status', 'voucher_id', 'discount_amount', 'final_amount', 'bayi_id']);
        });
    }
}; 