<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class MenyuVillageSeeder extends Seeder
{
    public function run(): void
    {
        if (!Schema::hasTable('Menyu_village')) {
            $this->command->info('Table Menyu_village does not exist, skipping MenyuVillageSeeder');
            return;
        }

        $now = Carbon::now();

        $rowsRaw = [
            ['soato_id' => '17010101', 'name_uz' => 'Qatortol', 'name_oz' => 'Qatortol', 'name_ru' => 'Катортол', 'district_soato' => '170101'],
            ['soato_id' => '17020101', 'name_uz' => 'Oqtosh', 'name_oz' => 'Oqtosh', 'name_ru' => 'Октос', 'district_soato' => '170201'],
        ];

        $soatoIds = array_map(fn($r) => $r['soato_id'], $rowsRaw);

        DB::table('Menyu_village')->whereIn('soato_id', $soatoIds)->delete();

        $toInsert = [];
        foreach ($rowsRaw as $r) {
            $districtId = DB::table('Menyu_district')->where('soato_id', $r['district_soato'])->value('id');
            if (!$districtId) {
                $this->command->info("Skipping village {$r['soato_id']} because district with soato {$r['district_soato']} not found");
                continue;
            }

            $toInsert[] = [
                'soato_id' => $r['soato_id'],
                'name_uz' => $r['name_uz'],
                'name_oz' => $r['name_oz'],
                'name_ru' => $r['name_ru'],
                'district_id' => $districtId,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if (!empty($toInsert)) {
            DB::table('Menyu_village')->insert($toInsert);
            $this->command->info('✅ Menyu_village seeded (idempotent)');
        } else {
            $this->command->info('No villages inserted (missing parent districts)');
        }
    }
}
