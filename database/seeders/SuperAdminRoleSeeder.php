<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\MenyuOrganization;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;

class SuperAdminRoleSeeder extends Seeder
{
    public function run(): void
    {
        $role = Role::firstOrCreate([
            'name' => 'superadmin',
            'guard_name' => 'web',
        ]);

        $user = User::where('phone', '991333333')->first();

        if (!$user) {
            $this->command->error('User topilmadi!');
            return;
        }

        $organizations = MenyuOrganization::all();

        foreach ($organizations as $org) {
            DB::table('organization_user_role')->updateOrInsert([
                'organization_id' => $org->id,
                'user_id' => $user->id,
            ], [
                'role_id' => $role->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $user->assignRole($role);

        $this->command->info("User {$user->phone} superadmin bo‘ldi va pivot jadval to‘ldirildi!");
    }
}
