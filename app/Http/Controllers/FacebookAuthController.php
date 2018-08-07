<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class FacebookAuthController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleProviderCallback()
    {
        $userSocial = Socialite::driver('facebook')->user();

        $user = User::where('email', $userSocial->user['email'])->first();
        if ($user) {
            if (Auth::loginUsingId($user->id)) {
                return redirect()->route('home');
            }
        }

        $userSignUp = User::create([
            'name' => $userSocial->user['name'],
            'email' => $userSocial->user['email'],
            'image' => 'default-avatar.png',
            'password' => bcrypt('123456'),
            'role' => 3,
            'rank' => 1,
        ]);

        if ($userSignUp) {
            if (Auth::loginUsingId($userSignUp->id)) {
                return redirect()->route('home');
            }
        }
    }
}
