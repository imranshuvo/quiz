<?php

use App\Quiz;
use Illuminate\Database\Seeder;
class QuestionCategoriesTableSeeder extends Seeder{

	public function run(){
        $questionCategories = [
			[
				'id' => 1,
				'question_id' => 1,
				'quiz_id' => 1,
			],
			[
				'id' => 2,
				'question_id' => 2,
				'quiz_id' => 1
			],
			[
				'id' => 3,
				'question_id' => 3,
				'quiz_id' => 1
			],
			[
				'id' => 4,
				'question_id' => 4,
				'quiz_id' => 1
			],
			[
				'id' => 5,
				'question_id' => 5,
				'quiz_id' => 1
			]
		];

        \DB::table('question_categories')->insert($questionCategories);
	}
}
