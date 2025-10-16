<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Permissions
        $p1 = Permission::firstOrCreate(['name' => 'ariza qabul qilish', 'guard_name' => 'web']);
        $p2 = Permission::firstOrCreate(['name' => 'ariza tasdiqlash', 'guard_name' => 'web']);
        $p3 = Permission::firstOrCreate(['name' => 'ariza yakuniy qabul', 'guard_name' => 'web']);
        $p4 = Permission::firstOrCreate(['name' => 'dashboard.view', 'guard_name' => 'web']);
        $p5 = Permission::firstOrCreate(['name' => 'custom-tab.view', 'guard_name' => 'web']);

        // Roles
        $helper  = Role::firstOrCreate(['name' => 'helper', 'guard_name' => 'web']);
        //buyerni ochirib turaman
        // $hr      = Role::firstOrCreate(['name' => 'hr', 'guard_name' => 'web']);
        $manager = Role::firstOrCreate(['name' => 'manager', 'guard_name' => 'web']);

        // Assign permissions to roles

        //buyerni ochirib turaman
        // $hr->givePermissionTo($p1);
        $manager->givePermissionTo([$p2, $p3, $p4, $p5]);

        // Sardorga bevosita biriktirish (id = 2002)
        $sardor = User::find(2002);
        if ($sardor) {
            $sardor->givePermissionTo(['dashboard.view', 'custom-tab.view']);
        }
    }
}
