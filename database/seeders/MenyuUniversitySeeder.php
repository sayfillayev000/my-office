<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenyuUniversity;

class MenyuUniversitySeeder extends Seeder
{
    public function run(): void
    {
        MenyuUniversity::insert([
            ['name' => 'TATU', 'region_name' => 'Toshkent', 'ownership_type' => 'Davlat'],
            ['name' => 'SamDU', 'region_name' => 'Samarqand', 'ownership_type' => 'Davlat'],
        ]);
    }
}
