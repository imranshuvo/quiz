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
		$skills = \DB::table('skills')->get();
		return view('admin.create-question')->with(['quiz_id' => $quiz_id,'skills' => $skills]);
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
			'question_name' => 'required',
			'skill' => 'required',
		]);
		$question_id = \DB::table('questions')->insertGetId($question_table_data);
		if($question_id != null){
			\DB::table('question_categories')->insert([
				'question_id' => $question_id,
				'quiz_id' => $quiz_id,
			]);
			\DB::table('skill_question')->insert([
				'skill_id' => $req->input('skill'),
				'question_id' => $question_id
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
		$is_answered = count(Answers::where('question_id','=',$id)->get());
		if($is_answered > 0){
			$is_answered = true;
		}else{
			$is_answered = false;
		}
		if(count($question) > 0){
			return view('admin.single-question')->with(['question' => $question, 'is_answered' => $is_answered]);
		}
	}

	/**
	*
	* Adding answer to a single question
	**/
	public function addAnswer(Request $req){
		$answers = $req->input('option');
		foreach($answers as $answer){
			\DB::table('answers')->insert(
				['option_id' => $answer,'question_id' => $req->input('question_id')]
			);
		}
		return redirect()->back()->withErrors(['Answer added successfully!']);
	}


	/**
	*
	* Getting the create skill page
	**/
	public function getCreateSkillPage(){
		return view('admin.create-skill');
	}
	public function createNewSkill(Request $req){
		$data = [
			'title' => $req->input('skill_name'),
		];
		$this->validate($req,[
			'skill_name' => 'required'
		]);
		if(\DB::table('skills')->insert($data)){
			return redirect()->back()->withErrors(['New skill added successfully!']);
		}
	}
}
