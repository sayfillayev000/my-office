<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class MenyuDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Schema::hasTable('Menyu_district')) {
            $this->command->info('Table Menyu_district does not exist, skipping MenyuDistrictSeeder');
            return;
        }

        $now = Carbon::now();

        // Define districts with the region soato they belong to — we'll resolve region_id dynamically
        $rowsRaw = [
            ['soato_id' => '170101', 'name_uz' => 'Chilonzor', 'name_oz' => 'Chilonzor', 'name_ru' => 'Чиланзар', 'region_soato' => '1701'],
            ['soato_id' => '170201', 'name_uz' => 'Urgut', 'name_oz' => 'Urgut', 'name_ru' => 'Ургут', 'region_soato' => '1702'],
        ];

        $soatoIds = array_map(fn($r) => $r['soato_id'], $rowsRaw);

        // remove existing districts with these soato_ids
        DB::table('Menyu_district')->whereIn('soato_id', $soatoIds)->delete();

        $toInsert = [];
        foreach ($rowsRaw as $r) {
            $regionId = DB::table('Menyu_region')->where('soato_id', $r['region_soato'])->value('id');
            if (!$regionId) {
                $this->command->info("Skipping district {$r['soato_id']} because region with soato {$r['region_soato']} not found");
                continue;
            }

            $toInsert[] = [
                'soato_id' => $r['soato_id'],
                'name_uz' => $r['name_uz'],
                'name_oz' => $r['name_oz'],
                'name_ru' => $r['name_ru'],
                'region_id' => $regionId,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if (!empty($toInsert)) {
            DB::table('Menyu_district')->insert($toInsert);
            $this->command->info('✅ Menyu_district seeded (idempotent)');
        } else {
            $this->command->info('No districts inserted (missing parent regions)');
        }
    }
}
