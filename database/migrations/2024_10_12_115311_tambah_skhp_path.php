<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('pengajuan_uttps', function (Blueprint $table) {
            $table->string('skhp_path')->nullable()->after('cerapan_path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pengajuan_uttps', function (Blueprint $table) {
            //
        });
    }
};
