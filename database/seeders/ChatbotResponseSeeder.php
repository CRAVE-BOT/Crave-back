<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChatbotResponse;

class ChatbotResponseSeeder extends Seeder
{
    public function run()
    {
        ChatbotResponse::insert([
            [
                'question' => 'إجمالي إيرادات اليوم؟',
                'response' => 'إجمالي إيرادات اليوم هو:',
                'is_dynamic' => true,
                'action' => 'getTodayTotalSales'
            ],
            [
                'question' => 'ما هي الوجبة الأكثر مبيعاً؟',
                'response' => 'الوجبة الأكثر مبيعاً اليوم هي:',
                'is_dynamic' => true,
                'action' => 'getMostOrderedMealToday'
            ],
            [
                'question' => 'ما هي أوقات الذروة اليوم؟',
                'response' => 'أوقات الذروة اليوم هي:',
                'is_dynamic' => true,
                'action' => 'getMostOrderedMealToday'
            ],
            [
                'question' => 'أهلاً',
                'response' => 'أهلاً بك في Crave، كيف يمكنني مساعدتك؟',
                'is_dynamic' => false,
                'action' => null
            ]
        ]);

    }
}
