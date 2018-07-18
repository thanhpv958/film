<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    public function film()
    {
        return $this->belongsTo('App\Film');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
