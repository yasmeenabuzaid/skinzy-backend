<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;

class CartController extends Controller
{

public function getCart(Request $request)
{
    $userId = auth()->id();
    if (!$userId) {
        return response()->json([
            'success' => false,
            'message' => 'User not authenticated'
        ], 401);
    }

    // جلب جميع عناصر السلة التي تكون status = 'pending' ولمستخدم محدد
    $cartItems = Cart::where('user_id', $userId)
        ->where('status', 'pending')
        ->with('product') // تأكد أن العلاقة 'product' معرفة في موديل Cart
        ->get();

    return response()->json([
        'success' => true,
        'cart' => $cartItems,
    ]);
}






  public function addToCart(Request $request)
{
    $request->validate([
        'productId' => 'required|integer|exists:products,id',
        'quantity' => 'nullable|integer|min:1',
    ]);

    $userId = auth()->id();
    $user = auth()->user();

    // جلب الطلب الحالي (pending_payment) أو إنشاء واحد جديد
    $order = Order::firstOrCreate(
        ['user_id' => $userId, 'order_status' => 'pending_payment'],
        [
            'total_price' => 0,
            'mobile' => $user->mobile ?? null,
        ]
    );

    $quantity = $request->input('quantity', 1);

    // ✅ جلب فقط عناصر السلة النشطة (status = pending)
    $cartItem = Cart::where('user_id', $userId)
        ->where('product_id', $request->productId)
        ->where('order_id', $order->id)
        ->where('status', 'pending') // 🔥 هذا هو التعديل المهم
        ->first();

    if ($cartItem) {
        // إذا موجود بالفعل بالحالة الصحيحة، حدث الكمية فقط
        $cartItem->quantity += $quantity;
        $cartItem->save();
    } else {
        // إنشاء عنصر جديد بالحالة "pending"
        $cartItem = Cart::create([
            'user_id' => $userId,
            'product_id' => $request->productId,
            'quantity' => $quantity,
            'order_id' => $order->id,
            'status' => 'pending', // ✅ تأكيد الحالة
        ]);
    }

    return response()->json([
        'success' => true,
        'cartItem' => $cartItem,
    ]);
}





 public function deleteFromCart(Request $request)
{
    $request->validate([
        'id' => 'required|integer|exists:cart,id',
    ]);

    $userId = auth()->id();

    $cartItem = \App\Models\Cart::where('id', $request->id)
        ->where('user_id', $userId)
        ->first();

    if (!$cartItem) {
        return response()->json(['success' => false, 'message' => 'Item not found'], 404);
    }

    // تغيير حالة العنصر بدلاً من حذفه
    $cartItem->status = 'deleted'; // تأكد من أن القيمة 'deleted' متوافقة مع نظامك
    $cartItem->save();

    return response()->json(['success' => true, 'message' => 'Item marked as deleted successfully']);
}
public function updateCart(Request $request)
{
    $request->validate([
        'id' => 'required|integer|exists:cart,id',
    ]);

    $userId = auth()->id();

    $cartItem = Cart::where('id', $request->id)
        ->where('user_id', $userId)
        ->first();

    if (!$cartItem) {
        return response()->json([
            'success' => false,
            'message' => 'Cart item not found or unauthorized'
        ], 404);
    }

    // تغيير الحالة فقط إلى deleted
    $cartItem->status = 'cancelled';
    $cartItem->save();

    return response()->json([
        'success' => true,
        'message' => 'Cart item marked as deleted'
    ]);
}
public function updateCartq(Request $request)
{
    $request->validate([
        'id' => 'required|integer|exists:cart,id',
        'quantity' => 'required|integer|min:1',  // تأكد من وجود الكمية وصحتها
    ]);

    $userId = auth()->id();

    $cartItem = Cart::where('id', $request->id)
        ->where('user_id', $userId)
        ->first();

    if (!$cartItem) {
        return response()->json([
            'success' => false,
            'message' => 'Cart item not found or unauthorized'
        ], 404);
    }

    // تحديث الكمية فقط
    $cartItem->quantity = $request->quantity;
    $cartItem->save();

    return response()->json([
        'success' => true,
        'message' => 'Cart item quantity updated successfully',
        'cartItem' => $cartItem,
    ]);
}


}

