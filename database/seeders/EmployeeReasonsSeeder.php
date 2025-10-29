<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EmployeeReason;

class EmployeeReasonsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reasons = [
            [
                'name' => 'Kasallik',
                'color' => '#dc3545',
                'description' => 'Xodim kasallanganligi sababli ishga kela olmaydi',
                'is_active' => true
            ],
            [
                'name' => 'Tushlik',
                'color' => '#28a745',
                'description' => 'Tushlik vaqti uchun tashrif',
                'is_active' => true
            ],
            [
                'name' => 'Ish safari',
                'color' => '#007bff',
                'description' => 'Rasmiy ish safari',
                'is_active' => true
            ],
            [
                'name' => 'Dam olish',
                'color' => '#ffc107',
                'description' => 'Dam olish kuni',
                'is_active' => true
            ],
            [
                'name' => 'Shaxsiy maslahat',
                'color' => '#6c757d',
                'description' => 'Shaxsiy maslahat uchun tashrif',
                'is_active' => true
            ],
            [
                'name' => 'Ta\'til',
                'color' => '#17a2b8',
                'description' => 'Ta\'til kuni',
                'is_active' => true
            ]
        ];

        foreach ($reasons as $reason) {
            EmployeeReason::create($reason);
        }
    }
}

