@extends('layouts.app')

@section('script_top')

@endsection

@section('content')
    <div class="container">

        @if (session('err_msg'))
            <div class="alert alert-danger">
                {{ session('err_msg') }}
            </div>
        @endif

        @if (session('suc_msg'))
            <div class="alert alert-success">
                {{ session('suc_msg') }}
            </div>
        @endif

        <div class="row">
            <div class="col-md-12 ">
                <div class="panel panel-default">
                    <div class="panel-heading">我的添加的衣服</div>

                    <div class="panel-body">
                        <div class="row">
                            @if( !isset($clouthes[0]))
                                <div class="col-sm-6 col-md-4">
                                    <p class="bg-info">暂时还没有添加过衣服</p>
                                </div>
                            @endif
                            @foreach($clouthes as $item)

                                <div class="col-sm-6 col-md-3">
                                    <div class="thumbnail">
                                        <a href="{{ $item->url }}">
                                            <img class="col-md-12" src="{{ url('storage').'/'.$item->img_uri }}"
                                                 alt="...">
                                        </a>

                                        <div class="caption">
                                            <b><p style=" font-size:20px ;float: left">{{ $item->title }}</p></b>
                                            <a onclick="submit_as_form('{{url('api/deleteClouthes')}}','clouthes_id',{{ $item->id }})">
                                                <p style=" cursor: pointer;  color: red;font-size:10px;float: right;">
                                                    删除</p></a>

                                            <div style="clear: both"></div>
                                            <p style=" font-size:15px ;">描述:   {{ $item->desc }}</p>

                                            <p style=" font-size:10px ;"> 分类:   {{ $item->category->title }}</p>

                                            <p style=" font-size:10px ;"> 适穿季节:
                                                @if($item->season == season_spring)春季
                                                @elseif($item->season == season_summer)夏季
                                                @elseif($item->season == season_autumn)秋季
                                                @elseif($item->season == season_winter)冬季
                                                @endif
                                            </p>
                                        </div>

                                    </div>
                                </div>

                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">添加衣服</div>

                    <div class="panel-body">

                        <div class="row">
                            <form class="form-horizontal" action="{{ url('api/uploadClouthes') }}" method="post"
                                  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">名称</label>

                                    <div class="col-sm-6">
                                        <input name="title" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">描述</label>

                                    <div class="col-sm-6">
                                        <input name="desc" type="text" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label">封面图片</label>

                                    <div class="col-sm-6">
                                        <input name="cover" type="file" class="form-control"
                                               placeholder="请上传？？X ？？大小的图片">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">链接</label>

                                    <div class="col-sm-6">
                                        <input name="url" type="text" class="form-control">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">季节</label>

                                    <div class="col-sm-6">
                                        <select class="form-control" name="season">
                                            <option value="{{ season_spring }}">春</option>
                                            <option value="{{ season_summer }}">夏</option>
                                            <option value="{{ season_autumn }}">秋</option>
                                            <option value="{{ season_winter }}">冬</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">分类</label>

                                    <div class="col-sm-6">
                                        <select class="form-control" name="category_id">
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"> {{$category->title}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label class="col-sm-2 control-label">适穿性别</label>

                                    <div class="col-sm-6">
                                        <select class="form-control" name="sex">
                                            <option value="{{ sex_man }}">男</option>
                                            <option value="{{ sex_woman }}">女</option>
                                        </select>
                                    </div>
                                </div>



                                <div class="form-group">
                                    <label class="col-sm-2 control-label">适穿年龄</label>

                                    <div class="col-sm-6">
                                        <select class="form-control" name="age">
                                            <option value="20">20-30</option>
                                            <option value="20">30-40</option>
                                            <option value="20">40-50</option>
                                            <option value="20">50-60</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">适穿职业</label>

                                    <div class="col-sm-6">
                                        <select class="form-control" name="profession_id">
                                            @foreach($professions as $profession)
                                                <option value="{{ $profession->id }}"> {{$profession->title}} </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-default">确定上传</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script_bottom')

@endsection