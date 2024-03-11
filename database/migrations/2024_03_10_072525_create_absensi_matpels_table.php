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
        Schema::create('absensi_matpels', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('hari');

            $table->foreign('id_siswa')->references('id')->on('data_siswas')->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedBigInteger('id_siswa')->nullable();

            $table->string('kelas');

            $table->foreign('id_guru')->references('id')->on('data_gurus')->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedBigInteger('id_guru')->nullable();

            $table->foreign('id_matpel')->references('id')->on('matpels')->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedBigInteger('id_matpel')->nullable();

            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('absensi_matpels');
    }
};
