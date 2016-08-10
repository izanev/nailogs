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

Route::get('/', array('uses' => 'HomeController@home'));
Route::get('login', array('as' => 'login', 'uses' => 'HomeController@showLogin'));
Route::get('logout', array('as' => 'logout', 'uses' => 'HomeController@doLogout'));
Route::get('register', array('as' => 'register', 'uses' => 'HomeController@showRegister'));

Route::post('login', array('as' => 'doLogin', 'uses' => 'HomeController@doLogin'));
Route::post('register', array('as' => 'doRegister', 'uses' => 'HomeController@doRegister'));

Route::group(['prefix' => 'admin', 'namespace' => 'admin', 'before' => 'auth'], function()
{
    Route::resource('/', 'HomeController@home');
});