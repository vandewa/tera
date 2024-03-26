<?php

namespace Database\Seeders;

use App\Models\Uttp;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UttpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('uttps')->truncate();

        $data = [
            ['id' => '1', 'nama' => 'METER KAYU'],
            ['id' => '2', 'nama' => 'TAKARAN'],
            ['id' => '3', 'nama' => 'TIMBANGAN PENGECEK DAN PENYORTIR'],
            [
                'id' => '4',
                'nama' => 'TIMBANGAN ELEKTRONIK KELAS II,  III DAN IIII 
            (TERMASUK TIMBANGAN JEMBATAN SAMPAI 
            DENGAN KAPASITAS 60 TON)'
            ],
            ['id' => '5', 'nama' => 'TIMBANGAN PEGAS'],
            ['id' => '6', 'nama' => 'TIMBANGAN CEPAT'],
            ['id' => '7', 'nama' => 'NERACA'],
            ['id' => '8', 'nama' => 'DACIN'],
            ['id' => '9', 'nama' => 'TIMBANGAN MILISIMAL'],
            ['id' => '10', 'nama' => 'TIMBANGAN SENTISIMAL'],
            ['id' => '11', 'nama' => 'TIMBANGAN DESIMAL'],
            ['id' => '12', 'nama' => 'TIMBANGAN BOBOT INGSUT'],
            ['id' => '13', 'nama' => 'TIMBANGAN MEJA BERANGER'],
            ['id' => '14', 'nama' => 'POMPA UKUR BAHAN BAKAR MINYAK'],
            [
                'id' => '15',
                'nama' => 'ANAK TIMBANGAN SEBAGAI PERLENGKAPAN 
            TIMBANGAN MEJA, NERACA DAN SENTISIMAL'
            ],

        ];

        foreach ($data as $datum) {
            Uttp::create($datum);
        }

    }
}
