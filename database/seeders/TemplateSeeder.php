<?php

namespace Database\Seeders;

use App\Models\TemplateDokumen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('template_dokumens')->truncate();

        $data = [
            ['nama' => 'formulir_permohonan'],
            ['nama' => 'skhp'],
            ['nama' => 'tanda_terima'],
            ['nama' => 'ba'],
        ];

        foreach ($data as $datum) {
            TemplateDokumen::create($datum);
        }
    }
}
