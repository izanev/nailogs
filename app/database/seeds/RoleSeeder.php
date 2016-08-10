<?php

class RoleSeeder extends Seeder {

	public function run()
	{
		\DB::table('roles')->delete();

		\Role::create(array(
			'name' => 'admin',
			'description' => 'Admin role capable of managing cases and verifying users'
		 ));

		\Role::create(array(
			'name' => 'user',
			'description' => 'Default user role capable of submitting cases, generating reports.'
		 ));
	}

}