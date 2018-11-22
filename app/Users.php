<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public function passwords()
    {
        return $this->hasMany('App\Passwords');
    }

    public function categories()
    {
        return $this->hasMany('App\Category');
    }

    public function rol()
    {
        return $this->belongsTo('App\Rol');
    }
}

