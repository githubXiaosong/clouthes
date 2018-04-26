@extends('layouts.app')

@section('script_top')

@endsection

@section('content')
    <div class="container">


        <div class="row" style="margin-top: 20px">
            <div class="col-md-12 ">


                <div class="panel panel-default">


                    <div class="panel-heading">搭配师列表</div>

                    <div class="panel-body">
                        <div class="panel-body">
                            <form class="form-inline">
                                <div class="form-group">
                                    <input type="title" class="form-control" name="name" value="{{ rq('name') }}"
                                           placeholder="搭配师姓名">
                                </div>
                                <div class="form-group">
                                    年龄
                                    <select name="age" class="form-control">
                                        <option value="0">不限</option>
                                        <option value="20" {{ rq('age')==20?'selected':'' }}>20-30</option>
                                        <option value="30" {{ rq('age')==30?'selected':'' }}>30-40</option>
                                        <option value="40" {{ rq('age')==40?'selected':'' }}>40-50</option>
                                        <option value="50" {{ rq('age')==50?'selected':'' }}>50-60</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    性别
                                    <select name="sex" class="form-control">
                                        <option value="0">不限</option>
                                        <option value="{{sex_man}}" {{ rq('sex')==sex_man?'selected':'' }}>男</option>
                                        <option value="{{sex_woman}}" {{ rq('sex')==sex_woman?'selected':'' }}>女</option>
                                    </select>
                                </div>
                                <button style="float: right" type="submit" class="btn col-md-1 btn-default">搜索</button>
                            </form>
                        </div>
                        <div class="row">

                            @foreach($desingers as $desinger)
                                <div class="col-sm-2 col-md-3">
                                    <div class="thumbnail">
                                        <img style="height: 200px;width: 200px"
                                             src="{{ $desinger->avatar_uri?'storage/'.$desinger->avatar_uri:'storage/images/111.jpg' }}"
                                             alt="..."
                                             class="img-circle ">

                                        <div class="caption">
                                            <h3> {{ $desinger->name }}</h3>

                                            <p> {{ $desinger->desc }}</p>

                                            <p> 年龄: {{ $desinger->age }}</p>

                                            <p> 手机号: {{ $desinger->phone }}</p>

                                            <p> {{ $desinger->sex==sex_woman?'女':'男' }}</p>

                                            <p> 入驻时间: {{ $desinger->created_at }}</p>

                                            <p><a href="#" class="btn btn-primary " role="button"
                                                  onclick="Toast('选择成功',2000)">选择并支付</a> <a href="#"
                                                                                            class="btn btn-default "
                                                                                            onclick="Toast('关注成功',2000)"
                                                                                            role="button">关注</a></p>
                                        </div>
                                    </div>
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script_bottom')

@endsection