<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $ALlOrderCount = Order::count();
    $productCount = Product::count();
    $userCount = User::where('id', '!=', auth()->id())->count();

    $pendingPaymentCount = Order::where('order_status', 'pending_payment')->count();
    $processingCount = Order::where('order_status', 'processing')->count();
    $readyForPickupCount = Order::where('order_status', 'ready_for_pickup')->count();
    $shippedCount = Order::where('order_status', 'shipped')->count();
    $completedCount = Order::where('order_status', 'completed')->count();
    $cancelledCount = Order::where('order_status', 'cancelled')->count();

    // 1. تحديد نطاق التواريخ بشكل صحيح (آخر 7 أيام)
    $endDate = Carbon::today()->endOfDay();
    $startDate = Carbon::today()->subDays(6)->startOfDay();

    // 2. تعديل الاستعلام ليحسب عدد كل نوع من الطلبات
    $ordersData = Order::whereBetween('created_at', [$startDate, $endDate])
        ->selectRaw("
            DATE(created_at) as date,
            COUNT(CASE WHEN order_status = 'completed' THEN 1 END) as completed_count,
            COUNT(CASE WHEN order_status = 'processing' THEN 1 END) as processing_count
        ")
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

    // 3. تجهيز مصفوفات منفصلة لكل نوع من البيانات
    $dates = [];
    $completedOrders = [];
    $processingOrders = [];

    for ($date = $startDate->copy(); $date->lte($endDate); $date->addDay()) {
        $dateString = $date->toDateString();
        $dates[] = $dateString;
        // وضع قيمة ابتدائية (صفر) لكل يوم
        $completedOrders[$dateString] = 0;
        $processingOrders[$dateString] = 0;
    }

    // 4. تعبئة المصفوفات بالبيانات الحقيقية من الاستعلام
    foreach ($ordersData as $data) {
        $completedOrders[$data->date] = $data->completed_count;
        $processingOrders[$data->date] = $data->processing_count;
    }

    // 5. تحويل المصفوفات لتكون جاهزة للشارت
    $completedOrders = array_values($completedOrders);
    $processingOrders = array_values($processingOrders);


    // 6. إرسال المتغيرات الجديدة إلى الـ view
    return view('dashboard.chart.chart', compact(
        'productCount',
        'userCount',
        'ALlOrderCount',
        'pendingPaymentCount',
        'processingCount',
        'readyForPickupCount',
        'shippedCount',
        'completedCount',
        'cancelledCount',
        'dates',
        'completedOrders',  // متغير جديد
        'processingOrders'  // متغير جديد
    ));
}
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
