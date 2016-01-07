@extends('home/default')

@section('content')


<!--版式-->
<link rel="stylesheet" href="{{ asset('Index/css/img-list.css') }}">
<style type="text/css">
#asdfs{
	height: 100px;
	width: 100px;
	border-radius: 50%;
}
</style>
<div class="header">
	<h2 class="swing animated"><a href="{{URL('/Profile/')}}/{{$message_info->user_id}}" title="了解他"><img id="asdfs" src="{{asset('/')}}{{ $message_info->face }}"></a></h2>
    <h1 class="fadeInDown animated" style="font-size:18px;" title="宣布">{{ $message_info->title }}</h1>
</div>


<style type="text/css">
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
#k{
    float: right;
}
</style>
<div class="content" style="border-bottom: 1px solid #eee;">


<?php echo $message_info->content;?>


<h3 class="content-subhead" style="border-bottom: 0px;">发布于 {{date("Y:m:d - H时i分",strtotime($message_info->created_at))}}<div id='k'><span id='tp' style="background: rgb({{ $message_info->color }});"></span><a href="{{asset('/')}}{{$message_info->class_id}}">{{ $message_info->class }}</a></div></h3>
<hr>
<style type="text/css">
.img_h{width:40px;height: 40px;border-radius: 20px;}
.nc{font-size: 12px;text-align: left;color: #7e7e7e;}
#ontt{font-size: 12px;color: #252525;text-align: left;}
#tm{color: #7e7e7e;font-size: 12px;margin-right: 100px;text-align: left;}

.pl{margin: 40px;}
</style>

@foreach ($comments as $com)
<div class="pl">
	<img class="img_h" alt="" src="{{url('/')}}/{{$com->face}}">
	<a class="nc" href="{{url('/Profile')}}/{{ $com->uid }}" alt="{{ $com->word }}">{{ $com->name }}</a><p id='tm'>{{ $com->created_at }}</p>
	<p id="ontt"><?php echo $com->content;?></p>
</div>
@endforeach
    <style scoped>

        .button-success,
        .button-error,
        .button-warning,
        .button-secondary {
            color: white;
            border-radius: 4px;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
             font-size: 30%;
        }

        .button-success {
            background: rgb(28, 184, 65); /* this is a green */
            position: relative;
            top: -9px;
            left: 10px;
        }


    </style>
    <style type="text/css">
.pagination {
    border-radius: 4px;
    display: inline-block;
    margin: 20px 0;
    padding-left: 0;
}
.pagination > li {
    display: inline;
}
.pagination > li > a, .pagination > li > span {
    background-color: #ffffff;
    border: 1px solid #dddddd;
    color: #337ab7;
    float: left;
    line-height: 1.42857;
    margin-left: -1px;
    padding: 6px 12px;
    position: relative;
    text-decoration: none;
}
.pagination > li:first-child > a, .pagination > li:first-child > span {
    border-bottom-left-radius: 4px;
    border-top-left-radius: 4px;
    margin-left: 0;
}
.pagination > li:last-child > a, .pagination > li:last-child > span {
    border-bottom-right-radius: 4px;
    border-top-right-radius: 4px;
}
.pagination > li > a:hover, .pagination > li > span:hover, .pagination > li > a:focus, .pagination > li > span:focus {
    background-color: #eeeeee;
    border-color: #dddddd;
    color: #23527c;
}
.pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
    background-color: #337ab7;
    border-color: #337ab7;
    color: #ffffff;
    cursor: default;
    z-index: 2;
}
</style>
<?php echo $comments->render(); ?>
<script type="text/javascript" src="{{ asset('editor/ckeditor/ckeditor.js') }}"></script>
<h3>发表回复</h3>
<form class="pure-form pure-form-stacked" action="{{URL('/user/comments')}}" method="POST">
<input type="hidden" name="_token" value="{{ csrf_token() }}">
<input type="hidden" name="message_id" value="{{ $message_info->id }}">
<textarea id="TextArea1" cols="20" rows="2" name="content" class="ckeditor"></textarea> <br>
	<input type='submit' class='pure-button pure-button-default' value=" 发表 ">
</form>



</div>
@endsection