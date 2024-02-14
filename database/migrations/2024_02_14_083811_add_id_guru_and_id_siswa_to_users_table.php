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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('id_guru')->nullable()->after('name');
            $table->foreign('id_guru')->references('id')->on('data_gurus')->cascadeOnUpdate()->nullOnDelete();
            $table->unsignedBigInteger('id_siswa')->nullable()->after('id_guru');
            $table->foreign('id_siswa')->references('id')->on('data_siswas')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('id_guru');
            $table->dropColumn('id_siswa');
        });
    }
};
