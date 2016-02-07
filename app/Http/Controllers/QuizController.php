<?php namespace App\Http\Controllers;

use App\Answers;
use App\Questions;
use App\Quiz;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class QuizController extends Controller {


	public function fiterQuestion($id){
		$answers = \DB::table('answers')->where('question_id','=',$id)->get();
		if(count($answers) > 1){
			return true;
		}else {
			return false;
		}
	}

	//Get the question name
	public function getQuestion($id){
		$question = Questions::find($id);
		return $question->question_name;
	}

	//Get the options of a question
	public function getOptions($id){
		$options = \DB::table('options')->where('question_id','=',$id)->get();
		return $options;
	}

	//Get the right answer id of a question
	public function getSingleCorrectAnswer($id){
		$answer = \DB::table('answers')->where('question_id','=',$id)->get();
		return $answer;
	}

	//Get all the quiz
	public function getQuiz(){
		$quiz = Quiz::all();
		return $quiz;
	}

	//Get question number
	public function getQuestionNumber($id){
		$question_numbers = \DB::table('question_categories')->where('quiz_id','=',$id)->get();
		return count($question_numbers);
	}

	//Get quiz count
	public function getQuizNumber(){
		$quiz_number = \DB::table('quiz')->count();
		return $quiz_number;
	}

	//Get single quiz questions
	public function getSingleQuiz(Request $req,$id){
		$quiz = Quiz::find($id);
		$question_ids = \DB::table('question_categories')->where('quiz_id','=',$id)->get();
		foreach($question_ids as $question){
			$options[$this->getQuestion($question->id)][] = \DB::table('options')->where('question_id','=',$question->id)->select('id','option','question_id')->get();
		}
		return view('quiz')->with(['questions' => $options,'quiz' => $quiz]);
	}


	//Question answer submission and result calculation
	public function result(Request $req){
		$input = $req->all();
		if(isset($input['option'])){
			$array_of_options = $input['option'];
			foreach($array_of_options as $key => $value){
				//$key = question id
				//$value = user submitted answer
				$answer = Answers::select('option_id')->where('question_id','=',$key)->get();
				if(count($answer) === 1){
					//Single answer
					$answer = $answer->first();
					if($answer->option_id === $value){
						//User answer is correct
						$correct_answer[$key] = $value;
					}else{
						//User answer isn't correct
						$wrong_answer[$key] = $value;
					}
				}else{
					//Multiple answer
					foreach($answer as $ans){
						foreach ($value as $val) {
							if($ans->option_id === $val){
								$multiple_right_answer[] = $val;
							}
						}
					}
					if(isset($multiple_right_answer)){
						if(count($multiple_right_answer) === count($answer)){
							$correct_answer[$key] = $value;
						}else{
							$wrong_answer[$key] = $value;
						}
					}else{
						$wrong_answer[$key] = $value;
					}
				}//End of Multiple answer
				$multiple_right_answer = null;
			}
			if(isset($correct_answer)){
				$correct_answer_count = count($correct_answer);
			}else{
				$correct_answer_count = 0;
			}
			if(isset($wrong_answer)){
				$wrong_answer_count = count($wrong_answer);
			}else {
				$wrong_answer_count = 0;
				$wrong_answer = null;
			}
			$success_percentage = ($correct_answer_count * 100)/($correct_answer_count + $wrong_answer_count);
			$result_data = [
				'user_id' => \Auth::user()->id,
				'quiz_id' => $req->input('quiz_id'),
				'total_attempt' => ($correct_answer_count + $wrong_answer_count),
				'correct_answers' => $correct_answer_count,
				'percentage' => $success_percentage
			];
			\DB::table('results')->insert($result_data);
			return view('result')->with(['percentage' => $success_percentage,'correct_answer' => $correct_answer,'wrong_answer' => $wrong_answer]);
		}else{
			return view('result')->with(['message' => 'You did not answer any question. Try again!']);
		}
	}



}
