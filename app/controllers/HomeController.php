<?php

class HomeController extends BaseController {

	public function home() {
		return $this->showLogin();
	}

	public function showLogin() {
		return \View::make('login');
	}

	public function doLogin() {
		// validate the info, create rules for the inputs
		$rules = array(
			 'username' => 'required',
			 'password' => 'required'
		);

		// run the validation rules on the inputs from the form
		$validator = \Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			 return Redirect::to('login')
				  ->withErrors($validator) // send back all errors to the login form
				  ->withInput(\Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {

			 // create our user data for the authentication
			 $userdata = array(
				  'email'     => \Input::get('username'),
				  'password'  => \Input::get('password')
			 );

			 // create our user data for the authentication
			 $userdata2 = array(
				  'username' => \Input::get('username'),
				  'password' => \Input::get('password')
			 );

			 $rememberInput = (bool) \Input::get('rememberme');

			 // attempt to do the login
			 if (\Auth::attempt($userdata, $rememberInput) || \Auth::attempt($userdata2, $rememberInput)) {

				  return \Redirect::to('admin');

			 } else {

				  // validation not successful, send back to form 
				  return \Redirect::to('login');

			 }

		}
	}

	public function doLogout() {
		Auth::logout(); // log the user out of our application
		return Redirect::to('login'); // redirect the user to the login screen
	}

	public function showRegister() {
		return \View::make('register');
	}

	public function doRegister() {
		// validate the info, create rules for the inputs
		$rules = array(
			 'username' => 'required',
			 'email' => 'required|email',
			 'password' => 'required'
		);

		// run the validation rules on the inputs from the form
		$validator = \Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			 return \Redirect::to('register')
				  ->withErrors($validator) // send back all errors to the login form
				  ->withInput(\Input::except('password')); // send back the input (not the password) so that we can repopulate the form
		} else {
			try {
				$userRole = \Role::findByName('user')->first();

				if (!$userRole) {
					throw new \Exception("Could not find 'user' role!");
				}

				\Eloquent::unguard();

				\User::create(array(
					'role_id' => $userRole->id(),
					'username' => \Input::get('username'),
					'email' => \Input::get('email'),
					'password' => Hash::make(\Input::get('password'))
				));

				\Eloquent::guard();

				return \Redirect::to('login')->withSuccess('Thank you for your registration!');
			} catch (\Exception $ex) {
				return \Redirect::to('register')
					->withError($ex->getMessage())
					->withInput(\Input::except('password'));
			}
		}
	}
}