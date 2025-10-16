<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenyuRelative;

class MenyuRelativeSeeder extends Seeder
{
    public function run(): void
    {
        MenyuRelative::insert([
            [
                'qarindoshlik' => 'Ota',
                'familiyasi' => 'Karimov',
                'ismi' => 'Jahongir',
                'sharfi' => 'O‘g‘li',
                'tugilgan_yili' => 1970,
                'tugilgan_joy_soato' => '1701',
                'ishi_joyi' => 'O‘qituvchi',
                'lavozimi' => 'Direktor',
                'employee_id' => 1
            ]
        ]);
    }
}
