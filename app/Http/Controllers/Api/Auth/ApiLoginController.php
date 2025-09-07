<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Hash;

class ApiLoginController extends Controller
{

    public function login(LoginRequest $request)
    {
        $user = User::where('email', $request->email)
            ->select('id','Fname','Lname','email','password')
            ->first();
    
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials'
            ], 401);
        }
    
        $token = $user->createToken('customer-token')->plainTextToken;
    
        return response()->json([
            'success' => true,
            'accessToken' => $token,
            'user' => $user->only('id','Fname','Lname','email'),
        ]);
    }
    
}
