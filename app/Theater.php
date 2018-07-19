<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    protected $table='theaters';

    public function rooms()
    {
        return $this->hasMany('App\Room');
    }

    public function calendars()
    {
        return $this->hasManyThrough('App\Calendar', 'App\Room');
    }

    public function imguploads()
    {
        return $this->morphMany('App\ImageUpload', 'imgupload');
    }

    public function ticketPrices()
    {
        return $this->hasMany('App\TicketPrice');
    }
}
