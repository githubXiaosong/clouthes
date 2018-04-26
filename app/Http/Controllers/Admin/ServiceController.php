<?php

namespace App\Http\Controllers\Admin;

use App\Clouthes;
use App\Course;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class ServiceController extends Controller
{


    public function changeUserStatus()
    {
        $validator = Validator::make(
            rq(),
            [
                'user_id' => 'required|exists:users,id',

            ],
            [

            ]
        );
        if ($validator->fails())
            return back()->with(['err_msg' => $validator->messages()]);

        $user = User::find(rq('user_id'));

        $user->status = $user->status == 0 ? '1' : '0';

        $user->save();

        return back()->with('suc_msg', '修改成功');

    }


    public function editUser()
    {

        $validator = Validator::make(
            rq(),
            [
                'user_id' => 'required|exists:users,id',
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'identity' => 'required|in:' . identity_common . ',' . identity_designer,
            ],
            [

            ]
        );
        if ($validator->fails())
            return back()->with(['err_msg' => $validator->messages()]);

        $user = User::find(rq('user_id'));
        $user->name = rq('name');
        $user->email = rq('email');
        $user->identity = rq('identity');
        $user->save();
        return back()->with('suc_msg', '修改成功');

    }


    public function addUser()
    {

        $validator = Validator::make(
            rq(),
            [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6|confirmed',
                'phone' => 'required|digits:11',
                'desc' => 'required|max:255',
            ],
            [

            ]
        );
        if ($validator->fails())
            return back()->with(['err_msg' => $validator->messages()]);

        $user = new User();

        $user->name = rq('name');
        $user->email = rq('email');
        $user->phone = rq('phone');
        $user->password = bcrypt(rq('password'));
        $user->sex = rq('sex');
        $user->identity = is_null(rq('identity')) ? '10' : '0';
        $user->status = 0;
        $user->age = rq('age');
        $user->desc = rq('desc');
        $user->save();

        return back()->with('suc_msg', '添加成功');
    }

    public function deleteUser()
    {

        $validator = Validator::make(
            rq(),
            [
                'user_id' => 'required|exists:users,id'
            ],
            [

            ]
        );
        if ($validator->fails())
            return back()->with(['err_msg' => $validator->messages()]);

        $user = User::find(rq('user_id'));

        $user->delete();

        return back()->with('suc_msg', '删除成功');
    }


    public function editClouthes(Request $request)
    {

        $validator = Validator::make(
            rq(),
            [
                'clouthes_id' => 'required|exists:clouthes,id',
                'title' => 'required|max:20',
                'url' => 'required',
                'desc' => 'required|max:30',
                'cover' => 'required|image'
            ],
            [

            ]
        );
        if ($validator->fails())
            return back()->with(['err_msg' => $validator->messages()]);

        $clouthes = Clouthes::find(rq('clouthes_id'));
        $clouthes->title = rq('title');
        $clouthes->desc = rq('desc');
        $clouthes->url = rq('url');
        $cover_path = $request->cover->store('images', 'public');
        $clouthes->img_uri = $cover_path;

        $clouthes->save();
        return back()->with('suc_msg', '修改成功');

    }


    public function deleteClouthes()
    {

        $validator = Validator::make(
            rq(),
            [
                'clouthes_id' => 'required|exists:clouthes,id'
            ],
            [

            ]
        );
        if ($validator->fails())
            return back()->with(['err_msg' => $validator->messages()]);

        $clouthes = Clouthes::find(rq('clouthes_id'));

        $clouthes
            ->users()
            ->newPivotStatement()
//            从这里开始就进入了另一个数据模型了    进入的是那个中间的数据模型   就是轴模型 对应轴表
            ->where('clouthes_id', $clouthes->id)
            ->delete();

        $clouthes->delete();

        return back()->with('suc_msg', '删除成功');
    }

}
