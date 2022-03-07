<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = config('admin');

        $data['password'] = Hash::make($data['password']);
        $data['role_id']  = Role::where('name', config('role.admin.name'))
            ->first()->id;

        User::firstOrCreate($data);
    }
}
