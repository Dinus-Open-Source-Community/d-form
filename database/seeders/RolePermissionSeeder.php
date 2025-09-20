<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'recruitment.view',
            'recruitment.create', 
            'recruitment.edit',
            'recruitment.delete',
            'recruitment.approve',
            'recruitment.reject',
            'recruitment.export',
            'recruitment.restore',
            'recruitment.force-delete'
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles
        $superAdmin = Role::create(['name' => 'super-admin']);
        $admin = Role::create(['name' => 'admin']);
        $reviewer = Role::create(['name' => 'reviewer']);

        // Assign permissions to roles
        $superAdmin->givePermissionTo(Permission::all());
        
        $admin->givePermissionTo([
            'recruitment.view',
            'recruitment.create',
            'recruitment.edit', 
            'recruitment.approve',
            'recruitment.reject',
            'recruitment.export',
            'recruitment.restore'
        ]);
        
        $reviewer->givePermissionTo([
            'recruitment.view',
            'recruitment.approve',
            'recruitment.reject'
        ]);

        // Assign role to admin user
        $adminUser = User::where('email', 'admin@doscom.org')->first();
        if ($adminUser) {
            $adminUser->assignRole('super-admin');
        }
    }
}