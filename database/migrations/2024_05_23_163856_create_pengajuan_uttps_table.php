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
        Schema::create('pengajuan_uttps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uttp_id')->nullable();
            $table->unsignedBigInteger('pemohon_id')->nullable();
            $table->string('no_seri')->nullable();
            $table->string('merek')->nullable();
            $table->string('tipe')->nullable()->comment('tipe / kelas');
            $table->string('kapasitas')->nullable();
            $table->integer('jumlah')->nullable();
            $table->string('pengajuan_uttp_st')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_uttps');
    }
};
