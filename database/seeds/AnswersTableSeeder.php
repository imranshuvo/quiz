<?php

use App\Quiz;
use Illuminate\Database\Seeder;
class AnswersTableSeeder extends Seeder{

	public function run(){
        $answers = [
			[
				'id' => 1,
				'question_id' => 1,
				'option_id' => 2
			],
			[
				'id' => 2,
				'question_id' => 2,
				'option_id' => 8
			],
			[
				'id' => 3,
				'question_id' => 3,
				'option_id' => 11
			],
			[
				'id' => 4,
				'question_id' => 3,
				'option_id' => 12
			],
			[
				'id' => 5,
				'question_id' => 4,
				'option_id' => 13
			],
			[
				'id' => 6,
				'question_id' => 5,
				'option_id' => 17
			]
		];

        \DB::table('answers')->insert($answers);
	}
}
