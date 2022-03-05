<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            // role
            [
                'title' => 'Admin-Create Role',
                'name'  => 'create-role',
                'group' => 'role',
            ],
            [
                'title' => 'Admin-Edit Role',
                'name'  => 'edit-role',
                'group' => 'role',
            ],
            [
                'title' => 'Admin-Delete Role',
                'name'  => 'delete-role',
                'group' => 'role',
            ],
            [
                'title' => 'Admin-View Role',
                'name'  => 'view-role',
                'group' => 'role',
            ],

            // user
            [
                'title' => 'Admin-Create User',
                'name'  => 'create-user',
                'group' => 'user',
            ],
            [
                'title' => 'Admin-Edit User',
                'name'  => 'edit-user',
                'group' => 'user',
            ],
            [
                'title' => 'Admin-Delete User',
                'name'  => 'delete-user',
                'group' => 'user',
            ],
            [
                'title' => 'Admin-View User',
                'name'  => 'view-user',
                'group' => 'user',
            ],
        ];

        foreach ($datas as $data) {
            Permission::firstOrCreate($data);
        }
    }
}
