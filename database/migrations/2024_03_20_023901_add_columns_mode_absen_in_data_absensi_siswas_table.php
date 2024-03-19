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
        Schema::table('data_absensi_siswas', function (Blueprint $table) {
            $table->boolean('mode_absen')->default(0)->nullable()->after('jam_keluar')->comment('1 = Absen Pulang, 0 = Absen Masuk');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_absensi_siswas', function (Blueprint $table) {
            $table->dropColumn('mode_absen');
        });
    }
};
