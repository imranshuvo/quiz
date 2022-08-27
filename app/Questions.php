<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model {

	//
	protected $table = 'questions';

	public function options(){
		return $this->hasMany('App\Options','question_id');
	}

}
