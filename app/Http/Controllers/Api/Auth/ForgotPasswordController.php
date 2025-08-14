<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    /**
     * الدالة الأولى: طلب إرسال رابط إعادة التعيين
     * تستقبل البريد الإلكتروني، تنشئ رمزًا، وتُرسل الرابط.
     */
public function forgotPassword(Request $request)
{
    $validator = Validator::make($request->all(), [
        'email' => 'required|email|exists:users,email',
    ]);

    if ($validator->fails()) {
        return response()->json(['success' => false, 'message' => $validator->errors()->first()], 422);
    }

    // 1. إنشاء رمز عشوائي وآمن
    $token = Str::random(64);

    // 2. تخزين الرمز مع البريد الإلكتروني في جدول إعادة التعيين
    DB::table('password_reset_tokens')->updateOrInsert(
        ['email' => $request->email],
        [
            'token' => $token,
            'created_at' => now()
        ]
    );

    // 3. احصل على اللغة من الطلب، مع وضع 'en' كقيمة افتراضية
    $locale = $request->input('locale', 'en');

    // 4. قم ببناء الرابط الصحيح والنهائي مع اللغة
    $resetLink = env('FRONTEND_URL') . "/" . $locale . "/auth/reset-password?token=" . $token . "&email=" . urlencode($request->email);

    // 5. إرسال البريد الإلكتروني للمستخدم
    try {
        Mail::raw("لإعادة تعيين كلمة المرور، يرجى الضغط على الرابط التالي: " . $resetLink, function ($message) use ($request) {
            $message->to($request->email)
                    ->subject('إعادة تعيين كلمة المرور');
        });
    } catch (\Exception $e) {
        // Log the actual error for debugging
        \Log::error('Mail sending failed: ' . $e->getMessage());
        return response()->json(['success' => false, 'message' => 'فشل إرسال البريد الإلكتروني. يرجى المحاولة مرة أخرى.'], 500);
    }

    return response()->json(['success' => true, 'message' => 'تم إرسال رابط إعادة تعيين كلمة المرور إلى بريدك الإلكتروني.']);
}

    /**
     * الدالة الثانية: إعادة تعيين كلمة المرور فعليًا
     * تستقبل الرمز، البريد، وكلمة المرور الجديدة.
     */
    public function resetPassword(Request $request)
    {
        // 1. التحقق من صحة البيانات المدخلة
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
            'token' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'message' => $validator->errors()->first()], 422);
        }

        // 2. التحقق من وجود الرمز في قاعدة البيانات
        $resetRecord = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        // إذا لم يتم العثور على الرمز أو انتهت صلاحيته (أكثر من 60 دقيقة)
        if (!$resetRecord || now()->subMinutes(60)->gt($resetRecord->created_at)) {
            return response()->json(['success' => false, 'message' => 'الرمز غير صالح أو انتهت صلاحيته.'], 400);
        }

        // 3. تحديث كلمة المرور للمستخدم
        $user = User::where('email', $request->email)->first();
        $user->password = Hash::make($request->password);
        $user->save();

        // 4. حذف الرمز المستخدم من قاعدة البيانات
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return response()->json(['success' => true, 'message' => 'تم تغيير كلمة المرور بنجاح.']);
    }
}
