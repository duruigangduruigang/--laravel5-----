<?php namespace App\Http\Controllers\User;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Redirect, Input, Auth,Validator;
use DB;
use Hash;
use App\User;
class SettingController extends Controller {
	/**
	 * 个人设置视图
	 *
	 * @return View
	 */
	public function index()
	{
		$user = User::find(Auth::id());
		return view('user.settings',['user' => $user]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function update()
	{
		$name = Input::get('username');
		$word = Input::get('most');
		$connection = Input::get('contact');
		$url = Input::get('url');
		$password = Input::get('pass');

		if($name == ''||$password == ''){return Redirect('/user/settings');}

		$user = User::find(Auth::id());
		$user->name = $name;
		$user->word = $word;
		$user->connection = $connection;
		$user->url = $url;
		$user->password = Hash::make($password);
		
		if($user->save()){return Redirect('/user/settings');}

	}

	/**
	 * 处理图片上传
	 *
	 * @return Response
	 */
	public function upfile(Request $request)
	{
		$file = Input::file('upfile');

		if($file -> isValid()){
			$clientName = $file -> getClientOriginalName(); 				//上传文件文件名
			$tmpName = $file ->getFileName(); 								//缓存文件名
			$realPath = $file -> getRealPath();								//缓存文件路径
			$entension = $file -> getClientOriginalExtension(); 			//上传文件的后缀.
			$mimeType = $file -> getClientMimeType();						//文件类型  image/jpeg
			$newName = md5(date('ymdhis').$clientName).".".$entension;		//新文件名

			$path = $file->move(rtrim(app_path(),'\app').'\public\uploads',$newName);
			$newpath = 'uploads/'.$newName;
			
            $user = User::find(Auth::id());
			$user->face = $newpath;
			$user->save();
		}
		return Redirect('/user/settings');
	}
}
