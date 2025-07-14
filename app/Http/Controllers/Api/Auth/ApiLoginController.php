<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class ApiLoginController extends Controller
{
    public function __construct()
    {
        // لا حاجة لميدل وير 'guest' هنا
    }

    // دالة التعامل مع طلب الدخول
  public function login(Request $request)
{
    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    $token = $user->createToken('customer-token')->plainTextToken;

    return response()->json([
        'success' => true,
        'accessToken' => $token,
        'user' => $user
    ]);
}

    // دالة التحقق من المدخلات
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }
}
