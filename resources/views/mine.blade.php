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

                    <div class="panel-heading">我的信息</div>

                    <div class="panel-body">

                        <div class="row col-md-5 col-md-offset-3">
                            <form action="{{ url('api/updateUser') }}" method="post" enctype="multipart/form-data">

                                {{ csrf_field() }}

                                <div class="form-group">
                                    <label>姓名</label>
                                    <input type="text" name="name" value="{{ $user->name }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" value="{{ $user->email }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>手机号</label>
                                    <input type="text" name="phone" value="{{ $user->phone }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>年龄</label>
                                    <input type="text" name="age" value="{{ $user->age }}" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>描述</label>
                                    <input type="text" name="desc" value="{{ $user->desc }}" class="form-control">
                                </div>


                                <div class="form-group">
                                    <label>头像</label><br>
                                    @if($user->avatar_uri)
                                        <img style="height: 200px ;width: 200px" class="img-circle"
                                             src="{{ '/storage/'.$user->avatar_uri }}">
                                    @endif

                                    <input name="avatar" type="file" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>身份</label>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="identity"
                                                   value="{{ identity_designer }}"
                                                    {{ $user->identity == identity_designer ? 'checked' : '' }}>
                                            设计师
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="identity"
                                                   value="{{ identity_common }}"
                                                    {{ $user->identity == identity_common ? 'checked' : '' }}>
                                            普通用户
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>性别</label>

                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="sex"
                                                   value="{{ sex_man }}"
                                                    {{ $user->sex == sex_man ? 'checked' : '' }}>
                                            男
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="sex"
                                                   value="{{ sex_woman }}"
                                                    {{ $user->sex == sex_woman ? 'checked' : '' }}>
                                            女
                                        </label>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-default">确定修改</button>
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