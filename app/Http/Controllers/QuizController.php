<?php namespace App\Http\Controllers;

use App\Answers;
use App\Questions;
use App\Quiz;
use App\Options;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class QuizController extends Controller {

	public $skill_chart_stat = array();


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
		$answer = Answers::where('question_id','=',$id)->get();
		return $answer;
	}

	public function getAnswer($option_id){
		$option = Options::find($option_id);
		if(isset($option) && count($option) > 0){
			return $option;
		}
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
		$question_ids = \DB::table('question_categories')->select('question_id')->where('quiz_id','=',$id)->get();
		foreach($question_ids as $question){
			$options[$this->getQuestion($question->question_id)][] = \DB::table('options')->where('question_id','=',$question->question_id)->select('id','option','question_id')->get();
		}
		// echo '<pre>';
		// print_r($options);
		// echo '</pre>';
		//return $options;
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
				//Get the skill result
				$correct_answer_array = array_keys($correct_answer);
				$chart = $this->getSkillResult($correct_answer_array);
				$this->generatePdf($chart);
			}else{
				$correct_answer_count = 0;
				$correct_answer = null;
				$chart = null;
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
			$user_given_inputs = $input['option'];
			//Call the pdf creation and sending email function here to include the $skill data and user result data

			return view('result')->with(['chart' => $chart,'user_given_inputs' => $user_given_inputs,'percentage' => $success_percentage,'correct_answer' => $correct_answer,'wrong_answer' => $wrong_answer]);
		}else{
			return view('result')->with(['message' => 'You did not answer any question. Try again!']);
		}
	}

	//Calculate the skill result for piechart
	public function getSkillResult(&$ids){
		if(count($ids) > 0){
			foreach($ids as $id){
				$skill_id = \DB::table('skill_question')->join('skills','skill_question.skill_id','=','skills.id')->select('skills.id')->where('question_id','=',$id)->get();
				foreach($skill_id as $id){
					$skills_id_array[] = $id->id;
				}
			}
			// var_dump($skills_id_array);
			//Get the number of occurance of an skill into array
			$b = array_count_values($skills_id_array);
			//Make the array from $b
			$skill_id_array = array_keys($b);
			//Make the key, value pair of skill_id => $number_of_current_answer
			$a = array_combine($b,$skill_id_array);
			// var_dump($a);
			// var_dump($skill_id_array);
			foreach($a as $key => $value ){
				$skill_name = $this->getSkillName($key);
				$chart[$skill_name[0]->title] = round(($value *100)/count($ids));
			}
			$this->skill_chart_stat = $chart;
			return $chart;
		}
	}

	//Get the name of the skill
	public function getSkillName($id){
		$skill = \DB::table('skills')->where('id','=',$id)->get();
		return $skill;
	}


	//Populate the html file to be converted into pdf
	public function getUserStatsForPdf(){
		$user = \Auth::user();
		$user_stat = \DB::table('ressults')->where('user_id','=',$user->id)->get();
		return $user_stat;
	}
	public function getSkillStats(){
		$skill_stat = $this->skill_chart_stat;
		return $skill_stat;
	}

	//Generate pdf and
	public function generatePdf($chart){
		$file_name = time().'report.pdf';
		$file_path = public_path('report');
		$user_stat = $this->getUserStatsForPdf();
		$skill_stat = $chart;
		$htmlcontent = view('report.report')->with(['user_stat' => $user_stat,'skill_stat']);
		\PDF::loadHTML($htmlcontent)
			->setPaper('a4')
			->setOrientation('portrait')
			->save($file_path.$file_name);
		$mail_template = 'emails.email_report';
		$data['receipent_name'] = \Auth::user()->name;
		$data['receipent_email'] = \Auth::user()->email;
		$data['message'] = $message;
		$mail_receipents[\Auth::user()->email] = \Auth::user()->name;
		$mail_subject = 'Result Report';
		$mailMessage = 'Please see the report attatched for you order.';
		$mail_attachment = $file_path.$file_name;
		\Mail::send($mail_template,$data,
		function($mailMessage) use ($mail_receipents, $mail_subject, $mail_attachment){
			$message->to($mail_receipents)->subject($mail_subject);
			$message->attach($mail_attachment);
		});
		unlink($file_path.$file_name);
	}
}
