<?php

namespace App\Actions\Role;

use App\Models\Role;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;

class GetDatatables
{
    private Role $role;
    private User $user;

    public function __construct(Role $role, User $user)
    {
        $this->role = $role;
        $this->user = $user;
    }

    public function execute($request)
    {
        $checkeds        = $request->checkeds ?? [];
        $currentUserRole = auth()->user()->role->id;

        return DataTables::of(
            $this->role->withCount('users')->with('permissions')
        )
            ->addIndexColumn()
            ->addColumn('select', function ($role) use ($checkeds, $currentUserRole) {
                $isChecked = '';

                if (
                    in_array($role->id, $checkeds)
                    && $role->id !== $currentUserRole && $role->name !== 'admin'
                ) {
                    $isChecked = 'checked';
                }

                if ($role->id === $currentUserRole || $role->name === 'admin') {
                    $isChecked = 'disabled';
                }

                return '<input type="checkbox" class="select-one-row"
                data-role-id="' . $role->id . '" value="' . $role->id . '" '
                    . $isChecked . '>';
            })
            ->addColumn('users', function ($role) {
                return $role->users_count;
            })
            ->addColumn('permissions', function ($role) {
                return $role->permissions->map(
                    fn($permission) => '<span class="badge badge-success m-1">' . $permission->name . '</span>'
                )->join('');
            })
            ->addColumn('actions', function ($role) use ($currentUserRole) {
                $btnEdit = '<a class="btn btn-primary btn-edit"
                    data-role-id="' . $role->id . '">Edit</a>';

                $btnDelete = (
                    $role->name !== 'admin' && $role->id !== $currentUserRole
                )
                ? '<a class="btn btn-danger btn-delete"
                data-role-id="' . $role->id . '">Delete</a>' : '';

                return '<div class="btn-group btn-group-sm">' . $btnEdit . $btnDelete . '</div>';
            })
            ->rawColumns(['users', 'permissions', 'select', 'actions'])
            ->make(true);
    }
}
