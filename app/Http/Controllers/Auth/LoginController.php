<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request; // <-- ضيف هاي

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        // هنا نقوم بإضافة شرط أن يكون الدور 'manager' مع الإيميل وكلمة المرور
        return array_merge($request->only($this->username(), 'password'), ['role' => 'manager']);
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo(){

        if (session()->has('from_checkout')) {
            session()->forget('from_checkout');
            return route('order.create');
        }

        // بما أنه بس المدير رح يقدر يفوت، هاي الجملة الشرطية ما عاد إلها داعي
        // if (Auth::user()->role == 'manager') {
            return route('dashboard');
        // } else {
        //     return '/';
        // }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
