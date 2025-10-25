<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MenyuOrganization;

class DefaultOrganizationSeeder extends Seeder
{
    public function run(): void
    {
        MenyuOrganization::firstOrCreate(
            ['subdomain' => 'my'],
            [
                'name' => 'Default Synterra',
                'password' => 432423,
                'user_id' => 1,
                'robot_auto' => false,
                'turniket' => false,
                'last_check' => false,
                'non_workdays' => json_encode([]),
                'extra_user' => json_encode([]),
                'user_ids' => json_encode([1]),
            ]
        );


        $this->command->info('✅ Default organization (my.synterra.uz) yaratildi');
    }
}
