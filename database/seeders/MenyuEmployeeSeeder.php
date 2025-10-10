<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenyuEmployeeSeeder extends Seeder
{
    public function run()
    {
       DB::table('Menyu_employee')->insert([
    [
        'id' => 1,
        'first_name' => 'Otabek',
        'last_name' => 'IBROHIMOV',
        'middle_name' => 'Shavkat o‘g‘li',
        'department' => 'IT',
        'position' => 'Dasturchi',
        'phone' => '991111111',
        'image' => 'employee_images/ibrohimov-otabek.jpg',
        'floor' => 3,
        'room' => 1,
        'embedding' => '', // agar hozircha yo‘q bo‘lsa bo‘sh qoldiramiz
        'parking' => true,
        'office' => true,
        'worker_and_time' => 8,
        'organization_id' => 8,  // TMK organization_id
        'night_working' => false,
        'tashkilot' => 'tmk',
    ],
    [
        'id' => 2,
        'first_name' => 'Javohir',
        'last_name' => 'QODIROV',
        'middle_name' => 'Rustamovich',
        'department' => 'Marketing',
        'position' => 'Manager',
        'phone' => '991222222',
        'image' => 'employee_images/qodirov-javohir.jpg',
        'floor' => 3,
        'room' => 1,
        'embedding' => '',
        'parking' => true,
        'office' => false,
        'worker_and_time' => 8,
        'organization_id' => 8,
        'night_working' => false,
        'tashkilot' => 'tmk',
    ],
        [
        'id' => 3,
        'first_name' => 'Azizbek',
        'last_name' => 'KARIMOV',
        'middle_name' => 'Sherzod o‘g‘li',
        'department' => 'Buxgalteriya',
        'position' => 'Hisobchi',
        'phone' => '991333333',
        'image' => 'employee_images/karimov-azizbek.jpg',
        'floor' => 2,
        'room' => 5,
        'embedding' => '', // hozircha bo‘sh qoldirdik
        'parking' => false,
        'office' => true,
        'worker_and_time' => 8,
        'organization_id' => 6,  // mizan
        'night_working' => false,
        'tashkilot' => 'mizan',
    ],
    [
        'id' => 4,
        'first_name' => 'Dilnoza',
        'last_name' => 'ABDULLAYEVA',
        'middle_name' => 'Otabekovna',
        'department' => 'HR',
        'position' => 'Kadrlar bo‘limi',
        'phone' => '991444444',
        'image' => 'employee_images/abdullayeva-dilnoza.jpg',
        'floor' => 1,
        'room' => 2,
        'embedding' => '',
        'parking' => true,
        'office' => true,
        'worker_and_time' => 8,
        'organization_id' => 6,
        'night_working' => false,
        'tashkilot' => 'mizan',
    ],
]);

    }
}
