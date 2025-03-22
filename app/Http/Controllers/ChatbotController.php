<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatbotResponse;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ChatbotController extends Controller
{
    public function handleMessage(Request $request)
    {
        $question = trim($request->input('message'));

        // ✅ البحث عن الرد في قاعدة البيانات
        $response = ChatbotResponse::where('question', $question)->first();

        if (!$response) {
            return response()->json(['response' => 'عذرًا، لا أفهم هذا السؤال 😕']);
        }

        // ✅ التأكد من استدعاء الدالة الصحيحة
        if ($response->is_dynamic && method_exists($this, $response->action)) {
            return response()->json(['response' => $this->{$response->action}()]);
        }

        return response()->json(['response' => $response->response]);
    }

    /**
     * ✅ استرجاع قائمة الأسئلة من قاعدة البيانات
     */
    public function getQuestions()
    {
        $questions = ChatbotResponse::pluck('question'); // جلب جميع الأسئلة من الجدول
        return response()->json($questions);
    }

    /**
     * ✅ الحصول على إجمالي الإيرادات اليوم
     */
    private function getTodayTotalSales()
    {
        $totalSales = Order::whereDate('order_date', now())->sum('total_price');
        return "إجمالي الإيرادات اليوم هو {$totalSales} جنيه 💰";
    }

    /**
     * ✅ الحصول على أكثر وجبة مبيعًا اليوم
     */
    private function getMostOrderedMealToday()
    {
        $meal = DB::table('order_details')
            ->select('product_id', DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->first();

        if (!$meal) {
            return 'لا توجد بيانات كافية.';
        }

        $product = Product::find($meal->product_id);
        return $product ? "🍽️ أكثر وجبة مبيعًا اليوم هي {$product->name}" : "وجبة غير معروفة.";
    }


    /**
     * ✅ الحصول على عدد الطلبات اليوم
     */
    private function getTodayOrdersCount()
    {
        $ordersCount = Order::whereDate('order_date', now())->count();
        return "عدد الطلبات اليوم هو {$ordersCount} طلبات 🛒";
    }


    private function getPeakHoursToday()
    {
        // ✅ جلب جميع الطلبات لليوم الحالي مجمعة حسب الساعة
        $peakHours = \DB::table('orders')
            ->select(\DB::raw('HOUR(order_date) as hour'), \DB::raw('COUNT(*) as total_orders'))
            ->whereDate('order_date', now()) // ✅ الطلبات لليوم الحالي فقط
            ->groupBy('hour')
            ->orderByDesc('total_orders') // ✅ ترتيب حسب أكثر الساعات ازدحامًا
            ->limit(2) // ✅ جلب أكثر ساعتين ازدحامًا
            ->pluck('hour')
            ->toArray();

        if (empty($peakHours)) {
            return "لا توجد بيانات كافية عن أوقات الذروة اليوم 😕";
        }

        // ✅ تحويل الأرقام إلى تنسيق 12 ساعة (AM/PM)
        $formattedHours = array_map(function ($hour) {
            return date("g A", strtotime("$hour:00:00"));
        }, $peakHours);

        return "🔥 أوقات الذروة اليوم هي من " . implode(" إلى ", $formattedHours);
    }
    private function getMonthlySales()
    {
        // ✅ حساب إجمالي المبيعات لهذا الشهر فقط
        $totalSales = \App\Models\Order::whereYear('order_date', now()->year)
            ->whereMonth('order_date', now()->month)
            ->sum('total_price');

        // ✅ التحقق إذا كانت هناك مبيعات أو لا
        if ($totalSales == 0) {
            return "لا توجد مبيعات حتى الآن في هذا الشهر 😕";
        }

        return "إجمالي مبيعات هذا الشهر حتى الآن: " . number_format($totalSales, 2) . " جنيه 💰";
    }
    private function getYearlySales()
    {
        // ✅ حساب إجمالي المبيعات للسنة الحالية فقط
        $totalSales = \App\Models\Order::whereYear('order_date', now()->year)
            ->sum('total_price');

        // ✅ التحقق إذا كانت هناك مبيعات أو لا
        if ($totalSales == 0) {
            return "لا توجد مبيعات حتى الآن في هذه السنة 😕";
        }

        return "إجمالي مبيعات هذه السنة حتى الآن: " . number_format($totalSales, 2) . " جنيه 💰";
    }
    private function getMostOrderedMealThisMonth()
    {
        $meal = \DB::table('order_details')
            ->select('product_id', \DB::raw('SUM(quantity) as total_quantity'))
            ->whereMonth('created_at', now()->month)
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->first();

        if (!$meal) return 'لا توجد بيانات كافية لهذا الشهر.';

        $product = \App\Models\Product::find($meal->product_id);

        return $product ? $product->name : 'منتج غير معروف';
    }
    private function getMostReservedTableThisMonth()
    {
        $table = DB::table('table_reserves')
            ->join('tables', 'table_reserves.table_id', '=', 'tables.id') // ✅ الربط بين الجدولين
            ->select('tables.number as table_number', DB::raw('COUNT(table_reserves.table_id) as total_reservations'))
            ->whereMonth('table_reserves.date', now()->month) // ✅ الشهر الحالي
            ->whereYear('table_reserves.date', now()->year)   // ✅ السنة الحالية
            ->groupBy('tables.number')
            ->orderByDesc('total_reservations')
            ->first();

        if (!$table) return '❌ لا توجد بيانات كافية لهذا الشهر.';

        return "📌 أكثر طاولة تم حجزها هذا الشهر هي **رقم {$table->table_number}** بـ **{$table->total_reservations}** حجوزات.";
    }


    private function getTotalCustomers()
    {
        return \App\Models\User::count() . ' عميل نشط';
    }
    private function getNewCustomersThisMonth()
    {
        return \App\Models\User::whereMonth('created_at', now()->month)->count() . ' عملاء جدد';
    }


}
