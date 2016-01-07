@extends('home/default')

@section('content')



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
    <!-- <button class="button-success pure-button">关注</button> -->
<!--版式-->

<link rel="stylesheet" href="{{ asset('Index/css/img-list.css') }}">


<div class="header">
    <style type="text/css">
#asdfs{
    height: 100px;
    width: 100px;
    border-radius: 50%;
}
</style>
    <h2 class="swing animated"><a href="javascript:void(0);" title=""><img id="asdfs" src="{{asset('/')}}{{$user->face }}"></a></h2>

    <h1 class="fadeInDown animated" title="宣布">{{ $user->name }} <div>
</div></h1>
    <h2 class="flipInX animated">{{ $user->word }}</h2>
	<p style="font-size:12px;">
        地址 : {{ $user->url }} | 联系 : {{ $user->connection }}
    </p>
    <p style="font-size:12px;">加入时间 {{ date("n月j日",strtotime($user->created_at)) }}　最后一帖 {{ $user->tz }}　最后一次活动 {{ $user->hd }}</p>
</div>



<div class="content">


            @foreach ($index as $message)
                <div class="posts">
                    <section class="post">
                        <header class="post-header">
                            <h2 class="post-title"><a style="color:#888;font-size:18px;" href="{{URL('message_info')}}/{{$message->id}}" title="全部内容">{{$message->title}}</a><span style="font-size:12px;float:right;">{{date("g:i A",strtotime($message->created_at))}}</span></h2>
                        </header>

                        <div class="post-description">
                            <p style="font-size:14px;">
                                <!-- {{str_limit($message->content, $limit = 100, $end = '...')}} -->
                                <?php echo str_limit($message->content, $limit = 100, $end = '...');?>
                            </p>
                        </div>
                    </section>
                </div>
            @endforeach
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
<?php echo $index->render(); ?>
</div>
@endsection