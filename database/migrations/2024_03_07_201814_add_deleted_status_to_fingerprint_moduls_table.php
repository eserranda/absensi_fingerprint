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
            $table->boolean('deleted_status')->default(0)->after('deleted_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fingerprint_moduls', function (Blueprint $table) {
            $table->dropColumn('deleted_status');
        });
    }
};