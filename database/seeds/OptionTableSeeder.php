<?php

use App\Quiz;
use Illuminate\Database\Seeder;
class OptionTableSeeder extends Seeder{

	public function run(){
        $options = [
			[
				'id' => 1,
				'question_id' => 1,
				'option' => 'paille'
			],
			[
				'id' => 2,
				'question_id' => 1,
				'option' => 'terre'
			],
			[
				'id' => 3,
				'question_id' => 1,
				'option' => 'mache-fer'
			],
			[
				'id' => 4,
				'question_id' => 1,
				'option' => 'chanvre'
			],
			[
				'id' => 5,
				'question_id' => 2,
				'option' => '1992'
			],
			[
				'id' => 6,
				'question_id' => 2,
				'option' => '1985'
			],
			[
				'id' => 7,
				'question_id' => 2,
				'option' => '1988'
			],
			[
				'id' => 8,
				'question_id' => 2,
				'option' => '1975'
			],
			[
				'id' => 9,
				'question_id' => 3,
				'option' => 'un bloc de terre'
			],
			[
				'id' => 10,
				'question_id' => 3,
				'option' => 'un bloc ciment'
			],
			[
				'id' => 11,
				'question_id' => 3,
				'option' => 'un petit bloc de pierre'
			],
			[
				'id' => 12,
				'question_id' => 3,
				'option' => 'un bloc creux'
			],
			[
				'id' => 13,
				'question_id' => 4,
				'option' => '1990'
			],
			[
				'id' => 14,
				'question_id' => 4,
				'option' => '2000'
			],
			[
				'id' => 15,
				'question_id' => 4,
				'option' => '2007'
			],
			[
				'id' => 16,
				'question_id' => 4,
				'option' => '2005'
			],
			[
				'id' => 17,
				'question_id' => 5,
				'option' => 'un profilé acier de section normalisée'
			],
			[
				'id' => 18,
				'question_id' => 5,
				'option' => 'un profilé bois de section normalisée'
			],
			[
				'id' => 19,
				'question_id' => 5,
				'option' => 'un indice de poussée normalisé'
			],
			[
				'id' => 20,
				'question_id' => 5,
				'option' => 'un indice de pression normalisé'
			]
		];

        \DB::table('options')->insert($options);
	}
}
