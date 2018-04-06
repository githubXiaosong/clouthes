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


        <div id="carousel-example-generic" class="carousel slide visible-md-block visible-lg-block " data-ride="carousel">
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                <li data-target="#carousel-example-generic" data-slide-to="2"></li>
            </ol>

            <!-- Wrapper for slides -->
            <div class="carousel-inner" style="position: relative; height: 500px; margin-bottom: 20px" role="listbox">
                <div class="item active">
                    <img src="{{ url('/storage/images/clouthes2.jpg') }}" alt="...">

                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                <div class="item ">
                    <img src="{{ url('/storage/images/clouthes3.jpg') }}" alt="...">

                    <div class="carousel-caption">
                        ...
                    </div>
                </div>
                <div class="item ">
                    <img src="{{ url('/storage/images/clouthes4.jpg') }}" alt="...">

                    <div class="carousel-caption">
                        ...
                    </div>
                </div>

            </div>

            <!-- Controls -->
            <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>


        <div class="row">
            <div class="col-md-12 ">


                <div class="panel panel-default">


                    <div class="panel-heading">衣服列表</div>

                    <div class="panel-body">
                        <form class="form-inline">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="衣服标题" name="title"
                                       value="{{ rq('title') }}">
                            </div>
                            <div class="form-group">
                                分类
                                <select name="category" class="form-control">
                                    <option value="0">不限</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{rq('category')==$category->id?'selected':''}}>{{$category->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                季节
                                <select name="season" class="form-control">
                                    <option value="0">不限</option>
                                    <option value="{{season_spring}}" {{rq('season')==season_spring?'selected':''}}>春天
                                    </option>
                                    <option value="{{season_summer}}" {{rq('season')==season_summer?'selected':''}}>夏天
                                    </option>
                                    <option value="{{season_autumn}}" {{rq('season')==season_autumn?'selected':''}}>秋天
                                    </option>
                                    <option value="{{season_winter}}" {{rq('season')==season_winter?'selected':''}}>冬天
                                    </option>

                                </select>
                            </div>
                            <div class="form-group">
                                适穿年龄
                                <select name="age" class="form-control">
                                    <option value="0">不限</option>
                                    <option value="20" {{rq('age')==20?'selected':''}}>20-30</option>
                                    <option value="30" {{rq('age')==30?'selected':''}}>30-40</option>
                                    <option value="40" {{rq('age')==40?'selected':''}}>40-50</option>
                                    <option value="50" {{rq('age')==50?'selected':''}}>50-60</option>

                                </select>
                            </div>
                            <div class="form-group">
                                性别
                                <select name="sex" class="form-control">
                                    <option value="0">不限</option>
                                    <option value="{{sex_man}}" {{rq('sex')==sex_man?'selected':''}}>男</option>
                                    <option value="{{sex_woman}}" {{rq('sex')==sex_woman?'selected':''}}>女</option>

                                </select>
                            </div>
                            <div class="form-group">
                                职业
                                <select name="profession" class="form-control">
                                    <option value="0">不限</option>
                                    @foreach($professions as $profession)
                                        <option value="{{$profession->id}}" {{rq('profession')==$profession->id?'selected':''}}>{{$profession->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button style="float: right" type="submit" class="btn col-md-1 btn-default">搜索</button>
                        </form>
                    </div>


                    <div class="panel-body">

                        <div class="row">
                            @foreach($clouthes as $item)
                                <a href="{{ $item->urk }}">
                                    <div class="col-sm-6 col-md-4">
                                        <div class="thumbnail">
                                            <a href="{{ $item->url }}">
                                                <img class="col-md-12" src="{{ url('storage').'/'.$item->img_uri }}"
                                                     alt="...">
                                            </a>

                                            <div class="caption">
                                                <b><p style=" font-size:20px ;float: left">{{ $item->title }}</p></b>

                                                <p style=" cursor: pointer;  color: #3059e6;font-size:10px;float: right;">
                                                    {{ $item->user->name }}</p>

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

                                                <p style=" font-size:10px ;"> 适穿年龄: {{ $item->age }}-{{ $item->age+10 }}</p>

                                                <p style=" font-size:10px ;"> 适穿性别: {{ $item->sex==sex_man?'男':'女' }}</p>

                                                <p style=" font-size:10px ;"> 适穿职业: {{ $item->profession->title }}</p>
                                                @if($item->is_added)<p><a class="btn btn-primary btn-xs" role="button"
                                                                          disabled>已加入我的搭配</a></p>
                                                @else<p><a href="#" class="btn btn-primary btn-xs" role="button"
                                                           onclick="submit_as_form('{{url('api/addToMyDesign')}}','clouthes_id',{{ $item->id }})">加入我的搭配</a>
                                                </p>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </a>
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