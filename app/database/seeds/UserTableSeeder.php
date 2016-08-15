<?php

class UserTableSeeder extends Seeder {

	public function run()
	{
		\DB::table('users')->delete();

		$adminRole = \Role::findByName('admin')->first();

		\User::create(array(
			'role_id' => $adminRole->id(),
			'username' => 'admin',
			'email' => 'admin@admin.balkan',
			'password' => Hash::make('admin'),
			'is_verified' => 1
		 ));
	}

}