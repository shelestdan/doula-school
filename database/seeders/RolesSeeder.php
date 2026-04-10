<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            // Leads
            'leads.view', 'leads.create', 'leads.edit', 'leads.delete',
            // Courses
            'courses.view', 'courses.create', 'courses.edit', 'courses.delete',
            'courses.grant_access',
            // Orders
            'orders.view', 'orders.edit',
            // Content
            'pages.edit', 'news.edit', 'services.edit', 'partners.edit',
            // Users
            'users.view', 'users.edit',
            // Settings
            'settings.edit',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        $roles = [
            'super_admin'     => $permissions,
            'admin'           => array_diff($permissions, ['users.edit']),
            'content_manager' => ['pages.edit', 'news.edit', 'services.edit', 'partners.edit', 'courses.view'],
            'sales_manager'   => ['leads.view', 'leads.create', 'leads.edit', 'orders.view'],
            'teacher'         => ['courses.view', 'courses.edit'],
            'student'         => [],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }
    }
}
