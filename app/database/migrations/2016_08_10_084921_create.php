<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Create extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
      Schema::create('users', function(Blueprint $table) {
			$table->increments('id');

			$table->integer('role_id')->unsigned();

			$table->string('username', 64);
			$table->string('email', 64);
			$table->string('password', 64);

			// required for Laravel 4.1.26
			$table->rememberToken();
			$table->timestamps();

			$table->unique('email');
      });

      Schema::create('roles', function(Blueprint $table)
      {
			$table->increments('id');

			$table->string('name', 64);
			$table->string('description', 64);
      });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
		Schema::drop('roles');
	}

}
