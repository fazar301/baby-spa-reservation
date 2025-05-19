<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('layanans', function (Blueprint $table) {
            $table->string('slug')->unique()->after('nama_layanan');
        });

        Schema::table('paket_layanans', function (Blueprint $table) {
            $table->string('slug')->unique()->after('nama_paket');
        });
    }

    public function down()
    {
        Schema::table('layanans', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('paket_layanans', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
}; 