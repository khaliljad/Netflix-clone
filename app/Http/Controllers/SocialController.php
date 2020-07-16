<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($service) {

        return Socialite::driver($service)->redirect();

    }

    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }


    public function callback($service) {

        return $user = Socialite::with($service)->user();

    }
}
