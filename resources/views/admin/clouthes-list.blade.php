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
    <script src="/js/common.js"></script>

    <!-- 让IE8/9支持媒体查询，从而兼容栅格 -->
    <!--[if lt IE 9]>
    <script src="https://cdn.staticfile.org/html5shiv/r29/html5.min.js"></script>
    <script src="https://cdn.staticfile.org/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">演示</a>
        <a>
            <cite>导航元素</cite></a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right"
       href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>
<div class="x-body">

    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>

        </button>
        <span class="x-right" style="line-height:40px">共有数据：{{ count($clouthes) }} 条</span>
    </xblock>
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">
                        &#xe605;</i></div>
            </th>
            <th>ID</th>
            <th>标题</th>
            <th>适穿季节</th>
            <th>适穿性别</th>
            <th>适穿职业</th>
            <th>适穿年龄</th>
            <th>发布者</th>
            <th>描述</th>
            <th>图片</th>
            <th>分类</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        @foreach($clouthes as $item)
            <tr>
                <td>
                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='2'><i
                                class="layui-icon">&#xe605;</i></div>
                </td>
                <td>{{ $item->id }}</td>
                <td>{{ $item->title }}</td>
                <td>
                    @if($item->season == season_spring)
                        春
                    @elseif($item->season == season_summer)
                        夏
                    @elseif($item->season == season_autumn)
                        秋
                    @elseif($item->season == season_winter)
                        冬
                    @endif
                </td>
                <td>{{ $item->sex==sex_man?'男':'女' }}</td>
                <td>{{ $item->profession->title }}</td>
                <td>{{ $item->age }}</td>
                <td>{{ $item->user->name }}</td>
                <td>{{ $item->desc }}</td>
                <td><img src="{{ url('storage').'/'.$item->img_uri }}"></td>
                <td>{{ $item->category->title }}</td>
                <td class="td-manage">
                    <a title="编辑" onclick="x_admin_show('编辑','{{ url('admin/clouthesEdit/'.$item->id) }}')"
                       href="javascript:;">
                        <i class="layui-icon">&#xe642;</i>
                    </a>
                    <a title="删除" href="# " onclick="layer.confirm('确认要删除吗？',function(index){
                            submit_as_form('{{url('admin/api/deleteClouthes')}}','clouthes_id','{{ $item->id }}')
                            });">
                        <i class="layui-icon">&#xe640;</i>
                    </a>
                </td>
            </tr>
        @endforeach


        </tbody>
    </table>

</div>
<script>
    layui.use('laydate', function () {
        var laydate = layui.laydate;

        //执行一个laydate实例
        laydate.render({
            elem: '#start' //指定元素
        });

        //执行一个laydate实例
        laydate.render({
            elem: '#end' //指定元素
        });
    });


    //以表单形式提交参数
    function submit_as_form(url, data_name, data_value) {
        var form = '<form id="tmp_for_submit_form" method="post" action=" ' + url + ' " >' +
                '<input type="hidden" name="' + data_name + '" value=" ' + data_value + ' ">' +
                '{{ csrf_field() }}' +
                '</form>';
        $('body').append(form);
        $('#tmp_for_submit_form').submit();
    }

    @if (session('err_msg'))
    Toast('{{ session('err_msg') }}', 2000);
    @endif


    @if (session('suc_msg'))
    Toast('{{ session('suc_msg') }}', 2000);
    @endif


</script>
</body>

</html>