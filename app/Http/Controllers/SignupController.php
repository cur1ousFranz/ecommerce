<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class SignupController extends Controller
{

    public function store(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => 'required|confirmed|min:6|max:16'
        ]);
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

    public function verifyEmail(Request $request)
    {
        $validated = $request->validate(['verify_code' => 'required']);
        $user = User::where('id', $request->user_id)->first();
        if($user->verify_code == $validated['verify_code']){
            $user->update(['email_verified' => 1]);
            Auth::login($user);
            $token = $user->createToken('main')->plainTextToken;
            return response([
                'user' => $user,
                'token' => $token
            ]);
        }

        return response()->json([
            'message' => 'Invalid Code',
        ], 403);

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
