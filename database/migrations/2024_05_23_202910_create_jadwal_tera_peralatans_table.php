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
        Schema::create('jadwal_tera_peralatans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('jadwal_tera_id');
            $table->unsignedBigInteger('peralatan_id');
            $table->string('kembali_st')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_tera_peralatans');
    }
};
