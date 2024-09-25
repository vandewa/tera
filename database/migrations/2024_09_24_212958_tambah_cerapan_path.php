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
            $table->text('cerapan_path')->after('keterangan')->nullable();
            $table->string('hasil_st')->after('cerapan_path')->nullable();
            $table->text('keterangan_hasil')->after('hasil_st')->nullable();
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
