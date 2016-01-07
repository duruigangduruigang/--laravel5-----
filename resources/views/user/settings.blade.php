@extends('home/default')

@section('content')



<!--版式-->
<link rel="stylesheet" href="{{ asset('Index/css/img-list.css') }}">

<div class="header">
    <h1 class="fadeInDown animated" title="信息设定">Settings</h1>
	<h2 class="flipInX animated">{{ Inspiring::quote() }}</h2>
	<p>
    @if (Auth::guest())
	    <a href="{{ url('/auth/register') }}" class="pure-button pure-button-primary">注册</a>
	    <a href="{{ url('/auth/login') }}" class="pure-button">登录</a>
    @endif
    </p>
</div>


<style type="text/css">
	.asdf{color: #FFF;}
</style>
    <style type="text/css">
#asdfs{
    height: 100px;
    width: 100px;
    border-radius: 50%;
}
</style>
<div class="content" style="background-color: #777;padding-bottom:70px;">

<img id="asdfs" src="{{asset('/')}}{{$user->face}}">
<form class="pure-form pure-form-stacked" enctype="multipart/form-data" method="post" name="upform" action="{{ URL('/user/upfile') }}">  

	<input type="hidden" name="_token" value="{{ csrf_token() }}">

<span class="asdf">头像</span> : <input name="upfile" type="file"><input type="submit" value="上传"><br/>
<br>

</form>


<form class="pure-form pure-form-stacked" action="{{URL('/user/update')}}" method="POST">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<span class="asdf">昵称</span> : <input type="text"  name="username" placeholder=" Message Title" required="required" value="{{ $user->name }}">
	<br>
	<span class="asdf">签名</span> : <input type="text" name="most" placeholder=" Your Most Love Words " required="required" value="{{ $user->word }}">
	<br>
	<span class="asdf">联系方式</span> : <input type="text" name="contact" placeholder=" Email、Phone Or address " required="required" value="{{ $user->connection }}">
	<br>
	<span class="asdf">个人主页</span> : <input type="text" name="url" placeholder=" home " required="required" value="{{ $user->url }}">
	<br>
	<span class="asdf">新的密码</span> : <input type="text" name="pass" placeholder=" New Password" required="required">
	<br>
	<input type='submit' class='pure-button pure-button-default' value=" POST ">
</form>




</div>


@endsection