<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class UniversityAndFacultySeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // 1️⃣ Universities qo'shish
        $universities = [
            ['name' => 'Toshkent Davlat Universiteti', 'region_name' => 'Toshkent', 'ownership_type' => 'Davlat', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'O‘zbekiston Milliy Universiteti', 'region_name' => 'Toshkent', 'ownership_type' => 'Davlat', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Toshkent Axborot Texnologiyalari Universiteti', 'region_name' => 'Toshkent', 'ownership_type' => 'Davlat', 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Inha Universiteti', 'region_name' => 'Toshkent', 'ownership_type' => 'Xususiy', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('Menyu_university')->insert($universities);

        // 2️⃣ Faculties qo'shish
        // University ID larini olish
        $universityIds = DB::table('Menyu_university')->pluck('id', 'name');

        $faculties = [
            ['name' => 'Matematika fakulteti', 'university_id' => $universityIds['Toshkent Davlat Universiteti'], 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Fizika fakulteti', 'university_id' => $universityIds['Toshkent Davlat Universiteti'], 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Kompyuter Ilmlari fakulteti', 'university_id' => $universityIds['Toshkent Axborot Texnologiyalari Universiteti'], 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Axborot Texnologiyalari fakulteti', 'university_id' => $universityIds['Toshkent Axborot Texnologiyalari Universiteti'], 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Biznes va Iqtisod fakulteti', 'university_id' => $universityIds['O‘zbekiston Milliy Universiteti'], 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Xalqaro munosabatlar fakulteti', 'university_id' => $universityIds['O‘zbekiston Milliy Universiteti'], 'created_at' => $now, 'updated_at' => $now],
            ['name' => 'Dasturlash va IT fakulteti', 'university_id' => $universityIds['Inha Universiteti'], 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('Menyu_faculty')->insert($faculties);
    }
}
