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
use Illuminate\Support\Facades\Mail;
use App\Mail\UserOrderStatusUpdated;
use App\Mail\AdminOrderStatusUpdated;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::orderBy('created_at', 'desc')->get();

        return view('dashboard.order.index', ['orders' => $orders]);
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

    // حفظ الحالة الجديدة
    $oldStatus = $order->order_status;
    $order->order_status = $request->order_status;
    $order->save();

    // تحميل التفاصيل المرتبطة بالطلب
    $order->load('user', 'orderDetails.product');

    // إرسال إيميل للزبون
    if (!empty($order->user->email)) {
        Mail::to($order->user->email)->send(new UserOrderStatusUpdated($order, $oldStatus));
    }

    // إرسال إيميل للأدمن
    $adminEmails = [
        'yasmeen.abuzaid@a-tech.dev',
        'yaseenrasha4@gmail.com'
    ];
    foreach ($adminEmails as $email) {
        Mail::to($email)->send(new AdminOrderStatusUpdated($order, $oldStatus));
    }

    return redirect()->route('order.index')->with('success', 'Order status updated successfully!');
}




}
