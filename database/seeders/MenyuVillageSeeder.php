<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenyuVillage;

class MenyuVillageSeeder extends Seeder
{
    public function run(): void
    {
        MenyuVillage::insert([
            ['soato_id' => '17010101', 'name_uz' => 'Qatortol', 'name_oz' => 'Qatortol', 'name_ru' => 'Катортол', 'district_id' => 1],
            ['soato_id' => '17020101', 'name_uz' => 'Oqtosh', 'name_oz' => 'Oqtosh', 'name_ru' => 'Октос', 'district_id' => 2],
        ]);
    }
}
