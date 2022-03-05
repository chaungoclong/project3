<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            [
                'title'           => 'Admin',
                'name'            => 'admin',
                'is_user_defined' => false,
                'is_default'      => false,
                'permissions'     => Permission::all(),
            ],
            [
                'title'           => 'Customer',
                'name'            => 'customer',
                'is_user_defined' => false,
                'is_default'      => true,
            ],
            [
                'title'           => 'Employee',
                'name'            => 'employee',
                'is_user_defined' => false,
                'is_default'      => false,
            ],
        ];

        foreach ($datas as $data) {
            Role::firstOrCreate(
                Arr::except($data,['permissions'])
            )->givePermissionTo($data['permissions'] ?? null);
        }
    }
}
