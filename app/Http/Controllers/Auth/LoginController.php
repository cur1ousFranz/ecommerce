<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Requests\Auth\SigninRequest;

class LoginController extends Controller
{

    public function show(SigninRequest $request)
    {
        $validated = $request->validated();

        $user = User::where('email', $validated['email'])->first();
        if($user->email_verified == 1){
            if(Auth::attempt($validated)){
                $auth = Auth::user();
                $token = $user->createToken('main')->plainTextToken;
                return response([
                    'user' => $auth,
                    'token' => $token
                ]);
            }
        }else{
            $code = rand(124101, 999999);
            $user->update(['verify_code' => $code]);
            $data = array('code' => $code);
            Mail::send('email.email-content', $data, function($message) use ($user){
                $message->to($user->email)->subject('Verfication Code');
            });

            return response([
                'user_id' => $user->id,
            ]);
        }

        return response()->json([
            'errors' =>  ['invalid_credentials' => ['Invalid Credentials.']],
        ], 401);
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
