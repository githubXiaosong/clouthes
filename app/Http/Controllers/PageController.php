<?php

namespace App\Http\Controllers;

use App\Category;
use App\Clouthes;
use App\Profession;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function test()
    {
        dd(csrf_field());
    }

    public function addClouthes($user_id)
    {

        $professions = Profession::get();
        $clouthes = Clouthes::where('user_id', $user_id)->with('category')->get();
        $categories = Category::get();
        return view('addclouthes')->with(['clouthes' => $clouthes, 'categories' => $categories, 'professions' => $professions]);
    }

    public function myDesign($user_id)
    {

        $categories = Category::get();
        $user = Auth::user();
        $clouthes = $user->clouthes()->with('category')->get();

//        dd($clouthes);

        return view('mydesign')->with(['clouthes' => $clouthes, 'categories' => $categories]);
    }

    public function clouthesList()
    {

        $professions = Profession::get();

        $categories = Category::get();

        $clouthes = new Clouthes();

        if (rq('title')) {
            $clouthes = $clouthes->where('title', 'like', '%' . rq('title') . '%');
        }
        if (rq('category')) {
            $clouthes = $clouthes->where('category_id', rq('category'));
        }
        if (rq('season')) {
            $clouthes = $clouthes->where('season', rq('season'));
        }
        if (rq('age')) {
            $clouthes = $clouthes->where('age', rq('age'));
        }

        if (rq('sex')) {
            $clouthes = $clouthes->where('sex', rq('sex'));
        }
        if (rq('profession')) {
            $clouthes = $clouthes->where('profession_id', rq('profession'));
        }


        $clouthes = $clouthes->with('profession')->get();

        $user = Auth::user();

        foreach ($clouthes as $item) {
            $item->is_added = $item->users()
                ->newPivotStatement()
                ->where('user_id', $user->id)
                ->where('clouthes_id', $item->id)
                ->first();
        }


        return view('cloutheslist')->with(['clouthes' => $clouthes, 'categories' => $categories,'professions' => $professions]);
    }


    public function desingerList()
    {

        $desingers = User::where(['identity' => 10]);

        if (rq('name')) {
            $desingers = $desingers->where('name', 'like', '%' . rq('name') . '%');
        }
        if (rq('sex')) {
            $desingers = $desingers->where('sex', rq('sex'));
        }
        if (rq('age')) {
            $desingers = $desingers->whereBetween('age', [rq('age'), rq('age') + 10]);
        }


        $desingers = $desingers->get();


        return view('desingerlist')->with(['desingers' => $desingers]);
    }

    public function mine()
    {
        $user = Auth::user();

        return view('mine')->with(['user' => $user]);
    }

}
