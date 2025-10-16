<?php

namespace Database\Seeders;

use App\Models\MenyuDistrict;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenyuDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MenyuDistrict::insert([
            ['soato_id' => '170101', 'name_uz' => 'Chilonzor', 'name_oz' => 'Chilonzor', 'name_ru' => 'Чиланзар', 'region_id' => 1],
            ['soato_id' => '170201', 'name_uz' => 'Urgut', 'name_oz' => 'Urgut', 'name_ru' => 'Ургут', 'region_id' => 2],
        ]);
    }
}
