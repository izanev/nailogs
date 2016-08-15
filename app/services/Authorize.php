<?php

namespace Services;

class Authorize {
	protected $permissions = array();

	protected $role = null;

	public function __construct($permissions, \Role $currentRole) {
		$this->permissions = $permissions;

		$this->setCurrentRole($currentRole);
	}

	public function setCurrentRole(\Role $role) {
		$this->role = $role;
	}

	public function getCurrentRole() {
		return $this->role;
	}

	public function can($permission) {
		$roleName = $this->role->name;

		if (!isset($this->permissions[$roleName])) {
			return false;
		}

		$val = array_search($permission, $this->permissions[$roleName]);

		return ($val !== false);
	}

	public function authorize($permission) {
		if (!$this->can($permission)) {
			throw new AuthorizeException("'{$permission}' Permission denied");
		}
	}
}