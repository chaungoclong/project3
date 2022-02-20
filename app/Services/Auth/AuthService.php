<?php

namespace App\Services\Auth;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    private User $user;
    private Role $role;

    public function __construct(Role $role, User $user)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function register(array $data): User
    {
        $roleDefault = $this->role->role_default;

        if ($roleDefault === null) {
            throw new \Exception('khong the dang ky');
        }

        if ($roleDefault !== null && $roleDefault->name !== 'customer') {
            throw new \Exception('khong duoc phep dang ky');
        }

        $data['role_id']  = $roleDefault->id;
        $data['password'] = Hash::make($data['password']);

        return $this->user->create($data);
    }
}
