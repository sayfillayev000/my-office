<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenyuRegion;

class MenyuRegionSeeder extends Seeder
{
    public function run(): void
    {
        MenyuRegion::insert([
            ['soato_id' => '1701', 'name_uz' => 'Toshkent', 'name_ru' => 'Ташкент', 'name_oz' => 'Toshkent'],
            ['soato_id' => '1702', 'name_uz' => 'Samarqand', 'name_ru' => 'Самарканд', 'name_oz' => 'Samarqand'],
        ]);
    }
}
