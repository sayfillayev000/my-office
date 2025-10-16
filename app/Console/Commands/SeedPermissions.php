<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class SeedPermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:seed-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed default permissions into the database';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $permissions = [
            'dashboard.view', 
            'custom-tab.view',
            'employee.view',
            'employee.create',
            'employee.edit',
            'employee.delete',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        $superAdmin = Role::firstOrCreate(['name' => 'superadmin', 'guard_name' => 'web']);

        $superAdmin->syncPermissions($permissions);

        $this->info('✅ Permissions va superadmin role yaratildi!');
    }
}
