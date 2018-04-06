<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clouthes extends Model
{
    //

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function profession()
    {
        return $this->belongsTo('App\Profession');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
