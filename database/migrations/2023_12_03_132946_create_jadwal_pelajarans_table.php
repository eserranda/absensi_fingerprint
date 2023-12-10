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
        Schema::create('jadwal_pelajarans', function (Blueprint $table) {
            $table->id();
            $table->string('hari');
            $table->string('matpel');
            $table->string('jam_mulai');
            $table->string('jam_selesai');
            $table->unsignedBigInteger('id_guru');
            $table->foreign('id_guru')->references('id')->on('data_gurus');
            $table->string('kelas');
            $table->string('ruangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_pelajarans');
    }
};