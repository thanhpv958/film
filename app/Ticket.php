<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';

    public function calendar()
    {
        return $this->belongsTo('App\Calendar');
    }

    public function seats()
    {
        return $this->hasMany('App\Seat');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
