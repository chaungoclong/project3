<div class="d-inline-flex">
   @if ($role->is_user_defined 
        && $role->id !== $currentRoleId 
        && $role->name !== 'admin')
       <a class="p-1 js-delete-role" data-role-id="{{ $role->id ?? '' }}" 
            title="Xóa">
            <i class="far fa-trash-alt fa-lg text-danger"></i>
        </a>
   @endif

    @if ($role->name !== 'admin' && $role->id !== $currentRoleId)
        <a href="{{ route('admin.roles.edit', $role->id ?? '') }}" class="p-1" title="Sửa">
            <i class="far fa-edit fa-lg text-primary"></i>
        </a>
    @endif
</div>