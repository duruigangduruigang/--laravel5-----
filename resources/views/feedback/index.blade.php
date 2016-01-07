@extends('home/default')

@section('content')





<!--版式-->
<link rel="stylesheet" href="{{ asset('Index/css/img-list.css') }}">

<div class="header">
    <h1 class="fadeInDown animated" title="意见反馈">FeedBack</h1>
</div>



<div class="content">
<center>
<form class="pure-form pure-form-stacked" action="{{URL('/feed')}}" method="POST">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<textarea type='text' name="content" placeholder=" 感谢您的意见！ " style="height:240px;width:100%;" required="required"></textarea>
	<br>
	<input type='submit' class='pure-button pure-button-default' value=" POST Message !  ">
</form>
</center>
</div>



@endsection