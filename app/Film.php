<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    protected $table = 'films';

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function calendars()
    {
        return $this->hasMany('App\Calendar');
    }

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
