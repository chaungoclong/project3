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

    /**
     * +khong the dang ky neu khong co vai tro mac dinh
     * +khong duoc dang ky neu vai tro mac dinh khac customer
     * @param  array  $data []
     * @return [User]       []
     */
    public function register(array $data): User
    {
        $roleDefault = $this->role->role_default;

        if ($roleDefault === null) {
            throw new \Exception(
                __('cannot to do', ['action' => 'Đăng ký'])
            );
        }

        if ($roleDefault !== null && $roleDefault->name !== 'customer') {
            throw new \Exception(
                __('unauthorized to do', ['action' => 'đăng ký'])
            );
        }

        $data['role_id']  = $roleDefault->id;
        $data['password'] = Hash::make($data['password']);

        return $this->user->create($data);
    }
}
