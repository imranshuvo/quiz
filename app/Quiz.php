<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model {

	//
	protected $table = 'quiz';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['quiz_name','quiz_number'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */

	 public function questionCategories(){
		 return $this->hasOne('App\QuestionCategories');
	 }


}
