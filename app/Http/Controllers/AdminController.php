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
		$quiz = Quiz::find($id);
		return view('admin.single-quiz')->with(['question_ids' => $question_ids,'quiz' => $quiz ]);
	}

	public function getQuizQuestion($id){
		$question = Questions::find($id);
		if(count($question) > 0){
			return $question;
		}
	}

	/**
	*  get the new question page
	*
	**/
	public function getNewQuestionPage($id){
		$quiz_id = $id;
		return view('admin.create-question')->with(['quiz_id' => $quiz_id]);
	}

	/**
	*
	*
	**/
	public function getSingleQuestion($id){
		$question = Question::find($id);
	}


	/**
	*
	* Create a quiz
	**/
	public function createNewQuiz(Request $req){
		$data = [
			'quiz_name' => $req->input('quiz_name')
		];
		$this->validate($req,[
			'quiz_name' => 'required'
		]);
		if(Quiz::create($data)){
			return redirect('admin/quiz/all');
		}
	}

	/**
	* Create new question
	*
	**/
	public function createNewQuestion(Request $req,$id){
		$quiz_id = $id;
		$question_table_data = [
			'question_name' => $req->input('question_name')
		];
		$this->validate($req,[
			'question_name' => 'required'
		]);
		$question_id = \DB::table('questions')->insertGetId($question_table_data);
		if($question_id != null){
			\DB::table('question_categories')->insert([
				'question_id' => $question_id,
				'quiz_id' => $quiz_id,
			]);
			$options_table_data =[
				['option' => $req->input('option1'),'question_id' => $question_id],
				['option' => $req->input('option2'),'question_id' => $question_id],
				['option' => $req->input('option3'),'question_id' => $question_id],
				['option' => $req->input('option4'),'question_id' => $question_id]
			];

			\DB::table('options')->insert($options_table_data);
			return redirect()->back()->withErrors(['Question added successfully! Go to the question page to add answers or continue adding questions!']);
		}else{
			return redirect()->back()->withErrors(['Something went wrong! Please try again or contact the developer!']);
		}
	}


	/**
	*
	* Get single question page
	**/
	public function getSingleQuestionPage($id){
		$question = Questions::find($id);
		$is_answered = Answers::find($id);
		return count($is_answered);
		if(count($question) > 0){
			return view('admin.single-question')->with(['question' => $question]);
		}
	}
}
