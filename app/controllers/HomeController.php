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
			$rememberInput = (bool) \Input::get('rememberme');

			$user = \User::where(function($q) {
				$q->where('username', '=', \Input::get("username"));
				$q->orWhere('email', '=', \Input::get('username'));
			})->first();

			if (!$user) {
				return \Redirect::back()->withErrors(array('Please enter correct username and password.')); 
			}

			if (!$user->is_verified) {
				return \Redirect::back()->withErrors(array('Your account has not been activated yet. Try again later.')); 
			}

			if (!\Hash::check(\Input::get('password'), $user->password)) {
				return \Redirect::back()->withErrors(array('Please enter correct username and password.')); 
			}

			$result = \Auth::login($user, $rememberInput);

			return \Redirect::to('admin');
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
			 return \Redirect::back()
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

				return \Redirect::to('login')->withSuccess('Thank you for your registration!');
			} catch (\Exception $ex) {
				return \Redirect::back()
					->withErrors(array($ex->getMessage()))
					->withInput(\Input::except('password'));
			}
		}
	}
}