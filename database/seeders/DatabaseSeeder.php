<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Favourite;
use App\Models\Inventory;
use App\Models\Messages;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Table;
use App\Models\TableReserve;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
//        User::factory(10)->create();
//    Messages::factory(20)->create();
//        Table::factory(8)->create();
//        TableReserve::factory(20)->create();
//        Inventory::factory(56)->create();

        // إنشاء طلبات وهمية مع تفاصيلها
//        Order::factory(40)->create()->each(function ($order) {
//            $orderDetails = OrderDetail::factory(rand(1, 5))->create([
//                'order_id' => $order->id
//            ]);
//
//            // تحديث total_price للطلب
//            $totalPrice = $orderDetails->sum('subtotal');
//            $order->update(['total_price' => $totalPrice]);
//
//        });
//        DB::table('chatbot_responses')->insert([
//            ['question' => 'إجمالي الطلبات اليوم؟', 'response' => 'عدد الطلبات اليوم هو: '],
//            ['question' => 'إجمالي الإيرادات؟', 'response' => 'إجمالي الإيرادات اليوم: '],
//            ['question' => 'أكتر وجبة مبيعًا؟', 'response' => 'الوجبة الأكثر مبيعًا اليوم هي: ']
//        ]);
//        Favourite::factory(10)->create();
    }

}
