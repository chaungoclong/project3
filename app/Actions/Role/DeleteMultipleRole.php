<?php 

namespace App\Actions\Role;

use App\Models\Role;

class DeleteMultipleRole
{
	private Role $role;

	public function __construct(Role $role)
	{
		$this->role = $role;
	}

	public function execute($ids)
	{
		$ids = explode(',', $ids);
		return $this->role->whereIn('id', $ids)->delete();
	}
}