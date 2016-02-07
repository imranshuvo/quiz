<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ContactController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		return view('contact');
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create(Request $req)
	{
		$this->validate($req,[
			'name' => 'required',
			'email' => 'required|email',
			'message' => 'required'
		]);
		\Mail::send('emails.contact',
		array(
			'name' => $req->input('name'),
			'email' => $req->input('email'),
			'user_message' => $req->input('message')
		),function($message){
			$message->to('lightheartedshuvo@gmail.com','Qcmguru')->subject('Qcmguru Feedback!');
		});

		return redirect('contact')->with('msg','Thank you for conacting us.We will get back to you very soon!');
	}



}
