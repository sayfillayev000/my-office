<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenyuOrganizationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Menyu_organization')->insert([
            [
                "id" => 5,
                "name" => "innostore",
                "password" => 1222,
                "user_id" => 1,
                "robot_auto" => "f",
                "turniket" => "f",
                "last_check" => "f",
                "late_time" => null,
                "non_workdays" => "[]",
                "extra_user" => "[]",
                "user_ids" => "[1]",
                "subdomain" => "barber-shop",
            ],
            [
                "id" => 7,
                "name" => "arenda",
                "password" => 9888,
                "user_id" => 1,
                "robot_auto" => "f",
                "turniket" => "f",
                "last_check" => "f",
                "late_time" => null,
                "non_workdays" => "[]",
                "extra_user" => "[]",
                "user_ids" => "[1]",
                "subdomain" => "barber",
            ],
            [
                "id" => 10,
                "name" => "polina",
                "password" => 5234,
                "user_id" => 7,
                "robot_auto" => "f",
                "turniket" => "t",
                "last_check" => "f",
                "late_time" => null,
                "non_workdays" => "[]",
                "extra_user" => "[]",
                "user_ids" => "[7]",
                "subdomain" => "citynet-men",
            ],
            [
                "id" => 11,
                "name" => "olmaliq",
                "password" => 6565,
                "user_id" => 9,
                "robot_auto" => "f",
                "turniket" => "f",
                "last_check" => "f",
                "late_time" => null,
                "non_workdays" => "[]",
                "extra_user" => "[]",
                "user_ids" => "[9]",
                "subdomain" => "citynet-otabek",
            ],
            [
                "id" => 2,
                "name" => "CityNet",
                "password" => 1234,
                "user_id" => 2,
                "robot_auto" => false,
                "turniket" => true,
                "last_check" => true,
                "late_time" => "2025-01-01 09:10:00", 
                "non_workdays" => "[]",
                "extra_user" => "[]",
                "user_ids" => "[2]",
                "subdomain" => "citynet",
            ],
            [
                "id" => 3,
                "name" => "burgutsoft",
                "password" => 1111,
                "user_id" => 3,
                "robot_auto" => "t",
                "turniket" => "t",
                "last_check" => "t",
                "late_time" => "2025-01-01 10:00:00",
                "non_workdays" => "[]",
                "extra_user" => "[]",
                "user_ids" => "[10, 3]",
                "subdomain" => "burgutsoft",
            ],
            [
                "id" => 6,
                "name" => "mizan",
                "password" => 7778,
                "user_id" => 6,
                "robot_auto" => "f",
                "turniket" => "t",
                "last_check" => "f",
                "late_time" => null,
                "non_workdays" => "[]",
                "extra_user" => "[]",
                "user_ids" => "[6]",
                "subdomain" => "mizan",
            ],
            [
                "id" => 8,
                "name" => "UzTMK",
                "password" => 3211,
                "user_id" => 5,
                "robot_auto" => "f",
                "turniket" => "t",
                "last_check" => "f",
                "late_time" => null,
                "non_workdays" => "[]",
                "extra_user" => "[]",
                "user_ids" => "[5]",
                "subdomain" => "tmk",
            ],
        ]);
    }
}
