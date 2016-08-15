<?php

namespace Admin;

use BaseController;

class UsersController extends BaseController {

	public function __construct() {
		$this->layout = 'layouts.admin';
	}

	public function showList() {
		$users = \User::paginate(10);

		return \View::make('admin.users.list', array(
			'users' => $users
		));
	}

	public function loadUser($id) {
		$user = \User::find($id);

		if (!$user) {
			throw new \Exception("User not found");
		}

		return $user;
	}

	public function doVerify() {
		$id = (int) \Input::get('user_id');

		try {
			$this->getAuthorizeService()->authorize('verify_user');

			$user = $this->loadUser($id);

			$user->is_verified = true;
			$user->save();

			$response = \Event::fire('user.verified', array($user));

			return \Redirect::back()->withSuccess('User verified successfully!');
		} catch (\Exception $ex) {
			return \Redirect::back()->withErrors(array($ex->getMessage()));
		}
	}
}
