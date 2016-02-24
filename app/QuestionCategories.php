<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionCategories extends Model {

	//
	protected $table = 'question_categories';

	protected $fillable = ['question_id','quiz_id'];


	public function quiz(){
		return $this->belongsTo('App\Quiz','id','quiz_id');
	}

}
