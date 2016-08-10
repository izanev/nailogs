<?php

class Role extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'roles';

	protected $primaryKey = 'id';

	public $timestamps = false;

	static public function findByName($name) {
		return self::where('name', '=', $name);
	}

	public function id() {
		return $this->id;
	}
}
