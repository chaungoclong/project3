@php
$status = '';

if (in_array($role->id, $checkeds)) {
	$status = 'checked';
}

if ($role->id === $currentRoleId 
	|| !$role->is_user_defined
	|| $role->name === 'admin'
) {
    $status = 'disabled';
}
@endphp

<div>
    <input class="js-select-one-role" data-role-id="{{ $role->id ?? '' }}" type="checkbox" 
    	value="{{ $role->id ?? '' }}" {{ $status }} style="width: 18px; height: 18px;">
    </input>
</div>