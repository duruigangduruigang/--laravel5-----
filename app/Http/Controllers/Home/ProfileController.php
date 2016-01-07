<?php namespace App\Http\Controllers\Home;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\User;
use DB;
use Auth;
class ProfileController extends Controller {
	/**
	 * 个人中心
	 * 所有帖子&个人信息
	 */
	public function index($id)
	{
		$user = User::find($id);
		$user->hd = $this->t_time($user->updated_at);//最后一次活动

		$tz = DB::table('messages')
             ->select(DB::raw('messages.id,messages.user_id,messages.title,messages.content,messages.created_at,users.name,users.id as uid'))
             ->leftJoin('users','messages.user_id','=','users.id')
             ->where('user_id', '=', $id)
             ->orderBy('messages.created_at','desc')
             ->take(1)
             ->get();
        if(empty($tz)){
        	$user->tz = '从未有过';
        }else{
        	$user->tz = $this->t_time($tz[0]->created_at);//最后一贴距今的时间
		}
		// 个人的所有帖纸.
		$messages = DB::table('messages')
             ->select(DB::raw('messages.id,messages.user_id,messages.title,messages.content,messages.created_at,users.name,users.id as uid'))
             ->leftJoin('users','messages.user_id','=','users.id')
             ->where('user_id', '=', $id)
             ->orderBy('messages.created_at','desc')
             ->paginate(30);

        $data = [
            'user'  =>  $user,
            'index' =>  $messages
        ];
        return view('home.profile',$data);
        // return view('home.profile',['user' => $user],['index' => $messages]);
	}
}