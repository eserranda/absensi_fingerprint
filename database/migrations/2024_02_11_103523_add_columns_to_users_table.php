<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable()->after("name"); // ambil nis (siswa) atau nip (guru) 
            // $table->string('role')->nullable()->after("username");
            $table->string('kelas')->nullable()->after("role");
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
            // $table->dropColumn('role');
            $table->dropColumn('kelas');
        });
    }
};
