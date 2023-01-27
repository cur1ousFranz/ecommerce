<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Customer\CustomerDetailsRequest;

class CustomerController extends Controller
{

    private function customer()
    {
        return Customer::where('user_id', auth()->user()->id)->first();
    }

    public function index()
    {
        return response()->json([
            'data' => $this->customer()
        ]);
    }

    public function store(CustomerDetailsRequest $request)
    {
        $validated = $request->validated();

        $customer = $this->customer();
        $customer->first_name = $validated['first_name'];
        $customer->last_name = $validated['last_name'];
        $customer->gender = $validated['gender'];
        $customer->birth_date = $validated['birth_date'];
        $customer->save();

        return response()->json([
            'data' => $customer
        ]);
    }

    public function updatePassword(Request $request)
    {
        $validated = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6|max:16',
        ]);

        $user = User::where('id', auth()->user()->id)->first();
        if (Hash::check($validated['current_password'], $user->password)) {
            $user->password = bcrypt($validated['password']);
            $user->save();
            return response()->json([
                'data' => 'Success'
            ], 201);
        }

        return response()->json([
            'errors' =>  ['current_password' => ['Wrong password.']],
        ], 401);
    }
}
