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
Route::get('quiz/{id}',['middleware' => 'auth','uses' => 'QuizController@getSingleQuiz']);
// Route::get('result',['middleware' => 'auth', 'uses' => 'QuizController@result']);
// // Route::get('quiz/result/{id}',['middleware' => 'auth', 'uses' => 'QuizController@SingleResult']);
// // Route::get('quiz/result/last/{id}',['middleware' => 'auth', 'uses' => 'QuizController@getResult']);


//Quiz submission and calculation
Route::post('quiz/result',['middleware' => 'auth','uses' => 'QuizController@result']);

Route::get('user/profile',['middleware' => 'auth', 'uses' => 'UserController@userProfile']);
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
