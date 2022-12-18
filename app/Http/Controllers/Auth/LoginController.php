<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('web');
    }

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
