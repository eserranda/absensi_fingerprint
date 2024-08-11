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
        Schema::table('absensi_matpels', function (Blueprint $table) {
            $table->string('semester')->nullable()->after('id_matpel');
            $table->string('tahun_ajaran')->nullable()->after('semester');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('absensi_matpels', function (Blueprint $table) {
            $table->dropColumn(['semester', 'tahun_ajaran']);
        });
    }
};
