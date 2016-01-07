@extends('home/default')

@section('content')

<!--版式-->
<link rel="stylesheet" href="{{ asset('Index/css/img-list.css') }}">

<div class="header">
    <h1 class="fadeInDown animated" title="宣布"> Me. </h1>
	<h2 class="flipInX animated">{{ Inspiring::quote() }}</h2>
</div>
<style type="text/css">
#tt{
	font-size: 14px;
}
#tp{
	display: block;
	float: left;
	margin-top: 5px;
	margin-right: 4px;
	height: 12px;
	width: 12px;
	opacity: 0.8;
	border-radius: 6px;
}
</style>
<center>
<div class="content">
	<table class="pure-table">
		<thead><tr><td>时间</td><td>消息</td><td>分类</td></tr></thead>
		<tbody id="tt">
			@foreach ($c as $comment)
			<tr><td>{{ $comment->created_at }}</td><td><a href="{{asset('/Profile')}}/{{ $comment->user_id }}">{{ $comment->name }}</a> 回复了 <a href="{{ asset('/message_info') }}/{{ $comment->message_id }}">{{ $comment->title }}</a></td><td><span style="background-color: rgb({{ $comment->color }});" id='tp'></span><a href="{{'/'}}{{$comment->categoryid}}">{{ $comment->category }}</a></td></tr>
			@endforeach
		</tbody>
	</table>
</div>
</center>


@endsection