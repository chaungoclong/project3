<?php


namespace App\Services\User;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    private User $user;
    private Role $role;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function create(array $data)
    {
        $roleDefault      = $this->role->role_default;
        
        $data['role_id']  = $data['role_id'] ?? optional($roleDefault)->id;
        $data['password'] = Hash::make($data['password']);

        return $this->user->create($data);
    }
}
