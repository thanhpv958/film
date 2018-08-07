<?php

namespace App\Listeners;

use App\User;
use App\Mail\UserBirthMail;
use App\Events\BirthdayEvent;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailBirthListener implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  BirthdayEvent  $event
     * @return void
     */
    public function handle(BirthdayEvent $event)
    {
        $user = $event->user;
        $user->update(['coupon_code' => str_random(10), 'active' => 0]);
        $email = new UserBirthMail($user);
        Mail::to($user->email)->send($email);
        return true;
    }
}
