<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\City;
use App\Models\Address;
use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderDetail;

class OrderController extends Controller
{
    public function getCities()
    {
        $cities = City::all(); // استخدام :: بدلاً من -> لأنها استاتيكية

        return response()->json([
            'success' => true,
            'cities' => $cities
        ]);
    }


public function getUserAddress(Request $request)
{
    $userId = auth()->id();

    if (!$userId) {
        return response()->json([
            'success' => false,
            'message' => 'User not authenticated'
        ], 401);
    }

    // جلب العناوين مع بيانات المدينة المرتبطة (العلاقة BelongsTo)
    $addresses = Address::with('city')->where('user_id', $userId)->get();

    return response()->json([
        'success' => true,
        'addresses' => $addresses,
    ]);
}

public function addAddress(Request $request)
{
    $userId = auth()->id();

    if (!$userId) {
        return response()->json([
            'success' => false,
            'message' => 'User not authenticated'
        ], 401);
    }

    // التحقق من البيانات المدخلة (validation)
    $validatedData = $request->validate([
        'title' => 'nullable|string|max:255',
        'full_address' => 'required|string|max:1000',
        'city_id' => 'nullable|exists:cities,id',
        'custom_city' => 'nullable|string|max:255',
        'state' => 'nullable|string|max:255',
        'postal_code' => 'nullable|string|max:20',
        'country' => 'nullable|string|max:255',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
    ]);

    // التحقق من وجود إما city_id أو custom_city
    if (empty($validatedData['city_id']) && empty($validatedData['custom_city'])) {
        return response()->json([
            'success' => false,
            'message' => 'يجب اختيار مدينة أو إدخال اسم مدينة أخرى'
        ], 422);
    }

    // تعيين city_id إلى 14 إذا لم يُحدد ولم تُدخل مدينة مخصصة
    $cityId = $validatedData['city_id'] ?? null;
    if (empty($cityId)) {
        $cityId = 14;
    }

    $address = new Address();
    $address->user_id = $userId;
    $address->title = $validatedData['title'] ?? null;
    $address->full_address = $validatedData['full_address'];

    // تعيين city_id دائماً
    $address->city_id = $cityId;

    // تعيين custom_city فقط لو city_id = 14
    if ($cityId == 14) {
        $address->custom_city = $validatedData['custom_city'] ?? null;
    } else {
        $address->custom_city = null;
    }

    $address->state = $validatedData['state'] ?? null;
    $address->postal_code = $validatedData['postal_code'] ?? null;
    $address->country = $validatedData['country'] ?? 'Jordan';
    $address->latitude = $validatedData['latitude'] ?? null;
    $address->longitude = $validatedData['longitude'] ?? null;

    $address->save();

    return response()->json([
        'success' => true,
        'message' => 'Address added successfully',
        'address' => $address
    ]);
}





public function deleteAddress($id)
{
    $userId = auth()->id();

    if (!$userId) {
        return response()->json([
            'success' => false,
            'message' => 'User not authenticated'
        ], 401);
    }

    // جلب العنوان حسب الـ id والـ user_id (للتأكد من ملكيته)
    $address = Address::where('id', $id)->where('user_id', $userId)->first();

    if (!$address) {
        return response()->json([
            'success' => false,
            'message' => 'Address not found or you do not have permission to delete it'
        ], 404);
    }

    // حذف العنوان
    $address->delete();

    return response()->json([
        'success' => true,
        'message' => 'Address deleted successfully'
    ]);
}



public function CreateOrder(Request $request)
{
    $userId = auth()->id();

    if (!$userId) {
        return response()->json([
            'success' => false,
            'message' => 'User not authenticated'
        ], 401);
    }

    $validatedData = $request->validate([
        'payment_method' => 'required|string',
        'shipping_method' => 'required|string',
        'address_id' => 'required|integer|exists:addresses,id',
        'email' => 'nullable|email',
        'note' => 'nullable|string',
    ]);

    $order = Order::where('user_id', $userId)
        ->where('order_status', 'cart')
        ->first();

    if ($order) {
        // تحديث الطلب
        $order->payment_method = $validatedData['payment_method'];
        $order->email = $validatedData['email'] ?? $order->email;
        $order->shipping_method = $validatedData['shipping_method'];
        $order->address_id = $validatedData['address_id'];
        $order->note = $validatedData['note'] ?? $order->note;
        $order->order_status = "pending_payment";
        $order->save();

        // جلب عناصر الكارت
        $cartItems = Cart::where('user_id', $userId)
            ->where('status', 'pending')
            ->get();

        foreach ($cartItems as $item) {
            $product = Product::find($item->product_id);
            if (!$product) continue; // تأكد أن المنتج موجود

            $price = $product->price; // لازم تتأكد إن عمود price موجود في جدول products
            $quantity = $item->quantity;
            $discount = 0; // لو عندك خصم ممكن تجيبه من مكان ثاني
            $total = $quantity * $price;

            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $quantity,
                'price' => $price,
                'discount' => $discount,
                'total_price' => $total,
            ]);

            // تحديث حالة الكارت
            $item->status = 'ordered';
            $item->order_id = $order->id;
            $item->ordered_at = now();
            $item->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Order created and cart items moved to order_details.',
            'order' => $order,
        ]);
    } else {
        return response()->json([
            'success' => false,
            'message' => 'No cart order found for update',
        ], 404);
    }
}




}
