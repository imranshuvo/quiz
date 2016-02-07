<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		// $this->call('UserTableSeeder');
		// $this->call('QuestionSeeder');
		// $this->call('QuizTableSeeder');
		// $this->call('QuestionsTableSeeder');
		// $this->call('QuestionCategoriesTableSeeder');
		// $this->call('OptionTableSeeder');
		// $this->call('AnswersTableSeeder');
	}

}
