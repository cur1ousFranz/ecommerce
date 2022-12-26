<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class SocialSigninController extends Controller
{
    public function googleAuth()
    {
        return Socialite::driver('google')->redirect();
    }

    public function googleAuthCallBack()
    {
        $user = Socialite::driver('google')->user();

        var_dump($user);
    }
}
