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
        Schema::create('pemeriksaans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pengajuan_id');
            $table->date('tanggal_pemeriksaan');
            $table->string('upload_cerapan')->nullable();
            $table->string('hasil_st')->nullable();
            $table->longText('hasil_keterangan')->nullable();
            $table->unsignedBigInteger('pegawai_berhak_id')->nullable();
            $table->unsignedBigInteger('penandatanganan_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemeriksaans');
    }
};
