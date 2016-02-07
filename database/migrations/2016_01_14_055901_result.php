<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Result extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('results',function(Blueprint $table){
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('quiz_id');
			$table->integer('total_attempt');
			$table->integer('correct_answers');
			$table->float('percentage');
			$table->timestamp('added_on')->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('results');
	}

}
