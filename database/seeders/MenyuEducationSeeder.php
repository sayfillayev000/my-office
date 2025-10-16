<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use App\Models\MenyuEducation;

class MenyuEducationSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('Menyu_education')->insert([
    [
        'degree_type'    => 'Bakalavr',
        'faculty_name'   => 'Kompyuter injiniring',
        'speciality'      => 'Dasturchi',
        'diploma_number' => '12345',
        'start_date'     => '2020-09-01',
        'end_date'       => '2024-06-30',
        'issue_date'     => '2024-07-01',
        'employee_id'    => 1,   // bu yerga 1 emas 2000
        'university_id'  => 1,
        'languages_data' => json_encode(["uz","en"]),
    ],
    [
        'degree_type'    => 'Magistr',
        'faculty_name'   => 'Amaliy matematika',
        'speciality'      => 'Axborot tizimlari',
        'diploma_number' => '67890',
        'start_date'     => '2021-09-01',
        'end_date'       => '2023-06-30',
        'issue_date'     => '2023-07-01',
        'employee_id'    => 2,   // bu yerga 2 emas 2001
        'university_id'  => 2,
        'languages_data' => json_encode(["ru","en"]),
    ],
]);

    }
}
