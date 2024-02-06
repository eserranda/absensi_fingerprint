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
        Schema::create('fingerprint_gurus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_guru')->nullable();
            $table->foreign('id_guru')->references('id')->on('data_gurus')->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedBigInteger('id_modul_fingerprint')->nullable();
            $table->foreign('id_modul_fingerprint')->references('id')->on('fingerprints')->cascadeOnUpdate()->nullOnDelete();
            $table->integer('id_fingerprint');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fingerprint_gurus');
    }
};
