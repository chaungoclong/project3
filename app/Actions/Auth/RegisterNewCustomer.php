<?php

namespace App\Actions\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 *
 */
class RegisterNewCustomer
{
    private User $user;
    private Role $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function handle(array $data)
    {
        if ($data === null) {
            throw new \Exception('input invalid');
        }

        $roleDefault = $this->role->role_default;

        if ($roleDefault !== null && $roleDefault->name !== 'customer') {
            throw new \Exception('cannot register at here');
        }

        $data['role_id']  = optional($roleDefault)->id;
        $data['password'] = Hash::make($data['password']);

        return $this->user->create($data);
    }
}
