<?php

namespace Database\Seeders;

use App\Models\TemplateDokumen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
           ['nama' => 'formulir_permohonan'],
           ['nama' => 'skhp'],
           ['nama' => 'tanda_terima'],
        ];

        foreach($data as $datum){
            TemplateDokumen::create($datum);
        }
    }
}
