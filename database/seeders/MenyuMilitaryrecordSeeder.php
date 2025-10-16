<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenyuMilitaryrecord;

class MenyuMilitaryrecordSeeder extends Seeder
{
    public function run(): void
    {
        MenyuMilitaryrecord::insert([
            [
                'hisob_guruhi' => '1',
                'hisob_toifasi' => 'A',
                'harbiy_mutaxassislik' => 'Signalchi',
                'qoshin_turi' => 'Quruqlik qo‘shinlari',
                'xizmatga_yaroqliligi' => 'Yaroqli',
                'harbiy_unvoni' => 'Leytenant',
                'mudofa_bolimi' => 'Toshkent MB',
                'maxsus_xisob' => 'Maxsus',
                'employee_id' => 1
            ]
        ]);
    }
}
