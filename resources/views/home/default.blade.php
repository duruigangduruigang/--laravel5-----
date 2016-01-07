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
</head>
<body>
<div id="layout">
    <!-- Menu toggle -->
    <a href="#menu" id="menuLink" class="menu-link">
        <!-- Hamburger icon -->
        <span></span>
    </a>

    <div id="menu" class="">
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

    <div id="main">
        @yield('content')
       
    </div>
</div>

<script src=" {{ asset('Index/js/ui.js') }}"></script>
</body>
</html>