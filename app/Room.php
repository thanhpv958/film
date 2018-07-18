<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $table='rooms';

    public function theater()
    {
        return $this->belongsTo('App\Theater');
    }

    public function calendars()
    {
        return $this->hasMany('App\Calendar');
    }
}
