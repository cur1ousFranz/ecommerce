<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\SignupRequest;
use App\Http\Requests\Auth\VerifyCodeRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SignupController extends Controller
{
    public function store(SignupRequest $request)
    {
        $validated = $request->validated();
        $code = rand(124101, 999999);
        $user = User::create([
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => 'customer',
            'verify_code' => $code,
        ]);

        $data = array('code' => $code);
        Mail::send('email.email-content', $data, function($message) use ($user){

            $message->to($user->email)->subject('Verfication Code');
        });

        return response([
            'user_id' => $user->id,
        ]);

    }


    public function verifyEmail(VerifyCodeRequest $request)
    {
        $validated = $request->validated();
        $user = User::where('id', $request->user_id)->first();
        if($user->verify_code == $validated['verify_code']){
            $user->update(['email_verified' => 1]);
            return response()->json([
                'message' => 'Success',
            ], 200);
        }

        return response()->json([
            'errors' =>  ['verify_code' => ['Invalid Code.']],
        ], 400);
    }

    public function resendVerifyEmail(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        $code = rand(124101, 999999);
        $user->update(['verify_code' => $code]);
        $data = array('code' => $code);

        Mail::send('email.email-content', $data, function($message) use ($user){
            $message->to($user->email)->subject('Verfication Code');
        });

        return response()->json([
            'message' => 'Success',
        ], Response::HTTP_OK);
    }
}
