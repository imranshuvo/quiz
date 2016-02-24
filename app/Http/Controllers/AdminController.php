<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Quiz;
use App\Questions;
use App\QuestionCategories;
use App\Options;
use App\Answers;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
		return view('admin.index');
	}



	/**
	* Create new quiz page
	*
	*/
	public function getCreateQuizPage(){
		return view('admin.create');
	}



	/**
	* Get all the quizes
	*
	**/
	public function getQuizes(){
		$quizes = Quiz::all();
		return view('admin.quiz')->with(['quizes' => $quizes]);
	}

	/**
	* Get questions of a single quiz
	*
	**/

	public function getQuiz($id){
		$question_ids = QuestionCategories::where('quiz_id','=',$id)->get();
		$quiz_name = Quiz::find($id)->quiz_name;
		return view('admin.single-quiz')->with(['question_ids' => $question_ids,'quiz_name' => $quiz_name ]);
	}

	public function getQuizQuestion($id){
		$question = Questions::find($id);
		if(count($question) > 0){
			return $question;
		}
	}

}
