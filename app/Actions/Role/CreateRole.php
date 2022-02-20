<?php 

namespace App\Actions\Role;

class CreateRole
{
	private Role $role;

	public function __construct(Role $role)
	{
		$this->role = $role;
	}

	public function execute(array $data)
	{
		return $this->role->create($data);
	}
}