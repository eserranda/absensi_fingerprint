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
        Schema::table('data_absensi_gurus', function (Blueprint $table) {
            $table->unsignedBigInteger('id_guru')->nullable()->after('id');
            $table->foreign('id_guru')->references('id')->on('data_gurus')->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedBigInteger('id_fingerprint')->nullable()->after('id_guru');
            $table->foreign('id_fingerprint')->references('id')->on('fingerprint_gurus')->cascadeOnUpdate()->nullOnDelete();

            $table->date('tanggal_absen')->after('id_fingerprint');
            $table->time('jam_masuk')->nullable()->after('tanggal_absen');
            $table->time('jam_keluar')->nullable()->after('jam_masuk');
            $table->string('keterangan')->nullable()->after('jam_keluar');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('data_absensi_gurus', function (Blueprint $table) {
            $table->dropColumn('id_guru');
            $table->dropColumn('id_fingerprint');
            $table->dropColumn('tanggal_absen');
            $table->dropColumn('jam_masuk');
            $table->dropColumn('jam_keluar');
            $table->dropColumn('keterangan');
        });
    }
};
