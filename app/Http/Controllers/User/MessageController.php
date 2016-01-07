<?php namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;



use App\Message;
use App\Comment;
use App\Category;
use DB;
use Redirect, Input, Auth;
class MessageController extends Controller {
	/**
	 * 显示新建消息页面
	 *
	 * @return view
	 */
	public function index()
	{
		$Category = Category::all();
		return view('user.create_message')->withcategory($Category);
	}

	/**
	 * 处理新建消息
	 *
	 * @return Redirect
	 */
	public function create_message(Request $request)
	{
		$this->validate($request,[
				'title' => 'required|unique:messages|max:10',
				'content'	=> 'required',
			]);
		
		$message = new Message;
		$message->title = Input::get('title');
		$message->content = Input::get('content');
		$message->user_id = Auth::user()->id;
		$message->Category = Input::get('optionsRadios');
		//如果optionsRadios不等于Categorys表中任何一个id,则重定向到上边的index方法
		$c = DB::table('categories')->select('id')->get();
		$arr = array();
		foreach ($c as $key => $value) {
			$arr[] = $value->id;
		}
		if(!in_array($message->Category,$arr)){
			return Redirect::to('/user/message');//分类不合法
		};

		if ($message->save())
		{
			return Redirect::to('/');
		}
		else
		{
			return Redirect::back()->withInput()->withErrors('发布失败!');
		}
	}

	/**
	 * 评论
	 * @return bool
	 */
	public function comments(Request $request)
	{
		$comment = new Comment;
		$comment->content = $request->content;
		$comment->message_id = $request->message_id;
		$comment->user_id = Auth::id();
		$comment->message_user_id = Message::find($request->message_id)['user_id'];
		$comment->save();
		return Redirect('/message_info'.'/'.$request->message_id);
	}

	/**
	 * 帖子动态
	 */
	public function me()
	{
		$c = DB::table('comments as c')
		->leftJoin('messages as m','c.message_id','=','m.id')
		->leftJoin('users as u','c.user_id','=','u.id')
		->where(['c.message_user_id'=>Auth::id()])
		->select('c.*','m.title','u.name','m.category')
		->orderBy('c.created_at','desc')
		->paginate(30);
		foreach ($c as $key => $value) {
			$find = Category::find($value->category);
			$value->color = $find->color;
			$value->categoryid = $find->id;
			$value->category = $find->name;
			$value->created_at = $this->t_time($value->created_at);
			// $value->color = Category::find($value->category)->color;
			// $value->categoryid = Category::find($value->category)->id;
			// $value->category = Category::find($value->category)->name;
			// $value->created_at = $this->t_time($value->created_at);
		}
		return view('user.me')->withc($c);
	}
}
