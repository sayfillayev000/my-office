<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SpecialitySeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Faculties ID larini olish
        $facultyIds = DB::table('Menyu_faculty')->pluck('id', 'name');

        // Specialities qo'shish
        $specialities = [
            ['name' => 'Matematika', 'faculty_id' => $facultyIds['Matematika fakulteti'], 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Fizika', 'faculty_id' => $facultyIds['Fizika fakulteti'], 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kompyuter Ilmlari', 'faculty_id' => $facultyIds['Kompyuter Ilmlari fakulteti'], 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Axborot Texnologiyalari', 'faculty_id' => $facultyIds['Axborot Texnologiyalari fakulteti'], 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Biznes va Iqtisod', 'faculty_id' => $facultyIds['Biznes va Iqtisod fakulteti'], 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Xalqaro munosabatlar', 'faculty_id' => $facultyIds['Xalqaro munosabatlar fakulteti'], 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Dasturlash va IT', 'faculty_id' => $facultyIds['Dasturlash va IT fakulteti'], 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('Menyu_speciality')->insert($specialities);
    }
}
