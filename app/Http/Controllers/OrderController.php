<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\PaymentProof;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();

        return view('dashboard.order.index', ['orders' => $orders]);
    }

    public function create()
    {
        if (!auth()->check()) {
            session(['from_checkout' => true]);
            return redirect()->route('cart.index')->with('error', 'Please log in to proceed with checkout.');
        }

        $cart = json_decode(Cookie::get('cart', json_encode([])), true);
        return view('checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'city' => 'required|string',
            'street' => 'required|string',
            'building_number' => 'required|string',
            'mobile' => 'required|regex:/^(\+?\d{1,3}[- ]?)?\d{10}$/',
            'email' => 'nullable|email',
            'note' => 'nullable|string|max:255',
            'payment_method' => 'required|in:stripe,cash_on_delivery',
            'shipping_method' => 'required|in:home_delivery,pickup',
        ]);

        $cart = json_decode($request->cookie('cart'), true);

        if (!$cart || count($cart) === 0) {
            return back()->with('error', 'Your cart is empty.');
        }

        $productIds = collect($cart)->pluck('product_id')->toArray();
        $products = \App\Models\Product::whereIn('id', $productIds)->get()->keyBy('id');

        $totalPrice = collect($cart)->sum(function ($item) use ($products) {
            $product = $products[$item['product_id']];
            $final_price = $product->price;

            return $final_price * $item['quantity'];
        });

        try {
            $order_status = $request->payment_method === 'stripe' ? 'pending_payment' : 'processing';

            $order = Order::create([
                'city' => $request->city,
                'street' => $request->street,
                'building_number' => $request->building_number,
                'mobile' => $request->mobile,
                'email' => $request->email,
                'total_price' => $totalPrice,
                'order_status' => $order_status,
                'note' => $request->note,
                'payment_method' => $request->payment_method,
                'shipping_method' => $request->shipping_method,
                'user_id' => auth()->id(),
            ]);

            foreach ($cart as $item) {
                $product = $products[$item['product_id']];
                $final_price = $product->price;

                OrderDetail::create([
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'discount' => $product->discount ?? 0,
                    'total_price' => $final_price * $item['quantity'],
                    'order_id' => $order->id,
                    'product_id' => $item['product_id'],
                ]);
            }

            foreach ($cart as $item) {
                $product = Product::find($item['product_id']);
                $product->decrement('quantity', $item['quantity']);
            }

            if ($request->payment_method === 'stripe') {
                return redirect()->route('pay.form', ['id' => $order->id]);
            }

            Cookie::queue(Cookie::forget('cart'));

            return redirect()->route('home')->with('success', 'Your order has been placed successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }

public function show(Order $order)
{
    $order->load('user.addresses.city');
    $orderDetails = $order->orderDetails;
    $paymentProof = PaymentProof::where('order_id', $order->id)->first();

    return view('dashboard.order.show', [
        'order' => $order,
        'orderDetails' => $orderDetails,
        'paymentProof' => $paymentProof,
    ]);
}




    public function edit(Order $order)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $order->order_status = $request->order_status;
        $order->save();

        return redirect()->route('order.index')->with('success', 'Order status updated successfully!');
    }

    public function destroy(Order $order)
    {
        $order->delete();

        return to_route('order.index')->with('success', 'Order deleted');
    }

  public function cancelOrder($id)
{
    $order = Order::findOrFail($id);

    // تحقق إذا الطلب مدفوع
    $payment = Payment::where('order_id', $order->id)->first();

    if ($payment) {
        // استدعاء ميثود الريفند مباشرة
        // $refundController = new RefundController();

        // إعداد طلب وهمي
        $fakeRequest = new \Illuminate\Http\Request([
            'payment_id' => $payment->payment_id,
            'amount' => $payment->amount,
            'order_id' => $order->id, // <<< أضف هذا
        ]);


        return $refundController->refund($fakeRequest);
    }

    // فقط لو حالة الطلب processing أو pending_payment
    if (in_array($order->order_status, ['processing', 'pending_payment'])) {
        $order->order_status = 'cancelled';
        $order->save();

        return redirect()->back()->with('success', 'Order has been cancelled successfully.');
    } else {
        return redirect()->back()->with('error', 'Cannot cancel the order. It is already being prepared or completed.');
    }
}




}
