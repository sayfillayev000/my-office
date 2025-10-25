<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\MenyuOrganization;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class SeedPermissions extends Command
{
    protected $signature = 'app:seed-permissions';
    protected $description = 'Seed default permissions, roles, and superadmin user with organization.';

    public function handle(): void
    {
        // 1️⃣ Barcha permissionlarni aniqlaymiz
        $permissions = [
            'custom-tab.view',
            'employee.view',
            'employee.edit',
            'employee.delete',
            'notifications.view',
            'notifications.create',
            'notifications.edit',
            'notifications.delete',
        ];

        // 2️⃣ Permissionlarni yaratamiz
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $this->info('✅ Barcha permissionlar yaratildi.');

        // 3️⃣ Superadmin rolini yaratamiz
        $superAdminRole = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);
        $superAdminRole->syncPermissions(Permission::all());

        $this->info('✅ Superadmin roli yaratildi va barcha permissionlar biriktirildi.');

        // 4️⃣ Default organizationni yaratamiz (agar yo‘q bo‘lsa)
        $organization = MenyuOrganization::firstOrCreate(
            ['subdomain' => 'my'],
            [
                'name' => 'Default Synterra',
                'password' => 9999,
                'user_id' => 1,
                'robot_auto' => false,
                'turniket' => true,
                'last_check' => false,
                'non_workdays' => json_encode([]),
                'extra_user' => json_encode([]),
                'user_ids' => json_encode([]),
            ]
        );

        $this->info("🏢 Organization yaratildi yoki mavjud: {$organization->name}");

        // 5️⃣ Super admin userni yaratamiz
        $user = \App\Models\User::create([
            'phone' => '991000000',
            'organization_id' => $organization->id,
        ]);
        $this->info("👤 User yaratildi yoki mavjud: {$user->phone}");

        // 6️⃣ Role biriktiramiz
        $user->assignRole($superAdminRole);

        // 7️⃣ Pivot jadvalga ham qo‘shamiz (agar ishlatayotgan bo‘lsang)
        if (Schema::hasTable('organization_user_role')) {
            DB::table('organization_user_role')->updateOrInsert([
                'organization_id' => $organization->id,
                'user_id' => $user->id,
            ], [
                'role_id' => $superAdminRole->id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->info('🎯 Superadmin user muvaffaqiyatli yaratildi va barcha ruxsatlar berildi!');
        $this->newLine();
        $this->info('🔑 Kirish uchun ma’lumotlar:');
        $this->line('Domen: https://my.synterra.uz/backm/login');
        $this->line('Telefon: 991000000');
        $this->line('Parol: Admin@12345');
    }
}
