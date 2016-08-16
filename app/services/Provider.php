<?php

namespace Services;

use Illuminate\Support\ServiceProvider;

class Provider extends ServiceProvider {

	public function register() {
		$permissions = array(
			'admin' => array(
				'list_users',
				'verify_user',
				'list_cases',
				'add_case',
				'remove_case',
				'logout'
			),
			'user' => array(
				'list_cases',
				'add_case',
				'logout'
			),
			'guest' => array(
				'login'
			)
		);

		$this->app->bind('nai.authorizeService', function($app) use ($permissions) {
			$user = \Auth::user();

			if (!$user) {
				$role = new \Role();
				$role->name = 'guest';
			} else {
				$role = $user->role;
			}

			return new Authorize($permissions, $role);
		});
	}

	public function boot() {
		if (\Auth::check()) {
			$authorize = \App::make('nai.authorizeService');

			\View::share('authUser', \Auth::user());

			\View::share('can', function($perm) use($authorize) {
				return $authorize->can($perm);
			});

			\View::share('canManageUsers', function() use($authorize) {
				return $authorize->can('list_users');
			});

			\View::share('renderCaseResort', function(\CaseModel $case) {
				return $case->resort;
			});

			\View::share('renderDate', function($date) {
				if (is_object($date)) {
					return $date->format('Y-m-d');
				} else {
					return 'N/A';
				}
			});

			\Form::macro('dateValue', function($name) {
				 // Use Form::getValueAttribute() to get the value
				 $value = \Form::getValueAttribute($name);

				 if (!is_object($value)) {
					 return $value;
				 }

				 return $value->format('Y-m-d');
			});
		}

		\View::share('success', \Session::get('success'));

		\View::share('showVerificationStatus', function($user) {
			if ($user->is_verified) {
				return "Verified";
			} else {
				return "Not Verified";
			}
		});

		\Event::listen('user.verified', function ($user) {
			// send user welcome email
			$data['user'] = $user;

			\Mail::send('emails.welcome', $data, function($message) use ($user) {
				$message->to($user->email)->subject('Welcome to NAI Logs!');
			});
		});
	}
}