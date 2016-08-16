<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Cases extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cases', function($table) {
			$table->increments('id');

			$table->integer('user_id')->unsigned();

			$table->string('client_name', 64);
			$table->tinyInteger('child_age')->default(0);
			$table->string('ref_no', 12);
			$table->string('hotel', 64);
			$table->string('room_number', 4);
			$table->string('resort', 64);
			$table->dateTime('arrival_date');
			$table->dateTime('accident_date');
			$table->string('location', 64);
			$table->string('weather_conditions', 255);
			$table->dateTime('report_date');
			$table->text('description');
			$table->string('guest_opinion', 255);
			$table->string('action_taken', 255);
			$table->dateTime('inspection_date');
			$table->text('factual_account');
			$table->text('medical_assistance');

			$table->unique('ref_no');

			$table->timestamps();

			$table->softDeletes();
		});

		Schema::create('case_files', function($table) {
			$table->increments('id');

			$table->integer('case_id')->unsigned();
			$table->string('file', 64);

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('cases');
		Schema::dropIfExists('case_files');
	}

}
