<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;

class ApiRegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'Fname' => $request->Fname,
            'Lname' => $request->Lname,
            // 'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $token = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'User registered successfully.',
            'user' => $user->only('id','Fname','Lname','email'),
            'accessToken' => $token,
        ]);
    }
}
