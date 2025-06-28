<?php

namespace App\Http\Controllers;
use App\Models\SubCategory;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
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
        $userCount = User::count();

        $pendingPaymentCount = Order::where('order_status', 'pending_payment')->count();
        $processingCount = Order::where('order_status', 'processing')->count();
        $readyForPickupCount = Order::where('order_status', 'ready_for_pickup')->count();
        $shippedCount = Order::where('order_status', 'shipped')->count();
        $completedCount = Order::where('order_status', 'completed')->count();
        $cancelledCount = Order::where('order_status', 'cancelled')->count();


        // Define the end date as today
        $endDate = Carbon::today();
        // Define the start date as 7 days ago (including today)
        $startDate = $endDate->copy()->subDays(6);

        // Query orders for the past week (7 days)
        $ordersData = Order::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as orders_count, SUM(total_price) as revenue')
            ->groupBy('date')
            ->orderBy('date', 'asc') // Sort by date (ascending)
            ->get();

        // Generate a list of dates for the past 7 days (inclusive)
        $dates = [];
        $orders = [];
        $revenue = [];

        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $dates[] = $date->toDateString(); // e.g., "2024-12-23"
            // Default to 0 orders and 0 revenue for each date
            $orders[$date->toDateString()] = 0;
            $revenue[$date->toDateString()] = 0;
        }

        // Populate orders and revenue for the retrieved data
        foreach ($ordersData as $data) {
            $orders[$data->date] = $data->orders_count;
            $revenue[$data->date] = $data->revenue;
        }

        // Flatten the orders and revenue arrays to match the dates array
        $orders = array_values($orders);
        $revenue = array_values($revenue);


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
            'orders',
            'revenue'
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
