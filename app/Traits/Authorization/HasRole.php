<?php

namespace App\Traits\Authorization;

use App\Models\Role;

trait HasRole
{
	public function assignRole($role): bool
	{
		$role = $this->getRoleByAnyKey($role);

        if ($role === null) {
            return false;
        }

        $this->role_id = $role->id;
        $this->save();
        return true;
	}

    public function hasRole($role): bool
    {
        $role = $this->getRoleByAnyKey($role);

        if ($role === null) {
            return false;
        }

        return optional($this->role)->id === $role->id;
    }

    public function getRoleByAnyKey($role):  ? Role
    {
        if (is_int($role)) {
            return Role::find($role);
        }

        if (is_string($role)) {
            return Role::where('name', $role)->first();
        }

        if (!$role instanceof Role) {
            return null;
        }

        return Role::where('id', $role->id)->first();
    }

    public function hasPermission($permission): bool
    {
    	return (bool) optional($this->role)->hasPermission($permission);
    }

    public function hasAllPermission(...$permissions): bool
    {
    	return (bool) optional($this->role)->hasAllPermission($permissions);
    }

    public function hasAnyPermission(...$permissions): bool
    {
    	return (bool) optional($this->role)->hasAnyPermission($permissions);
    }
}
