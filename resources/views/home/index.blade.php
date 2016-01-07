<!doctype html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="微客">
<title>微客</title>
<link href="{{ asset('/Index/css/pure-0.5.0-min.css') }}" rel="stylesheet">
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="{{ asset('/Index/css/layouts/side-menu-old-ie.css') }}">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="{{ asset('/Index/css/layouts/side-menu.css') }}">
    <!--<![endif]-->
<link href="{{ asset('/Index/css/main.css') }}" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('/Index/css/animate.css') }}">

<!-- <link rel="stylesheet" href="Pure_files/pure.css">
<link rel="stylesheet" href="Pure_files/main.css"> -->
</head>
<body>


<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <span></span>
    </a>

    <div id="menu">
    <!-- <div id="menu" class="rotateInDownLeft animated"> -->
        <div class="pure-menu pure-menu-open">
            <a class="pure-menu-heading" href="/">WeiKe</a>

            <ul>
                <!-- menu-item-divided pure-menu-selected -->
                <li>
                    <a href="{{ url('/user/message') }}">发布消息</a>
                </li>
                <li>
                    <a href="{{ url('/user/me') }}">帖子动态</a>
                </li>
                <li>
                    <a href="{{ url('/user/settings') }}">个人设置</a>
                </li>
                <li>
                    <a href="{{ url('/Profile')}}/{{Auth::id()}}">我的主页</a>
                </li>
                @if (Auth::guest())
                    @else
                     <li>
                        <a href="{{ url('/auth/logout') }}">退出登录</a>
                    </li>
                @endif
                <li class="menu-item-divided ">
                    <a href="{{ url('/feedback') }}">应用建议</a>
                </li>
            </ul>
        </div>
    </div>
</div>


<div id="main">

    <!--版式-->
    <link rel="stylesheet" href="{{ asset('Index/css/img-list.css') }}">

    <div class="header">
        <h1 class="fadeInDown animated">weike</h1>
    	<h2 class="flipInX animated">{{ Inspiring::quote() }}</h2>
    	<p>
        @if (Auth::guest())
    	    <a href="{{ url('/auth/register') }}" class="pure-button pure-button-primary">注册</a>
    	    <a href="{{ url('/auth/login') }}" class="pure-button">登录</a>
        @endif
        </p>
    </div>
    <div class="content">






<div>
    <style scoped>

        .button-success,
        .button-error,
        .button-warning,
        .button-secondary {
            color: white;
            border-radius: 4px;
            text-shadow: 0 1px 1px rgba(0, 0, 0, 0.2);
        }

        .button-success {
            background: rgb(28, 184, 65); /* this is a green */
        }

        .button-error {
            background: rgb(202, 60, 60); /* this is a maroon */
        }

        .button-warning {
            background: rgb(223, 117, 20); /* this is an orange */
        }

        .button-secondary {
            background: rgb(66, 184, 221); /* this is a light blue */
        }
        .button-xsmall {
            font-size: 70%;
        }

        .button-small {
            font-size: 85%;
        }

        .button-large {
            font-size: 110%;
        }

        .button-xlarge {
            font-size: 125%;
        }



    </style>
    <a href="{{asset('/')}}" class="button-xsmall button-success pure-button">全部</a>
    @foreach ($category as $c)
    <a href="{{asset('/')}}{{$c->id}}" class="button-xsmall button-error pure-button" style="background: rgb({{ $c->color }});">{{ $c->name }}</a>
    @endforeach
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
        <span><a href=""></a></span>
            @foreach ($index as $message)
                <div class="posts">

                    <!-- A single blog post -->
                    <section class="post">
                        <header class="post-header">
                            

                            <h2 class="post-title"><a style="color:#888;font-size:18px;" href="{{URL('message_info')}}/{{$message->id}}" title="全部内容">{{$message->title}}</a><a style="border:1px solid #FFF;" href="{{URL('/Profile/')}}/{{$message->user_id}}"><img width="48" height="48" src="{{'/'}}{{$message->face}}" alt="" class="post-avatar "></a></h2>

<!--                             <p class="post-meta">
                                By <a class="post-author" title="了解他" href="{{URL('/Profile/')}}/id">name</a> under <a href="#" class="post-category post-category-design">CSS</a> <a href="#" class="post-category post-category-pure">Ajax</a>
                            </p> -->
                        </header>

                        <div class="post-description">
                            <p style="font-size:14px;letter-spacing:2px">
                                 <?php echo preg_replace("/(\s|\&nbsp\;|\&|　|\xc2\xa0)/", "", strip_tags(str_limit($message->content, $limit = 100, $end = '...'))); ?>
                            </p>
                        </div>
                    </section>
                    <h1 class="content-subhead">{{date("g:i A",strtotime($message->created_at))}}<div id='k'><span id='tp' style="background: rgb({{ $message->color }});"></span><a href="">{{ $message->name }}</a></div></h1>
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
</div>
<script src=" {{ asset('Index/js/ui.js') }}"></script>
</body>
</html>