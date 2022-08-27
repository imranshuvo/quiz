<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\QuizController;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\PasswordController;

use App\Http\Controllers\AdminController;

/*\
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [WelcomeController::class, 'index']);
Route::get('/verification/{confirmationCode}','UserController@verify');
Route::post('/Registration','UserController@Registered');

Route::get('home', [HomeController::class,'index']);
Route::get('contact',[ContactController::class, 'index']);
Route::post('contact-us','ContactController@create');
Route::get('quiz/{id}',['middleware' => 'auth','uses' => 'QuizController@getSingleQuiz']);

//Quiz submission and calculation
Route::post('quiz/result',['middleware' => 'auth','uses' => 'QuizController@result']);

Route::get('user/profile',['middleware' => 'auth', 'uses' => 'UserController@userProfile']);

// Route::get('/login', function(){
//     return 'Login page';
// });

// Route::controllers([
// 	'auth' => 'Auth\AuthController',
// 	'password' => 'Auth\PasswordController',
// ]);



//Admin routes
// Route::get('dashboard',['middleware' => ['auth','roles'],'uses' => 'AdminController@index','roles' => 'administrator']);
// Route::get('admin/quiz/new',['middleware' => ['auth','roles'],'uses' => 'AdminController@getCreateQuizPage','roles' => 'administrator']);
// Route::get('admin/quiz/all',['middleware' => ['auth','roles'], 'uses' => 'AdminController@getQuizes','roles' => 'administrator']);
// Route::get('admin/quiz/{id}',['middleware' => ['auth','roles'], 'uses' => 'AdminController@getQuiz','roles' => 'administrator']);
// Route::get('quiz/{id}/question/new',['middleware' => ['auth','roles'], 'uses' => 'AdminController@getNewQuestionPage','roles' => 'administrator']);
// Route::get('admin/question/{id}',['middleware' => ['auth','roles'], 'uses' => 'AdminController@getSingleQuestionPage','roles' => 'administrator']);
// Route::get('admin/skill/new',['middleware' => ['auth','roles'],'uses' => 'AdminController@getCreateSkillPage']);

// Route::post('new-quiz',['middleware' => ['auth','roles'] , 'uses' => 'AdminController@createNewQuiz','roles' => 'administrator']);
// Route::post('new-skill',['middleware' => ['auth','roles'] , 'uses' => 'AdminController@createNewSkill','roles' => 'administrator']);
// Route::post('quiz/{id}/question/add',['middleware' => ['auth','roles'] , 'uses' => 'AdminController@createNewQuestion','roles' => 'administrator']);
// Route::post('admin/question/answer/new',['middleware' => ['auth','roles'], 'uses' => 'AdminController@addAnswer','roles' => 'administrator']);
