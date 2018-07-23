<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CalendarTime extends Model
{
    protected $table = 'calendar_times';

    public function calendar()
    {
        return $this->belongsTo('App\Calendar');
    }
}
