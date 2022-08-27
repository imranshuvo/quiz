<?php

use App\Quiz;
use Illuminate\Database\Seeder;
class QuestionsTableSeeder extends Seeder{

	public function run(){
        $questions = [
			[
				'id' => 1,
				'question_name' => 'Un mur en pisé est composé principalement de',
			],
			[
				'id' => 2,
				'question_name' => 'Un logement avec des menuiseries simple vitrage a pu être construit avant',
			],
			[
				'id' => 3,
				'question_name' => 'Un moellon est',
			],
			[
				'id' => 4,
				'question_name' => 'Un doublage mural composé d un vide d air a pu être mis en œuvre avant',
			],
			[
				'id' => 5,
				'question_name' => 'Un IPN est'
			]
		];

        \DB::table('questions')->insert($questions);
	}
}
