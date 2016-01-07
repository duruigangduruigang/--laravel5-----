<?php namespace App\Http\Controllers\Admin;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Feedback;
use App\Message;
use App\Comment;
use App\Category;
use Auth;
class AdminController extends Controller {

	/**
	 * 判断是否为管理员
	 */

	public function __construct()
	{
		if($this->middleware('auth'));
		$user = User::find(Auth::id());
		$admin = $user->admin;
		if($admin != 1)
		{
			Auth::logout();
		}
	}


	public function index()
	{
		return view('admin.home');
	}



	/**
	 * 获取管理员信息
	 */
	public function admin_info()
	{
		return User::find(Auth::id())->email;
	}

	/**
	 * 更新管理员信息
	 */
	public function update_admin(Request $request)
	{
		$user = User::find(Auth::id());
		$user->email = $request->name;
		if($request->pass != 'default'){
			$user->password = Hash::make($request->pass);
		}
		echo $user->save();
	}

	/**
	 * 获取feedback
	 */
	public function feedback(Request $request)
	{
		return $feedback = Feedback::orderby('created_at','desc')->paginate(10);
	}

	/**
	 * 获取feedback_info
	 */
	public function feedback_info($id)
	{
		return Feedback::find($id);
	}

	/**
	 * 获取users
	 */
	public function users(Request $request)
	{

		$users = User::orderby('created_at','desc')->paginate(10);
		$n = count($users);
		for($i=0;$i<$n;++$i)
		{
			$users[$i]->last_time = $this->t_time($users[$i]->updated_at);
			$users[$i]->homepage = '/Profile/'.$users[$i]->id;
		}
		return $users;
	}

	/**
	 * 获取messages
	 */
	public function messages(Request $request)
	{

		$messages = Message::orderby('created_at','desc')->paginate(10);
		$n = count($messages);
		for($i=0;$i<$n;++$i)
		{
			$messages[$i]->last_time = $this->t_time($messages[$i]->created_at);
			$messages[$i]->homepage = '/message_info/'.$messages[$i]->id;
			$messages[$i]->userhomepage = '/Profile/'.$messages[$i]->user_id;
			$messages[$i]->name = User::find($messages[$i]->user_id)->name;//头像与昵称
			$messages[$i]->Category = Category::find($messages[$i]->category)->name;//分类
			$messages[$i]->Categorys_color = Category::find($messages[$i]->category)->color;//分类
		}
		return $messages;
	}

	/**
	 * 删除message
	 */
	public function del_message($id)
	{
		Message::find($id)->delete();
		Comment::where('message_id', '=', $id)->delete();
		return $id;
	}

	/**
	 * 获取category
	 */
	public function category()
	{
		$category = Category::get();
		$n = count($category);
		for($i=0;$i<$n;++$i)
		{
			$category[$i]->messages_num = Message::where('category',$category[$i]->id)->count();
		}
		return $category;
	}

	/**
	 * 获取category_edit数据
	 */
	public function category_edit($id)
	{
		return Category::find($id);
	}

	/**
	 * 获取category_edit数据
	 */
	public function category_add($name,$color)
	{
		$category = new Category;
		$category->name = $name;
		$category->color = $color;
		$category->save();
	}

	/**
	 * 完成cate的update
	 */
	public function category_update(Request $request)
	{
		$id = $request->id;
		$name = $request->name;
		$color = $request->color;
		$category = Category::find($id);
		$category->name = $name;
		$category->color = $color;
		$category->save();
		return 1;
	}

	/**
	 * 删除message
	 */
	public function logout()
	{
		Auth::logout();
		return redirect('/');
	}
}