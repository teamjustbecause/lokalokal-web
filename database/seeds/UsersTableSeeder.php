<?php

use Illuminate\Database\Seeder;
use LokaLocal\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Module
        $moduleId = DB::table('modules')->insertGetId([
            'name' => 'users',
            'display_name' => 'Users',
            'icon' => 'icon-people'
        ]);

        // Permissions
        DB::table('permissions')->insert([
            [
                'name' => 'read-users',
                'display_name' => 'Read',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'create-users',
                'display_name' => 'Create',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'update-users',
                'display_name' => 'Update',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ],
            [
                'name' => 'delete-users',
                'display_name' => 'Delete',
                'guard_name' => 'web',
                'module_id' => $moduleId
            ]
        ]);

        // Assign permissions to admin role
        $admin = Role::findByName('admin');
        $admin->givePermissionTo(Permission::all());

        // Create admin user
        $user = User::create([
            'name' => 'admin',
            'email' => 'admin@lokalocal.ph',
            'password' => bcrypt('admin'),
            'avatar' => 'avatar.png'
        ]);
        // Assign admin role to default user
        $user->assignRole('admin');
        // Generate avatar to defautl user
        $avatar = Avatar::create($user->name)->getImageObject()->encode('png');
        Storage::put('avatars/'.$user->id.'/avatar.png', (string) $avatar);

        // Create ordinary user
        $user = User::create([
            'name' => 'user',
            'email' => 'user@lokalocal.ph',
            'password' => bcrypt('user'),
            'avatar' => 'avatar.png'
        ]);
        // Assign admin role to default user
        $user->assignRole('user');
        // Generate avatar to defautl user
        $avatar = Avatar::create($user->name)->getImageObject()->encode('png');
        Storage::put('avatars/'.$user->id.'/avatar.png', (string) $avatar);
    }
}
