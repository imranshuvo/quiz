<?php namespace App\Http\Controllers;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UserController extends Controller {

	//Get user profile
	public function userProfile(){
		$user = User::where('id','=',\Auth::user()->id)->get()->first();
		$user_stats = \DB::table('results')->where('user_id','=',\Auth::user()->id)->paginate(10);
		return view('profile')->with(['user' => $user,'user_stats' => $user_stats]);
	}

}
