@extends('home/default')

@section('content')

<link rel="stylesheet" href="{{ asset('Index/css/img-list.css') }}">
<script type="text/javascript" src="{{ asset('editor/ckeditor/ckeditor.js') }}"></script>
<div class="header">
    <h1 class="fadeInDown animated" title="宣布">Announce</h1>
	<h2 class="flipInX animated">{{ Inspiring::quote() }}</h2>
</div>
<div class="content">
<form class="pure-form pure-form-stacked" action="{{URL('/user/create_message')}}" method="POST">
<fieldset>
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<div class="pure-control-group">
            <input type="text" name="title" placeholder=" Message Title" required="required">
    </div>

<style type="text/css">
.pure-radio{
	width: 70px;
	float: left;
}
</style>

<div class="pure-control-group">
    @foreach ($category as $c)
    <label class="pure-radio">
        <input type="radio" name="optionsRadios" value="{{ $c->id }}">
        {{ $c->name }}
    </label>
    @endforeach
</div>

	<div class="pure-control-group" style="margin-top:50px;">
            <textarea id="TextArea1" cols="20" rows="2" name="content" class="ckeditor"></textarea>
    </div>

	<div class="pure-control-group">
            <label for="name"> </label>
            <input type='submit' class='pure-button pure-button-default' value="Announce The Message">
    </div>
	
<fieldset>
</form>
</div>

@endsection