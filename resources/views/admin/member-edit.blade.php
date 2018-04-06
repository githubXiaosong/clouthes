<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>欢迎页面-X-admin2.0</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport"
          content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi"/>
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="/admin/css/font.css">
    <link rel="stylesheet" href="/admin/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript" src="/admin/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="/admin/js/xadmin.js"></script>
    <script type="text/javascript" src="/js/common.js"></script>
    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-body">

    @if (session('err_msg'))
        {{ session('err_msg') }}
    @endif


    <script>
        @if (session('suc_msg'))
        Toast('{{ session('suc_msg') }}', 2000);
        @endif
    </script>


    <form class="layui-form" action="{{ url('admin/api/editUser') }}" method="post">

        <input type="hidden" name="user_id" value="{{ $user->id }}">
        {{ csrf_field() }}
        <div class="layui-form-item">
            <label for="L_email" class="layui-form-label">
                <span class="x-red">*</span>邮箱
            </label>

            <div class="layui-input-inline">
                <input type="text" id="L_email" name="email" required="" lay-verify="email" value="{{ $user->email }}"
                       autocomplete="off" class="layui-input">
            </div>
            <div class="layui-form-mid layui-word-aux">
                <span class="x-red">*</span>将会成为您唯一的登入名
            </div>
        </div>
        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>昵称
            </label>

            <div class="layui-input-inline">
                <input type="text" id="L_username" name="name" required="" lay-verify="nikename"
                       value="{{ $user->name }}"
                       autocomplete="off" class="layui-input">
            </div>
        </div>

        <div class="layui-form-item">
            <label for="L_username" class="layui-form-label">
                <span class="x-red">*</span>身份
            </label>

            <div class="layui-input-inline">
                <select id="L_identity" name="identity" required="" class="layui-input">
                    <option value="{{ identity_common }}" {{ $user->identity==identity_common?'selected':''}}>普通用户
                    </option>
                    <option value="{{ identity_designer }}" {{ $user->identity==identity_designer?'selected':'' }}>设计师
                    </option>
                </select>

            </div>
        </div>

        <div class="layui-form-item">
            <label for="L_repass" class="layui-form-label">
            </label>
            <button class="layui-btn" lay-filter="add" lay-submit="">
                修改
            </button>
        </div>
    </form>
</div>
<script>
    layui.use(['form', 'layer'], function () {
        $ = layui.jquery;
        var form = layui.form
                , layer = layui.layer;

        //自定义验证规则
        form.verify({
            nikename: function (value) {
                if (value.length < 5) {
                    return '昵称至少得5个字符啊';
                }
            }

        });


    });
</script>

</body>

</html>