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

        <div class="row" style="margin-top: 20px">
            <div class="col-md-12 ">


                <div class="panel panel-default">


                    <div class="panel-heading">我的搭配</div>

                    @if( !isset($clouthes[0]))
                        <div class="panel-body">

                            <div class="row">

                                <div class="col-sm-6 col-md-4">
                                    <p class="bg-info">暂时还没有添加过衣服</p>
                                </div>
                            </div>
                        </div>
                    @endif



                    @foreach($categories as $category)
                        <div class="panel-body">

                            <div class="row">

                                <div class="panel-heading">{{ $category->title }}</div>
                                @foreach($clouthes as $item)

                                    @if($item->category_id == $category->id)
                                        <div class="col-sm-6 col-md-3">
                                            <div class="thumbnail">
                                                <a href="{{ $item->url }}">
                                                    <img src="{{ url('storage').'/'.$item->img_uri }}"
                                                         alt="...">
                                                </a>

                                                <div class="caption">
                                                    <b><p style=" font-size:20px ;float: left">{{ $item->title }}</p>
                                                    </b>
                                                    <a onclick="submit_as_form('{{url('api/deleteDesign')}}','clouthes_id',{{ $item->id }})">
                                                        <p style=" cursor: pointer;  color: red;font-size:10px;float: right;">
                                                            移除</p></a>

                                                    <div style="clear: both"></div>
                                                    <p style=" font-size:15px ;">描述:   {{ $item->desc }}</p>

                                                </div>

                                            </div>
                                        </div>
                                    @endif


                                @endforeach

                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </div>
@endsection

@section('script_bottom')

@endsection