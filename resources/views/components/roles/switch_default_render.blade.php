@php
    $class = 'js-set-role-default';
    $id = 'set_role_default_' . ($role->id ?? '');
@endphp

<div class="custom-control custom-switch">
    <input class="custom-control-input {{ $class }}" 
        id="{{ $id }}" type="checkbox" value="{{ $role->id ?? '' }}" 
        @checked($role->is_default ?? false)>
        <label class="custom-control-label" for="{{ $id }}">
        </label>
    </input>
</div>