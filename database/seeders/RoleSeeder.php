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
                'title'           => config('role.admin.title'),
                'name'            => config('role.admin.name'),
                'is_user_defined' => config('role.admin.is_user_defined'),
                'is_default'      => config('role.admin.is_default'),
                'permissions'     => Permission::all(),
            ],
            [
                'title'           => config('role.customer.title'),
                'name'            => config('role.customer.name'),
                'is_user_defined' => config('role.customer.is_user_defined'),
                'is_default'      => config('role.customer.is_default'),
            ],
            [
                'title'           => config('role.employee.title'),
                'name'            => config('role.employee.name'),
                'is_user_defined' => config('role.employee.is_user_defined'),
                'is_default'      => config('role.employee.is_default'),
            ],
        ];

        foreach ($datas as $data) {
            Role::firstOrCreate(
                Arr::except($data, ['permissions'])
            )->givePermissionTo($data['permissions'] ?? null);
        }
    }
}
