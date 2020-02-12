<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;


class Blog extends App
{
    use SoftDeletes;
    public function category()
    {
     return $this->belongsTo('App\Category')->orderBy('created_at','desc');
    }   
    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function comments()
    {
        return $this->hasMany('App\Comment')->orderBy('created_at','desc');
    }
}
