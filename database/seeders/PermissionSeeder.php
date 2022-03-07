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
        $datas = config('permission');

        foreach ($datas as $group => $permissions) {
            foreach ($permissions as $permission) {
                $permission['group'] = $group;
                Permission::firstOrCreate($permission);
            }
        }
    }
}
