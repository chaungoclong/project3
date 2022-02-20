<?php

namespace App\Traits\Authorization;

use App\Models\Permission;
use Illuminate\Support\Collection;

trait HasPermissions
{
    // PERMISSION
    public function givePermissionTo(...$permissions): bool
    {
        try {
            $permissions = $this->getPermissionExitsInKeys($permissions);
            $this->permissions()->sync($permissions->pluck('id'), false);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function syncPermission(...$permissions): bool
    {
        try {
            $permissions = $this->getPermissionExitsInKeys($permissions);
            $this->permissions()->sync($permissions->pluck('id'));
            return true;
        } catch (\Exception $e) {
            // dd($e);
            return false;
        }
    }

    public function getPermissionExitsInKeys(...$keys): Collection
    {
        $permissonsExists = [];
        $keys             = collect($keys)->flatten();

        foreach ($keys as $key) {
            $permission = $this->getPermissionByAnyKey($key);

            if ($permission !== null) {
                $permissonsExists[] = $permission;
            }
        }

        return collect($permissonsExists)->unique();
    }

    public function hasPermission($permission): bool
    {
        $permission = $this->getPermissionByAnyKey($permission);

        if ($permission === null) {
            return false;
        }

        return $this->permissions->contains('id', $permission->id);
    }

    public function hasAllPermission(...$permissions): bool
    {
        $permissions = collect($permissions)->flatten();

        foreach ($permissions as $key => $permission) {
            if (!$this->hasPermission($permission)) {
                return false;
            }
        }

        return true;
    }

    public function hasAnyPermission(...$permissions): bool
    {
        $permissions = collect($permissions)->flatten();

        foreach ($permissions as $key => $permission) {
            if ($this->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }

    public function getPermissionByAnyKey($permission):  ? Permission
    {
        if (is_int($permission)) {
            return Permission::find($permission);
        }

        if (is_string($permission)) {
            return Permission::where('name', $permission)->first();
        }

        if (!$permission instanceof Permission) {
            return null;
        }

        return Permission::where('id', $permission->id)->first();
    }
}
