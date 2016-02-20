<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');
Route::get('contact','ContactController@index');
Route::post('contact-us','ContactController@create');
Route::get('quiz/{id}',['middleware' => 'auth','uses' => 'QuizController@getSingleQuiz']);

//Quiz submission and calculation
Route::post('quiz/result',['middleware' => 'auth','uses' => 'QuizController@result']);

Route::get('user/profile',['middleware' => 'auth', 'uses' => 'UserController@userProfile']);
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);



//Admin routes
Route::get('dashboard',['middleware' => 'auth','uses' => 'AdminController@index']);