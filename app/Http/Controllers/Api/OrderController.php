<?php

namespace App\Http\Controllers\Api;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use App\Mail\AdminOrderNotification;
use App\Mail\UserOrderConfirmation;
use App\Mail\UserPendingPaymentNotice;
use Illuminate\Support\Facades\Mail;
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

    // validation بدون custom_city
    $validatedData = $request->validate([
        'title' => 'nullable|string|max:255',
        'full_address' => 'required|string|max:1000',
        'city_id' => 'required|exists:cities,id', // اجعلها required
        'state' => 'nullable|string|max:255',
        'postal_code' => 'nullable|string|max:20',
        'country' => 'nullable|string|max:255',
        'latitude' => 'nullable|numeric',
        'longitude' => 'nullable|numeric',
    ]);

    $address = new Address();
    $address->user_id = $userId;
    $address->title = $validatedData['title'] ?? null;
    $address->full_address = $validatedData['full_address'];
    $address->city_id = $validatedData['city_id'];
    // شيل $address->custom_city

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

public function createOrder(Request $request)
{
    \Log::info('== Start createOrder ==');
    \Log::info('Uploaded Files:', $request->allFiles());
    \Log::info('Request Data:', $request->all());

    try {
        $userId = auth()->id();
        \Log::info("Authenticated user ID: " . $userId);

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'User not authenticated'
            ], 401);
        }

        $validatedData = $request->validate([
            'payment_method'   => 'required|string|in:cash_on_delivery,stripe,bank_transfer',
            'shipping_method'  => 'required|string|in:home_delivery,pickup',
            'address_id'       => 'required|integer|exists:addresses,id',
            'email'            => 'nullable|email',
            'note'             => 'nullable|string',
            'image'            => 'required_if:payment_method,stripe|required_if:payment_method,bank_transfer|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'transaction_id'   => 'nullable|string|max:255',
            'paid_amount'      => 'nullable|numeric',
            'bank_name'        => 'nullable|string|max:255',
            'account_number'   => 'nullable|string|max:255',
        ]);
        \Log::info('Validation passed', $validatedData);

        $order = Order::where('user_id', $userId)
            ->where('order_status', 'cart')
            ->first();

        if (!$order) {
            \Log::warning("No cart order found for user $userId");
            return response()->json([
                'success' => false,
                'message' => 'No cart order found for update',
            ], 404);
        }

        $order->payment_method  = $validatedData['payment_method'];
        $order->email           = $validatedData['email'] ?? $order->email;
        $order->shipping_method = $validatedData['shipping_method'];
        $order->address_id      = $validatedData['address_id'];
        $order->note            = $validatedData['note'] ?? $order->note;
        $order->order_status    = "pending_payment";

        $cartItems = Cart::where('user_id', $userId)
            ->where('status', 'pending')
            ->where('order_id', $order->id)
            ->get();

        $totalPrice = 0.0;

       foreach ($cartItems as $item) {
    $product = Product::find($item->product_id);
    if (!$product) {
        \Log::warning("Product not found for cart item", ['cart_item_id' => $item->id]);
        continue;
    }

    $unitPrice = $product->price_after_discount ?? $product->price ?? 0;
    $itemTotal = $item->quantity * $unitPrice;
    $totalPrice += $itemTotal;

    OrderDetail::create([
        'order_id'    => $order->id,
        'product_id'  => $product->id,
        'quantity'    => $item->quantity,
        'price'       => $unitPrice,
        'discount'    => 0,
        'total_price' => $itemTotal,
    ]);

    $item->status     = 'ordered';
    $item->ordered_at = now();
    $item->save();

    $product->increment('sold_count', $item->quantity);
    \Log::info("Sold count updated", [
        'product_id' => $product->id,
        'added'      => $item->quantity,
        'new_count'  => $product->sold_count
    ]);
}


        $FREE_SHIPPING_THRESHOLD = 20;

        $deliveryFee = 0.0;
        $freeShippingApplied = false;

        $address = \App\Models\Address::find($validatedData['address_id']);
        if ($address && $validatedData['shipping_method'] === 'home_delivery') {
            $deliveryFee = (float) ($address->city->delivery_fee ?? 0);

            if ($totalPrice > $FREE_SHIPPING_THRESHOLD) {
                $freeShippingApplied = true;
                $deliveryFee = 0.0;
                \Log::info("Free shipping applied since subtotal >= {$FREE_SHIPPING_THRESHOLD}");
            }
        }

        if ($validatedData['shipping_method'] !== 'home_delivery') {
            $deliveryFee = 0.0;
        }

    $order->total_price = $totalPrice;
