<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AnalyticsController extends Controller
{
    public function getChartData(Request $request)
    {
        $filter = $request->query('filter', 'today');
        $dates = [];
        $salesData = [];
        $revenueData = [];
        $customersData = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->format('Y-m-d');
            $dates[] = $date;

            $salesData[] = Order::whereDate('order_date', $date)->count();
            $revenueData[] = Order::whereDate('order_date', $date)->sum('total_price');
            $customersData[] = User::whereDate('created_at', $date)->count();
        }

        return response()->json([
            'dates' => $dates,
            'sales' => $salesData,
            'revenue' => $revenueData,
            'customers' => $customersData,
        ]);
    }

    public function getDashboardStats(Request $request)
    {
        $filter = $request->query('filter', 'today');


        if ($filter == 'today') {
            $startDate = Carbon::today();
        } elseif ($filter == 'month') {
            $startDate = Carbon::now()->startOfMonth();
        } elseif ($filter == 'year') {
            $startDate = Carbon::now()->startOfYear();
        } else {
            return response()->json(['error' => 'Invalid filter'], 400);
        }

        $salesCount = Order::whereDate('order_date', '>=', $startDate)->count();
        $totalRevenue = Order::whereDate('order_date', '>=', $startDate)->sum('total_price');
        $customersCount = User::whereDate('created_at', '>=', $startDate)->count();

        return response()->json([
            'sales' => $salesCount,
            'revenue' => $totalRevenue,
            'customers' => $customersCount,
        ]);
    }
}
