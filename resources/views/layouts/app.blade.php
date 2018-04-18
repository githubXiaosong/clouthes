<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">


    <!-- Scripts -->
    @yield('script_top')

    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>

//以表单形式提交参数
        function submit_as_form(url, data_name, data_value) {
            var form = '<form id="tmp_for_submit_form" method="post" action=" ' + url + ' " >' +
                    '<input type="hidden" name="' + data_name + '" value=" ' + data_value + ' ">' +
                    '{{ csrf_field() }}' +
                    '</form>';
            $('body').append(form);
            $('#tmp_for_submit_form').submit();
        }

    </script>
</head>
<body>
<nav class="navbar navbar-default navbar-static-top navbar-inverse">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}">
                去搭配
            </a>

        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->
            <ul class="nav navbar-nav">
                <li role="presentation"
                    class="{{ \Illuminate\Support\Facades\Request::is('clouthesList') ? 'active' : '' }}"><a
                            href="{{url('clouthesList')}}">首页</a></li>
                <li role="presentation"
                    class="{{ \Illuminate\Support\Facades\Request::is('desingerList') ? 'active' : '' }}"><a
                            href="{{url('desingerList')}}">搭配师</a></li>
                <li role="presentation"
                    class="{{ \Illuminate\Support\Facades\Request::is('myDesign/*') ? 'active' : '' }}"> @if(!Auth::guest())
                        <a href="{{url('myDesign/').'/'.\Illuminate\Support\Facades\Auth::user()->id}}">我的搭配</a> @endif
                </li>
                <li role="presentation"
                    class="{{ \Illuminate\Support\Facades\Request::is('addClouthes/*') ? 'active' : '' }}"> @if(!Auth::guest())
                        <a href="{{url('addClouthes/').'/'.\Illuminate\Support\Facades\Auth::user()->id}}">添加衣服</a> @endif
                </li>
                <li role="presentation"
                    class="{{ \Illuminate\Support\Facades\Request::is('mine/*') ? 'active' : '' }}"> @if(!Auth::guest())
                        <a href="{{url('mine/').'/'.\Illuminate\Support\Facades\Auth::user()->id}}">我的信息</a> @endif
                </li>
            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">登录</a></li>
                    <li><a href="{{ url('/register') }}">注册</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ url('/logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    退出
                                </a>

                                <form id="logout-form" action="{{ url('/logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>

@yield('content')

@section('footer')
    <footer style="background: #000000" class="visible-md-block visible-lg-block">
        <div class="container">
            <div class="row">
                <div class="col-sm-2 col-sm-offset-2">
                    <h6>Copyright &copy;RuiRui</h6>
                </div>



                <div class="col-sm-2">
                    <h6>导航</h6>
                    <ul class="unstyled">
                        <li><a href="">主页</a></li>
                        <li><a href="">服务</a></li>
                        <li><a href="">链接</a></li>
                        <li><a href="">联系我们</a></li>
                    </ul>
                </div>

                <div class="col-sm-2">
                    <h6>联系我们</h6>
                    <ul class="unstyled">
                        <li><a href="">微博</a></li>
                        <li><a href="">微信</a></li>
                        <li><a href="">来往</a></li>
                    </ul>
                </div>

                <div class="col-sm-2">
                    <h6>本网站由<span class="glyphicon glyphicon-heart"></span>RuiRui制作</h6>
                </div>
            </div>
        </div>
    </footer><!--页脚结束-->
    @show

            <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script src="/js/common.js"></script>

    @yield('script_bottom')
</body>
</html>
