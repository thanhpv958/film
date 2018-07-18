<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calendar extends Model
{
    protected $table = 'calendars';

    public function room()
    {
        return $this->belongsTo('App\Room');
    }

    public function film()
    {
        return $this->belongsTo('App\Film');
    }

    public function calendarTimes()
    {
        return $this->hasMany('App\CalendarTime');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }
}
