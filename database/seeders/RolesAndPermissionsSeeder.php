<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // User Model
        $userPermission1=Permission::create([
            'name'=>'create:user',
            'description'=>'create user'
        ]);
        $userPermission2=Permission::create([
            'name'=>'read:user',
            'description'=>'read user'
        ]);
        $userPermission3=Permission::create([
            'name'=>'update:user',
            'description'=>'update user'
        ]);
        $userPermission4=Permission::create([
            'name'=>'delete:user',
            'description'=>'delete user'
        ]);
        // Role Model
        $rolePermission1=Permission::create([
            'name'=>'create:role',
            'description'=>'create role'
        ]);
        $rolePermission2=Permission::create([
            'name'=>'read:role',
            'description'=>'read role'
        ]);
        $rolePermission3=Permission::create([
            'name'=>'update:role',
            'description'=>'update role'
        ]);
        $rolePermission4=Permission::create([
            'name'=>'delete:role',
            'description'=>'delete role'
        ]);
        // Permission Model
        $Permission1=Permission::create([
            'name'=>'create:permission',
            'description'=>'create permission'
        ]);
        $Permission2=Permission::create([
            'name'=>'read:permission',
            'description'=>'read permission'
        ]);
        $Permission3=Permission::create([
            'name'=>'update:permission',
            'description'=>'update permission'
        ]);
        $Permission4=Permission::create([
            'name'=>'delete:permission',
            'description'=>'delete permission'
        ]);
        // Admin Model
        $adminPermission1=Permission::create([
            'name'=>'read:admin',
            'description'=>'read admin'
        ]);
        $adminPermission2=Permission::create([
            'name'=>'update:admin',
            'description'=>'update admin'
        ]);

        // Misc
        $miscPermission = Permission::create([
            'name' => 'N/A',
            'description' => 'N/A'
        ]);

        $superAdminRole=Role::create(['name'=>'super-admin']);
        $adminRole=Role::create(['name'=>'admin']);
        $moderatorRole=Role::create(['name'=>'moderator']);
        $developerRole=Role::create(['name'=>'developer']);
        $userRole=Role::create(['name'=>'user']);

        $superAdminRole->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $Permission1,
            $Permission2,
            $Permission3,
            $Permission4,
            $adminPermission1,
            $adminPermission2,
        ]);
        $adminRole->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $Permission1,
            $Permission2,
            $Permission3,
            $Permission4,
            $adminPermission1,
            $adminPermission2,
            $userPermission1,
        ]);
        $moderatorRole->syncPermissions([
            $userPermission2,
            $rolePermission2,
            $Permission2,
            $adminPermission1,
        ]);
        $developerRole->syncPermissions([
            $adminPermission1,
        ]);
        $userRole->syncPermissions([
            $miscPermission,
        ]);

        $superAdmin = User::create([
            'name' => 'super admin',
            'is_admin' => 1,
            'email' => 'super@sge.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $superAdmin2 = User::create([
            'name' => 'Pablo Mendieta',
            'is_admin' => 1,
            'email' => 'mendieta182@hotmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $admin = User::create([
            'name' => 'admin',
            'is_admin' => 1,
            'email' => 'admin@sge.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $moderator = User::create([
            'name' => 'moderator',
            'is_admin' => 1,
            'email' => 'moderator@sge.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $developer = User::create([
            'name' => 'developer',
            'is_admin' => 1,
            'email' => 'developer@sge.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);

        $user = User::create([
            'name' => 'test',
            'is_admin' => 0,
            'email' => 'test@sge.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ]);
        $superAdmin->syncRoles([$superAdminRole])->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $Permission1,
            $Permission2,
            $Permission3,
            $Permission4,
            $adminPermission1,
            $adminPermission2,
        ]);
        $superAdmin2->syncRoles([$superAdminRole])->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $Permission1,
            $Permission2,
            $Permission3,
            $Permission4,
            $adminPermission1,
            $adminPermission2,
        ]);

        $admin->syncRoles([$adminRole])->syncPermissions([
            $userPermission1,
            $userPermission2,
            $userPermission3,
            $userPermission4,
            $rolePermission1,
            $rolePermission2,
            $rolePermission3,
            $rolePermission4,
            $Permission1,
            $Permission2,
            $Permission3,
            $Permission4,
            $adminPermission1,
            $adminPermission2,
        ]);

        $moderator->syncRoles($moderatorRole)->syncPermissions([
            $userPermission2,
            $rolePermission2,
            $adminPermission1,
        ]);

        $developer->syncRoles($developerRole)->syncPermissions([
            $adminPermission1,
        ]);

        $user->syncRoles($userRole)->syncPermissions([
            $miscPermission,
        ]);
    }
}
