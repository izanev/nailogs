<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'index', 'uses' => 'HomeController@home'));
Route::get('login', array('as' => 'login', 'uses' => 'HomeController@showLogin'));
Route::get('logout', array('as' => 'logout', 'uses' => 'HomeController@doLogout'));
Route::get('register', array('as' => 'register', 'uses' => 'HomeController@showRegister'));

Route::post('login', array('as' => 'doLogin', 'uses' => 'HomeController@doLogin'));
Route::post('register', array('as' => 'doRegister', 'uses' => 'HomeController@doRegister'));

Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'before' => 'auth'], function()
{
    Route::get('/', array('as' => 'home', 'uses' => 'HomeController@home'));
	 Route::get('users', array('as' => 'users.list', 'uses' => 'UsersController@showList'));
	 Route::get('users/verify', array('as' => 'users.verify', 'uses' => 'UsersController@doVerify'));
	 Route::get('cases', array('as' => 'cases.list', 'uses' => 'CasesController@showList'));
	 Route::get('cases/add', array('as' => 'cases.add', 'uses' => 'CasesController@showAdd'));
	 Route::get('cases/view/{case_id}', array('as' => 'cases.view', 'uses' => 'CasesController@showView'));
	 Route::get('cases/remove/{case_id}', array('as' => 'cases.remove', 'uses' => 'CasesController@doRemove'));

	 Route::post('cases/add', array('as' => 'cases.doAdd', 'uses' => 'CasesController@doAdd'));
	 Route::post('cases/update/{case_id}', array('as' => 'cases.doUpdate', 'uses' => 'CasesController@doUpdate'));
});