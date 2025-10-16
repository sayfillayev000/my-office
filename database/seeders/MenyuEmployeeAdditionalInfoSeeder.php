<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenyuEmployeeadditionalinfo;

class MenyuEmployeeAdditionalInfoSeeder extends Seeder
{
    public function run(): void
    {
        MenyuEmployeeadditionalinfo::insert([
            [
                'old_job_exit_reason' => 'Ixtiyoriy ketgan',
                'davlat_mukofoti' => 'Shuhrat medali',
                'haydovchilik_guvohnomasi' => 'AB123456',
                'soliq_id' => '1234567',
                'inps' => '99887766',
                'qiziqishlari' => 'Futbol',
                'akfa_tanish' => true,
                'akfa_tanish_ism' => 'Akmal',
                'akfa_tanish_lavozim' => 'Direktor',
                'sudlanganmi' => false,
                'boy' => '175',
                'vazn' => '70',
                'kostyum_razmer' => '48',
                'poyabzal_razmer' => '42',
                'telegram_username' => '@akmaldev',
                'employee_id' => 1,
            ]
        ]);
    }
}
