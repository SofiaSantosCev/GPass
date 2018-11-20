<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    /**
     * Get the comments for the blog post.
     */
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

