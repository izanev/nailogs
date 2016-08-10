<?php

namespace Admin;

use BaseController;

class HomeController extends BaseController {

	public function __construct() {
		$this->layout = 'layouts.admin';

		\View::share('user', \Auth::user());
	}

	public function home() {
		return \View::make('admin.home');
	}

}
