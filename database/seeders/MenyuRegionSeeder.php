<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class MenyuRegionSeeder extends Seeder
{
    public function run(): void
    {
        if (!Schema::hasTable('Menyu_region')) {
            $this->command->info('Table Menyu_region does not exist, skipping MenyuRegionSeeder');
            return;
        }

        $now = Carbon::now();

        $rows = [
            ['soato_id' => '1701', 'name_uz' => 'Toshkent', 'name_ru' => 'Ташкент', 'name_oz' => 'Toshkent', 'created_at' => $now, 'updated_at' => $now],
            ['soato_id' => '1702', 'name_uz' => 'Samarqand', 'name_ru' => 'Самарканд', 'name_oz' => 'Samarqand', 'created_at' => $now, 'updated_at' => $now],
        ];

        $soatoIds = array_map(fn($r) => $r['soato_id'], $rows);

        // remove duplicates before inserting to ensure idempotency
        DB::table('Menyu_region')->whereIn('soato_id', $soatoIds)->delete();

        DB::table('Menyu_region')->insert($rows);

        $this->command->info('✅ Menyu_region seeded (idempotent)');
    }
}
