<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenyuWorkexperience;

class MenyuWorkExperienceSeeder extends Seeder
{
    public function run(): void
    {
        MenyuWorkexperience::insert([
            [
                'lavozim' => 'Backend dasturchi',
                'tashkilot_nomi' => 'IT Park',
                'kirgan_sanasi' => '2021-01-01',
                'boshagan_sanasi' => null,
                'current_job' => true,
                'employee_id' => 1
            ]
        ]);
    }
}
