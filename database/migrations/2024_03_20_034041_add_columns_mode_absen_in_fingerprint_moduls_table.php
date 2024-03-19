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
        Schema::table('fingerprint_moduls', function (Blueprint $table) {
            $table->boolean('mode_absen')->default(0)->nullable()->after('status')->comment('0 = Masuk, 1 =Pulang');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fingerprint_moduls', function (Blueprint $table) {
            $table->dropColumn('mode_absen');
        });
    }
};
