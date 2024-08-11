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
            $table->string('semester')->nullable()->after('mode_absen');
            $table->string('tahun_ajaran')->nullable()->after('semester');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_absensi_siswas', function (Blueprint $table) {
            $table->dropColumn(['semester', 'tahun_ajaran']);
        });
    }
};
