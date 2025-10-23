<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;

class ApplicationSeeder extends Seeder
{
    public function run()
    {
        Application::create([
            'user_id' => 1, // Jamshid (helper)
            'message' => "Iltimos, 2-kun dam olishni so‘rayman",
        ]);

        //buyerni ochirib turaman
        // Application::create([
        //     'user_id' => 2001, // Dilshod (HR)
        //     'message' => "Oilaviy sababli ertaga kelolmayman",
        // ]);
    }
}
