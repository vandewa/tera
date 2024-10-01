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
        Schema::table('peserta_sidang_uttps', function (Blueprint $table) {
            // Adding foreign key to peserta_sidang_id referencing peserta_sidangs table
            $table->foreignId('peserta_sidang_id')
                ->constrained('peserta_sidangs') // References the peserta_sidangs table
                ->onDelete('cascade') // Deletes related records in this table when the referenced peserta_sidang is deleted
                ->onUpdate('cascade'); // Updates peserta_sidang_id in this table when the corresponding peserta_sidang is updated

            // Adding foreign key to uttp_id referencing uttps table
            $table->foreignId('uttp_id')
                ->constrained('uttps') // References the uttps table
                ->onDelete('restrict') // Prevents deletion of the referenced record in uttps if related records exist in this table
                ->onUpdate('cascade'); // Updates uttp_id in this table when the corresponding uttp is updated
        });

        Schema::table('peserta_sidangs', function (Blueprint $table) {
            $table->foreignId('jadwal_tera_id')
                ->constrained('jadwal_teras') // References the users table
                ->onDelete('cascade') // Deletes posts when a user is deleted
                ->onUpdate('cascade'); // Updates user_id in posts if user_id in users is updated

        });
        Schema::table('jadwal_tera_petugas', function (Blueprint $table) {
            $table->foreignId('jadwal_tera_id')
                ->constrained('jadwal_teras') // References the users table
                ->onDelete('cascade') // Deletes posts when a user is deleted
                ->onUpdate('cascade'); // Updates user_id in posts if user_id in users is updated

        });
        Schema::table('jadwal_tera_peralatans', function (Blueprint $table) {
            $table->foreignId('jadwal_tera_id')
                ->constrained('jadwal_teras') // References the users table
                ->onDelete('cascade') // Deletes posts when a user is deleted
                ->onUpdate('cascade'); // Updates user_id in posts if user_id in users is updated

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peserta_sidang_uttps', function (Blueprint $table) {
            // Rollback: Drop the foreign key constraint
            $table->dropForeign(['peserta_sidang_id']);
            $table->dropForeign(['uttp_id']);
            $table->dropColumn('peserta_sidang_id');
            $table->dropColumn('uttp_id');
        });
    }
};
