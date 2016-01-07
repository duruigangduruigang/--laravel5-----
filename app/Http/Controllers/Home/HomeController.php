<?php namespace App\Http\Controllers\Home;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Message;
use App\User;
use App\Category;
use DB;
class HomeController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($id='')
	{

		$Category = Category::all();

		$c = DB::table('categories')->select('id')->get();

		$arr = array();
		foreach ($c as $key => $value) {
			$arr[] = $value->id;
		}

		if(!in_array($id,$arr)){
			$index = DB::table('messages as m')
			->leftJoin('users as u','m.user_id','=','u.id')
			->leftJoin('categories as c','m.category','=','c.id')
			->select('m.*','u.face','c.name','c.color','c.id as cid')
			->orderBy('m.created_at','desc')
			->paginate(30);
		}else{
			//指定了分类
			$index = DB::table('messages as m')
			->leftJoin('users as u','m.user_id','=','u.id')
			->leftJoin('categories as c','m.category','=','c.id')
			->select('m.*','u.face','c.name','c.color','c.id as cid')
			->where('m.category','=',$id)
			->orderBy('m.created_at','desc')
			->paginate(30);
		}

		$data = [
			'index' => $index,
			'category' => $Category
		];

		return view('home.index',$data);
		// return view('home.index',['index' => $index,'category' => $Category]);
	}
	
	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function message_info($id)
	{
		$message = Message::find($id);
		$message->face = User::find($message->user_id)->face;
		$cate = Category::find($message->category);
		$message->class_id = $cate->id;
		$message->class = $cate->name;
		$message->color = $cate->color;
		//所属评论
		// comments表中属于这个id的评论数据
		$comments = DB::table('comments')
                     ->select(DB::raw('comments.content,comments.user_id,comments.created_at,users.name,users.face,users.word,users.id as uid'))
                     ->leftJoin('users','comments.user_id','=','users.id')
                     ->where('comments.message_id','=',$id)
                     ->orderBy('comments.created_at','desc')
                     ->paginate(30);
		foreach ($comments as $key => $value) {
			$value->created_at = $this->t_time($value->created_at);
		}
		// return view('home.message_info')->withmessage_info($message)->withcomments($comments);

		$data = [
			'message_info' => $message,
			'comments' => $comments
		];
		return view('home.message_info',$data);
	}
}