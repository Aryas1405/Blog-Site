<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends App
{
    use SoftDeletes;
    public function blog()
    {
        return $this->belongsToMany('App\Blog');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
