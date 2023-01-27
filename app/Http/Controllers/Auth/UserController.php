<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\Auth\SigninRequest;
use App\Http\Requests\Auth\SignupRequest;
use App\Http\Requests\Auth\VerifyCodeRequest;
use App\Http\Requests\Auth\ForgotPasswordRequest;
use App\Http\Requests\Auth\ForgotPasswordResetRequest;

class UserController extends Controller
{

    public function show(SigninRequest $request)
    {

        $validated = $request->validated();
        $user = User::where('email', $validated['email'])->first();
        $remember = $request->remember;

        if($user){
            if($user->role === 'customer'){
                if($user->email_verified == 1){
                    if(Auth::attempt($validated, $remember)){
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
            }
        }

        return response()->json([
            'errors' =>  ['invalid_credentials' => ['Invalid Credentials.']],
        ], 401);
    }

    public function showAdmin(SigninRequest $request)
    {
        $validated = $request->validated();
        $user = User::where('email', $validated['email'])->first();
        $remember = $request->remember;

        if($user->role === 'admin'){
            if(Auth::attempt($validated, $remember)){
                $auth = Auth::user();
                $token = $user->createToken('main')->plainTextToken;
                return response([
                    'user' => $auth,
                    'token' => $token
                ]);
            }
        }

        return response()->json([
            'errors' =>  ['invalid_credentials' => ['Invalid Credentials.']],
        ], 401);
    }

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

        $customer = $user->customers()->create();
        $customer->cart()->create();
        $customer->address()->create();

        $data = array('code' => $code);
        Mail::send('email.email-content', $data, function($message) use ($user){
            $message->to($user->email)->subject('Verfication Code');
        });

        return response([
            'user_id' => $user->id,
        ]);
    }

    public function update(ForgotPasswordRequest $request)
    {
        $validated = $request->validated();
        $user = User::where('email', $validated['email'])->first();

        if ($user) {
            $token = Str::random(120);
            $user->forgot_password_token = $token;
            $user->save();
            // Should change the redirect URL
            $data = array('link' => config('app.url') . ':5173' . '/reset/password/?token=' . $token);
            Mail::send('email.email-password-reset', $data, function($message) use ($user){
                $message->to($user->email)->subject('Password Reset');
            });

            return response()->json([
                'data' =>  'Forgot Password link has been sent!',
            ], 201);
        }

        return response()->json([
            'errors' =>  ['email' => ['Email does not exist.']],
        ], 401);
    }

    public function updatePassword(ForgotPasswordResetRequest $request)
    {
        $validated = $request->validated();
        $user = User::where('forgot_password_token', $validated['token'])->first();
        if($user){
            $user->password = bcrypt($validated['password']);
            $user->forgot_password_token = null;
            $user->save();
            return response()->json([
                'success' =>  'Password Updated Successfully!',
            ], 201);
        }

        return response()->json([
            'errors' =>  ['token' => ['Session Expired. Try again.']],
        ], 401);
    }

    public function delete()
    {
        Auth::user()->currentAccessToken()->delete();
        return response([
            'success' => true
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
