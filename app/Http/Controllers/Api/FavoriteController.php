<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /**
     * إضافة منتج إلى المفضلة أو إعادة تفعيله.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
        }

        // ✅ تحسين: نستخدم updateOrCreate للتعامل مع إعادة الإضافة للمفضلة
        // إذا كان المنتج موجودًا ومحذوفًا (is_active = false)، سيقوم بتفعيله مجددًا.
        $favorite = Favorite::updateOrCreate(
            [
                'user_id' => $user->id,
                'product_id' => $validated['product_id'],
            ],
            [
                'is_active' => true, // نضمن دائمًا أن الحالة نشطة عند الإضافة
            ]
        );

        return response()->json(['success' => true, 'message' => 'تمت الإضافة للمفضلة بنجاح', 'favorite' => $favorite], 201);
    }

    /**
     * عرض المنتجات المفضلة النشطة فقط.
     */
    public function index()
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'You must be logged in to view favorites'], 401);
        }

        // ✅ تحسين: نجلب فقط المفضلة التي حالتها نشطة
        $favorites = Favorite::with(['product.images'])
            ->where('user_id', $user->id)
            ->where('is_active', true) // <-- هذا السطر مهم جدًا
            ->get();

        return response()->json([
            'success' => true,
            'favorites' => $favorites
        ]);
    }

    // ====================================================================
    // ===== START: الدالة الجديدة لإزالة المنتج من المفضلة (Soft Delete) =====
    // ====================================================================
    /**
     * إزالة منتج من المفضلة عن طريق تغيير حالته إلى غير نشط.
     * @param int $productId
     */
    public function destroy($productId)
    {
        $user = Auth::guard('sanctum')->user();
        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
        }

        // 1. البحث عن المنتج في مفضلة المستخدم الحالي
        $favorite = Favorite::where('user_id', $user->id)
                            ->where('product_id', $productId)
                            ->first();

        // 2. إذا لم يتم العثور عليه، أرجع رسالة خطأ
        if (!$favorite) {
            return response()->json(['success' => false, 'message' => 'Favorite item not found'], 404);
        }

        // 3. تحديث الحالة إلى false (غير نشط)
        $favorite->is_active = false;
        $favorite->save();

        // 4. إرجاع رسالة نجاح
        return response()->json(['success' => true, 'message' => 'تمت الإزالة من المفضلة بنجاح']);
    }
    // ====================================================================
    // ===== END: نهاية الدالة الجديدة =====================================
    // ====================================================================
}
