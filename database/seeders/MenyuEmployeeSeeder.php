<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User; // alohida model kerak

class MenyuEmployeeSeeder extends Seeder
{
    public function run()
    {
        // ID sequence 2000 dan boshlanadi
        DB::statement('ALTER SEQUENCE "Menyu_employee_id_seq" RESTART WITH 1');

        // 1 - Helper
        $helper = User::create([
            'first_name'       => 'Jamshid',
            'last_name'        => 'XOLIQOV',
            'middle_name'      => 'Sherzod o‘g‘li',
            'department'       => 'IT',
            'position'         => 'Helper',
            'phone'            => '991555555',
            'image'            => 'employee_images/helper.jpg',
            'floor'            => 2,
            'room'             => 4,
            'embedding'        => hex2bin('00'),
            'parking'          => true,
            'office'           => true,
            'worker_and_time'  => 8,
            'organization_id'  => 6,
            'night_working'    => false,
            'tashkilot'        => 'mizan',
        ]);
        $helper->assignRole('helper');

        // 2 - HR   //buyerni ochirib turaman
        // $hr = User::create([
        //     'first_name'       => 'Dilshod',
        //     'last_name'        => 'QODIROV',
        //     'middle_name'      => 'Rustamovich',
        //     'department'       => 'HR',
        //     'position'         => 'Kadrlar bo‘limi',
        //     'phone'            => '991666666',
        //     'image'            => 'employee_images/hr.jpg',
        //     'floor'            => 1,
        //     'room'             => 2,
        //     'embedding'        => hex2bin('00'),
        //     'parking'          => true,
        //     'office'           => true,
        //     'worker_and_time'  => 8,
        //     'organization_id'  => 6,
        //     'night_working'    => false,
        //     'tashkilot'        => 'mizan',
        // ]);
        // $hr->assignRole('hr');

        // 3 - Manager
        $manager = User::create([
            'first_name'       => 'Sardor',
            'last_name'        => 'ABDULLAYEV',
            'middle_name'      => 'Otabekovich',
            'department'       => 'Management',
            'position'         => 'Manager',
            'phone'            => '991777777',
            'image'            => 'employee_images/manager.jpg',
            'floor'            => 3,
            'room'             => 5,
            'embedding'        => hex2bin('00'),
            'parking'          => true,
            'office'           => true,
            'worker_and_time'  => 8,
            'organization_id'  => 6,
            'night_working'    => false,
            'tashkilot'        => 'mizan',
        ]);
        $manager->assignRole('manager');
    }
}
