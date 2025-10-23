<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Avval role va permission lar
        $this->call([
            RolePermissionSeeder::class,
        ]);

        // Keyin organization va employee lar
        $this->call([
            MenyuOrganizationSeeder::class,
            MenyuEmployeeSeeder::class,
        ]);

        // Endi bog‘langan jadval seederlari
        $this->call([
            MenyuFacultySeeder::class,
            MenyuEmployeeAdditionalInfoSeeder::class,
            MenyuRegionSeeder::class,
            MenyuDistrictSeeder::class,
            MenyuVillageSeeder::class,
            MenyuUniversitySeeder::class,
            MenyuEducationSeeder::class,
            MenyuWorkExperienceSeeder::class,
            MenyuRelativeSeeder::class,
            MenyuMilitaryrecordSeeder::class,
            MenyuPassportInfoSeeder::class,
            ApplicationSeeder::class,
        ]);
    }
}

