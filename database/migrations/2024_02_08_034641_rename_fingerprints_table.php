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
        Schema::rename('fingerprints', 'fingerprint_moduls');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('fingerprint_moduls', 'fingerprints');
    }
};