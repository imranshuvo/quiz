<?php

use App\Quiz;
use Illuminate\Database\Seeder;
class QuizTableSeeder extends Seeder{

	public function run(){
        $quizes = [
			[
				'id' => 1,
				'quiz_name' => 'First Test Quiz',
				'quiz_number' => 1
			]
		];

        \DB::table('quiz')->insert($quizes);
	}
}
