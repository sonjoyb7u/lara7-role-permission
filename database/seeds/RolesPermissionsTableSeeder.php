<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Role create...
        $role_super_admin = Role::create(['name' => 'superadmin']);
        $role_admin = Role::create(['name' => 'admin']);
        $role_author = Role::create(['name' => 'author']);
        $role_editor = Role::create(['name' => 'editor']);
        $role_user = Role::create(['name' => 'user']);
//        $role_guest = Role::create(['name'=>'guest']);

        // Permission lists create...
        $permissions = [
            // Dashboard section permission access...
            [
                'name' => [
                    'dashboard.show',
                    'dashboard.edit',
                ],
                'group_name' => 'dashboard'
            ],
            // Super Admin section permission access...
            [
                'name' => [
                    'superadmin.create',
                    'superadmin.show',
                    'superadmin.edit',
                    'superadmin.delete',
                    'superadmin.status',
                ],
                'group_name' => 'superadmin'
            ],
            // Admin section permission access...
            [
                'name' => [
                    'admin.create',
                    'admin.show',
                    'admin.edit',
                    'admin.delete',
                    'admin.status',
                ],
                'group_name' => 'admin'
            ],
            // Role section permission access...
            [
                'name' => [
                    'roles.create',
                    'roles.show',
                    'roles.edit',
                    'roles.delete',
                    'roles.status',
                ],
                'group_name' => 'role'
            ],
            // Profile section permission access...
            [
                'name' => [
                    'profile.show',
                    'profile.edit',
                ],
                'group_name' => 'profile'
            ],
            // Blog section permission access...
            [
                'name' => [
                    'blogs.create',
                    'blogs.show',
                    'blogs.edit',
                    'blogs.delete',
                    'blogs.status',
                ],
                'group_name' => 'blog'
            ],

        ];

        // Create & Assign permissions...
//        $permission = Permission::create(['name' => 'edit articles']);
        for ($i=0; $i < count($permissions); $i++) {
            $permission_group_name = $permissions[$i]['group_name'];
            for ($j=0; $j < count($permissions[$i]['name']); $j++) {
                $permission = Permission::create([ 'name' => $permissions[$i]['name'][$j], 'group_name' => $permission_group_name ]);
                $role_super_admin->givePermissionTo($permission);
                $permission->assignRole($role_super_admin);
            }
        }

    }

}
