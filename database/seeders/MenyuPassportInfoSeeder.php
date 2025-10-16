<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenyuPassportinfo;

class MenyuPassportInfoSeeder extends Seeder
{
    public function run(): void
    {
        MenyuPassportinfo::insert([
            [
                'seria_raqam' => 'AB1234567',
                'kim_tomonidan_berilgan' => 'Toshkent IIB',
                'berilgan_sana' => '2020-01-01',
                'amal_qilish_muddati' => '2030-01-01',
                'doimiy_yashash_joyi' => 'Toshkent shahri',
                'yashash_joyi' => 'Chilonzor tuman',
                'employee_id' => 1
            ]
        ]);
    }
}
