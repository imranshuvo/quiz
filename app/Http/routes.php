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
Route::get('admin/quiz/new',['middleware' => 'auth','uses' => 'AdminController@getCreateQuizPage']);
Route::get('admin/quiz/all',['middleware' => 'auth', 'uses' => 'AdminController@getQuizes']);
Route::get('admin/quiz/{id}',['middleware' => 'auth', 'uses' => 'AdminController@getQuiz']);
Route::get('quiz/{id}/question/new',['middleware' => 'auth', 'uses' => 'AdminController@getNewQuestionPage']);
Route::get('admin/question/{id}',['middleware' => 'auth', 'uses' => 'AdminController@getSingleQuestionPage']);

Route::post('new-quiz',['middleware' => 'auth' , 'uses' => 'AdminController@createNewQuiz']);
Route::post('quiz/{id}/question/add',['middleware' => 'auth' , 'uses' => 'AdminController@createNewQuestion']);
Route::post('admin/question/answer/new',['middleware' => 'auth', 'uses' => 'AdminController@addAnswer']);
