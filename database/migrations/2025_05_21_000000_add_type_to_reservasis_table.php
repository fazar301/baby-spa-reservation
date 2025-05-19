<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->string('type')->after('layanan_id')->default('layanan');
        });
    }

    public function down()
    {
        Schema::table('reservasis', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
}; 