<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function delete()
    {
        Auth::user()->currentAccessToken()->delete();

        return response([
            'success' => true
        ]);
    }
}
