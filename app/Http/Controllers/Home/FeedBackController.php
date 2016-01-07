<?php namespace App\Http\Controllers\Home;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Feedback;
class FeedBackController extends Controller {
	public function index()
	{
		return view('feedback.index');
	}
	public function feed(Request $request)
	{
		if($request->content == '') return redirect('/feedback');
		$user = new Feedback;
		$user->feed = $request->content;
		$user->save();
		return redirect('/');
	}
}