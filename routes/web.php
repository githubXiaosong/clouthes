<?php

function rq($key = null)
{
    return ($key == null) ? \Illuminate\Support\Facades\Request::all() : \Illuminate\Support\Facades\Request::get($key);
}

function suc($data = null)
{
    $ram = ['status' => 0];
    if ($data) {
        $ram['data'] = $data;
        return $ram;
    }
    return $ram;
}

function err($code, $data = null)
{
    if ($data)
        return ['status' => $code, 'data' => $data];
    return ['status' => $code];
}


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => 'web'], function () {

    Route::get('/home', 'HomeController@index');
    Route::get('/test', 'PageController@test');
    Route::get('/clouthesList', 'PageController@clouthesList')->middleware('auth');
    Route::get('/desingerList', 'PageController@desingerList')->middleware('auth');
    Route::get('/addClouthes/{user_id}', 'PageController@addClouthes')->middleware('auth');
    Route::get('/myDesign/{user_id}', 'PageController@myDesign')->middleware('auth');
    Route::get('/mine/{user_id}', 'PageController@mine')->middleware('auth');

    Route::group(['prefix' => 'api'], function () {

        Route::post('/uploadClouthes', 'ServiceController@uploadClouthes')->middleware('auth');
        Route::post('/deleteClouthes', 'ServiceController@deleteClouthes')->middleware('auth');
        Route::post('/addToMyDesign', 'ServiceController@addToMyDesign')->middleware('auth');
        Route::post('/deleteDesign', 'ServiceController@deleteDesign')->middleware('auth');
        Route::post('/updateUser', 'ServiceController@updateUser')->middleware('auth');

    });

    Route::group(['prefix' => 'admin'], function () {
        Route::get('/index', 'Admin\PageController@index');
        Route::get('/login', 'Admin\PageController@login');
        Route::get('/welcome', 'Admin\PageController@welcome');
        Route::get('/memberAdd', 'Admin\PageController@memberAdd');
        Route::get('/memberEdit/{user_id}', 'Admin\PageController@memberEdit');
        Route::get('/memberList', 'Admin\PageController@memberList');
        Route::get('/clouthesList', 'Admin\PageController@clouthesList');
        Route::get('/clouthesAdd', 'Admin\PageController@clouthesAdd');
        Route::get('/clouthesEdit/{clouthes_id}', 'Admin\PageController@clouthesEdit');
        Route::group(['prefix' => 'api'], function () {
            Route::post('/changeUserStatus', 'Admin\ServiceController@changeUserStatus');
            Route::post('/editUser', 'Admin\ServiceController@editUser');
            Route::post('/addUser', 'Admin\ServiceController@addUser');
            Route::post('/deleteUser', 'Admin\ServiceController@deleteUser');
            Route::post('/editClouthes', 'Admin\ServiceController@editClouthes');
            Route::post('/deleteClouthes', 'Admin\ServiceController@deleteClouthes');

        });
    });
});
