<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'role',
        'coupon_code',
        'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function comments()
    {
        return $this->hasMany('App\Comment');
    }

    public function tickets()
    {
        return $this->hasMany('App\Ticket');
    }

    public function news()
    {
        return $this->hasMany('App\News');
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
