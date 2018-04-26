<?php

namespace App\Http\Controllers;

use App\Clouthes;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function uploadClouthes(Request $request)
    {

        $validator = Validator::make(
            rq(),
            [
                'title' => 'required|max:20',
                'cover' => 'required|image',
                'category_id' => 'required|exists:categories,id',
                'profession_id' => 'required|exists:professions,id',
                'season' => 'required|in:'.season_spring.','.season_summer.','.season_autumn.','.season_winter,
                'sex' => 'required|in:'.sex_man.','.sex_woman,
                'age' => 'required|in:20,30,40,50'
            ],
            [
                'title.required' => '请输入文件名',
                'title.max' => '文件名最大不能超过20个字符',
                'cover.required' => '请选择图片',
                'cover.image' => '封面文件类型必须是500 X 800的图片',
                'category_id.required' => '分类id不存在',
                'category_id.exists' => '该分类不存在'
            ]
        );
        if ($validator->fails())
            return back()->with(['err_msg' => $validator->messages()]);

//        rq('cover') == null
//        dd($request->course);

        $user = Auth::user();
        $cover_path = $request->cover->store('images', 'public');

        $clouthes = new Clouthes();
        $clouthes->title = rq('title');
        $clouthes->desc = rq('desc');
        $clouthes->url = rq('url');
        $clouthes->season = rq('season');
        $clouthes->img_uri = $cover_path;
        $clouthes->user_id = $user->id;
        $clouthes->category_id = rq('category_id');
        $clouthes->sex = rq('sex');
        $clouthes->age = rq('age');
        $clouthes->profession_id = rq('profession_id');


        $clouthes->save();

        return back()->with('suc_msg', 'upload success');

    }

    public function deleteClouthes()
    {

        $validator = Validator::make(
            rq(),
            [
                'clouthes_id' => 'required|exists:clouthes,id',

            ],
            [
                'clouthes_id.required' => 'clouthes_id 不存在',
                'clouthes_id.exists' => 'clouthes_id 不属于数据库',
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

    public function deleteDesign()
    {

        $validator = Validator::make(
            rq(),
            [
                'clouthes_id' => 'required|exists:clouthes,id',

            ],
            [
                'clouthes_id.required' => 'clouthes_id 不存在',
                'clouthes_id.exists' => 'clouthes_id 不属于数据库',
            ]
        );
        if ($validator->fails())
            return back()->with(['err_msg' => $validator->messages()]);

        $user = Auth::user();

        $clouthes = Clouthes::find(rq('clouthes_id'));

        $clouthes
            ->users()
            ->newPivotStatement()
//            从这里开始就进入了另一个数据模型了    进入的是那个中间的数据模型   就是轴模型 对应轴表
            ->where('user_id', $user->id)
            ->where('clouthes_id', $clouthes->id)
            ->delete();


        return back()->with('suc_msg', '移除成功');
    }

    public function addToMyDesign()
    {
        $validator = Validator::make(
            rq(),
            [
                'clouthes_id' => 'required|exists:clouthes,id',

            ],
            [
                'clouthes_id.required' => 'clouthes_id 不存在',
                'clouthes_id.exists' => 'clouthes_id 不属于数据库',
            ]
        );
        if ($validator->fails())
            return back()->with(['err_msg' => $validator->messages()]);

        $user = Auth::user();

        $clouthes = Clouthes::find(rq('clouthes_id'));

        $clouthes
            ->users()
            ->newPivotStatement()
//            从这里开始就进入了另一个数据模型了    进入的是那个中间的数据模型   就是轴模型 对应轴表
            ->where('user_id', $user->id)
            ->where('clouthes_id', $clouthes->id)
            ->delete();

        $clouthes->users()->attach($user->id);

        return back()->with('suc_msg', '操作成功');

    }

    public function updateUser(Request $request)
    {



        $validator = Validator::make(
            rq(),
            [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
                'desc' => 'required|max:255',
                'phone' => 'required|digits:11',
                'age' => 'integer',
//                'cover' => 'image',
                'identity' => 'required|in:' . identity_common . ',' . identity_designer,
                'sex' => 'required|in:' . sex_man . ',' . sex_woman,
            ],
            [

            ]
        );
        if ($validator->fails())
            return back()->with(['err_msg' => $validator->messages()]);


        $user = Auth::user();
        $user->name = rq('name');
        $user->email = rq('email');
        $user->desc = rq('desc');
        $user->age = rq('age');
        $user->phone = rq('phone');
        if ($request->avatar) {
            $avatar_path = $request->avatar->store('images', 'public');
            $user->avatar_uri = $avatar_path;
        }
        $user->identity = rq('identity');
        $user->sex = rq('sex');

        $user->save();
        return back()->with('suc_msg', '修改成功');
    }

}