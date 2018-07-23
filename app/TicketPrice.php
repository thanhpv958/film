<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TicketPrice extends Model
{
    protected $table = 'ticket_prices';

    public function theater()
    {
        return $this->belongsTo('App\Theater');
    }
}
