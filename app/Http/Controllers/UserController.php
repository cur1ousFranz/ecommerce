<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        // $user = User::where('id', Auth::user()->id)->first();
        return response()->json(['data' => Auth::check()]);
    }
}
