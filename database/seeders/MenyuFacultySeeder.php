<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class MenyuFacultySeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();

        // Ensure table exists before inserting (safe guard for different environments)
        if (!Schema::hasTable('Menyu_faculty')) {
            $this->command->info('Table Menyu_faculty does not exist, skipping MenyuFacultySeeder');
            return;
        }

        // Get university ids (expecting TATU and SamDU)
        $universityIds = DB::table('Menyu_university')->pluck('id', 'name')->toArray();

        if (empty($universityIds)) {
            $this->command->info('No universities found in Menyu_university, skipping faculty seeding');
            return;
        }

        $tatuId = $universityIds['TATU'] ?? null;
        $samduId = $universityIds['SamDU'] ?? null;

        // Map faculties to universities (ensure names used by SpecialitySeeder exist once)
        $insert = [];
        if ($tatuId) {
            $tatuFaculties = [
                'Matematika fakulteti',
                'Fizika fakulteti',
                'Kompyuter Ilmlari fakulteti',
                'Axborot Texnologiyalari fakulteti',
                'Dasturlash va IT fakulteti',
            ];
            foreach ($tatuFaculties as $name) {
                $insert[] = ['name' => $name, 'university_id' => $tatuId, 'created_at' => $now, 'updated_at' => $now];
            }
        }

        if ($samduId) {
            $samduFaculties = [
                'Biznes va Iqtisod fakulteti',
                'Xalqaro munosabatlar fakulteti',
            ];
            foreach ($samduFaculties as $name) {
                $insert[] = ['name' => $name, 'university_id' => $samduId, 'created_at' => $now, 'updated_at' => $now];
            }
        }

        if (!empty($insert)) {
            // Insert or update each faculty one-by-one to avoid relying on a DB unique constraint
            foreach ($insert as $row) {
                // Use updateOrInsert for cross-DB compatibility (Postgres requires unique index for upsert)
                DB::table('Menyu_faculty')->updateOrInsert(
                    ['name' => $row['name']],
                    ['university_id' => $row['university_id'], 'updated_at' => $now, 'created_at' => $row['created_at'] ?? $now]
                );
            }

            $this->command->info('✅ Menyu_faculty seeded for available universities');
        } else {
            $this->command->info('No faculties to insert (missing university ids)');
        }
    }
}