$order->final_price = $totalPrice + $deliveryFee;

        $order->save();


       // تحديد حالة الطلب حسب وسيلة الدفع
if ($validatedData['payment_method'] === 'cash_on_delivery') {
    $order->order_status = 'processing';
    $order->save();

    // إرسال تأكيد للعميل عند بدء تجهيز الطلب
    if (!empty($order->email)) {
        Mail::to($order->email)->send(new UserOrderConfirmation($order));
        \Log::info("User notified with processing confirmation email at: " . $order->email);
    }

} else {
    // إرسال تنبيه بأن الطلب قيد الانتظار لحين الدفع
    if (!empty($order->email)) {
        Mail::to($order->email)->send(new UserPendingPaymentNotice($order));
        \Log::info("User notified with pending payment notice email at: " . $order->email);
    }
}

// إرسال تنبيه للإدمن دائماً
$adminEmail = 'yasmeen.abuzaid@a-tech.dev'; // أو اجلبه من config
Mail::to($adminEmail)->send(new AdminOrderNotification($order));
\Log::info("Admin notified via email at: " . $adminEmail);


        \Log::info("Prices calculated", [
            'subtotal'              => $totalPrice,
            'delivery_fee'          => $deliveryFee,
            'free_shipping_applied' => $freeShippingApplied,
            'final_price'           => $order->final_price
        ]);

        \Log::info("Cart items moved to order details", ['count' => $cartItems->count()]);

        if (in_array($validatedData['payment_method'], ['stripe', 'bank_transfer'])) {

            $uploadedFile = $request->file('image');
            \Log::info("Uploading image to Cloudinary...");
            $cloudinaryUpload = Cloudinary::upload($uploadedFile->getRealPath(), [
                'folder'        => 'payment_proofs',
                'resource_type' => 'auto',
            ]);
            $imageUrl = $cloudinaryUpload->getSecurePath();
            \Log::info("Uploaded to Cloudinary", ['url' => $imageUrl]);

            \App\Models\PaymentProof::create([
                'order_id'       => $order->id,
                'user_id'        => $userId,
                'image'          => $imageUrl,
                'payment_method' => $validatedData['payment_method'],
                'transaction_id' => $validatedData['transaction_id'] ?? null,
                'paid_amount'    => $validatedData['paid_amount'] ?? null,
                'bank_name'      => $validatedData['bank_name'] ?? null,
                'account_number' => $validatedData['account_number'] ?? null,
                'note'           => $validatedData['note'] ?? null,
                'submitted_at'   => now(),
            ]);
            \Log::info("Payment proof saved");
        }

        // $adminEmail = config('mail.username', 'yasmeen.abuzaid@a-tech.dev');
        // Mail::to('yaseenrasha4@gmail.com')->send(new AdminOrderNotification($order));
        // \Log::info("Admin notified via email at: " . $adminEmail);

        return response()->json([
            'success'                => true,
            'message'                => $freeShippingApplied
                ? 'Order created successfully. Free delivery applied.'
                : 'Order created successfully.',
            'order'                  => $order,
            'subtotal'               => $totalPrice,
            'deliveryFee'            => $deliveryFee,
            'finalPrice'             => $order->final_price,
            'free_shipping_applied'  => $freeShippingApplied,
            'free_shipping_threshold'=> $FREE_SHIPPING_THRESHOLD,
        ]);

    } catch (\Exception $e) {
        \Log::error('CreateOrder error: ' . $e->getMessage(), [
            'trace'   => $e->getTraceAsString(),
            'request' => $request->all()
        ]);
        return response()->json([
            'success' => false,
            'message' => 'Something went wrong. Please try again.',
        ], 500);
    }
}

}
