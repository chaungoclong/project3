<?php

namespace App\Services\Role;

use App\Exceptions\NoPermissionException;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Arr;
use Yajra\DataTables\Facades\DataTables;

/**
 *
 */
class RoleService
{
    private Role $role;
    private Permission $permission;

    public function __construct(
        Role $role,
        Permission $permission
    ) {
        $this->role       = $role;
        $this->permission = $permission;
    }

    public function getCreateView()
    {
        $permissions = $this->permission->all()->groupBy('group');

        return view('pages.admin.roles.create', [
            'permissions' => $permissions,
        ]);
    }

    public function getEditView(Role $role)
    {
        // dd($role->isCannotChange(), $role->is_user_defined);
        if ($role->isAdmin()) {
            throw new NoPermissionException(
                __('cannot edit this', ['name' => 'vai trò'])
            );
        }

        $permissions        = $this->permission->all()->groupBy('group');
        $permissionCheckeds = $role->permissions->pluck('name')->toArray();

        return view('pages.admin.roles.edit', [
            'role'               => $role,
            'permissionCheckeds' => $permissionCheckeds,
            'permissions'        => $permissions,
        ]);
    }

    /**
     * [create description]
     * @param  array  $data [cac thuoc tinh]
     * @return [Role]       [description]
     */
    public function create(array $data): Role
    {
        $data['is_default']  = (bool) ($data['is_default'] ?? false);
        $data['permissions'] = $data['permissions'] ?? [];

        $data['is_default'] && $this->turnOffDefaultOtherRole();

        $role = $this->role->create(Arr::except($data, ['permissions']));
        $role->givePermissionTo($data['permissions']);

        return $role;
    }

    /**
     * [update description]
     * @param  Role   $role [Role can chinh sua]
     * @param  array  $data [cac thuoc tinh can chinh sua]
     * @return [Role]       [Role da update]
     */
    public function update(Role $role, array $data): Role
    {
        if ($role->isAdmin()) {
            throw new NoPermissionException(
                __('cannot edit this', ['name' => 'vai trò'])
            );
        }

        $data['is_default']  = (bool) ($data['is_default'] ?? false);
        $data['permissions'] = $data['permissions'] ?? [];

        $data['is_default'] && $this->turnOffDefaultOtherRole($role->id);

        $role->update(Arr::except($data, ['permissions']));
        $role->syncPermission($data['permissions']);

        return $role;
    }

    /**
     * [dat role thanh mac dinh]
     * @param Role  $role [Role can dat mac dinh]
     * @param array $data [thuoc tinh de dat mac dinh: is_default]
     */
    public function setRoleDefault(Role $role, array $data): bool
    {
        $data['is_default'] = (bool) ($data['is_default'] ?? false);
        $data['is_default'] && $this->turnOffDefaultOtherRole($role->id);

        return $role->update($data);
    }

    /**
     * [huy mac dinh cua cac Role co ID khac ID cua Role truyen vao
     * neu khong co ID truyen vao -> huy mac dinh cua tat ca cac Role]
     * @param  [string|int|null] $currentRoleId [description]
     * @return [bool]                [description]
     */
    public function turnOffDefaultOtherRole($currentRoleId = null): bool
    {
        if ($currentRoleId === null) {
            return (bool) $this->role->query()->update(
                ['is_default' => false]
            );
        } else {
            return (bool) $this->role->where('id', '<>', $currentRoleId)
                ->update(['is_default' => false]);
        }
    }

    /**
     * [delete description]
     * @param  Role   $role [description]
     * @return [type]       [description]
     */
    public function delete(Role $role): bool
    {
        return $role->delete();
    }

    /**
     * [findById description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function findById($id): Role
    {
        $result = $this->role->find($id);

        if ($result === null) {
            throw new ModelNotFoundException(
                __('not found with id', ['name' => 'vai trò'])
            );
        }

        return $result;
    }

    /**
     * [getRoleDefault description]
     * @return [type] [description]
     */
    public function getRoleDefault():  ? Role
    {
        return $this->role->role_default;
    }

    /**
     * [lay du lieu render table o trang index]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function getDatatables($request)
    {
        $checkeds        = $request->checkeds ?? [];
        $currentRoleId   = auth()->user()->role->id ?? null;

        return DataTables::of(
            $this->role->withCount('users')->with('permissions')
        )->addIndexColumn()
            ->addColumn(
                'select',
                function ($role) use ($checkeds, $currentRoleId) {
                    return view(
                        'components.roles.checkbox_select_render',
                        [
                            'role'          => $role,
                            'checkeds'      => $checkeds,
                            'currentRoleId' => $currentRoleId,
                        ]
                    )->render();
                }
            )
            ->addColumn('users', function ($role) {
                return $role->users_count;
            })
            ->addColumn('permissions', function ($role) {
                return view(
                    'components.roles.badge_permissions_render',
                    ['permissions' => $role->permissions]
                )->render();
            })
            ->addColumn('actions', function ($role) use ($currentRoleId) {
                return view(
                    'components.roles.button_action_render',
                    [
                        'role'          => $role,
                        'currentRoleId' => $currentRoleId,
                    ]
                )->render();
            })
            ->addColumn('default', function ($role) {
                return view(
                    'components.roles.switch_default_render',
                    ['role' => $role]
                )->render();
            })
            ->rawColumns(['users', 'permissions', 'select', 'actions',
                'default'])
            ->make(true);
    }

    /**
     * [xoa cac role co id nam trong id gui len
     * ngoai tru: admin]
     * @param  [type] $ids [description]
     * @return [type]      [description]
     */
    public function deleteMultiple($ids)
    {
        $ids = explode(',', $ids);

        return $this->role->where('is_user_defined', true)
            ->whereIn('id', $ids)->delete();
    }
}
