<?php

namespace App\Http\Controllers\API;

use App\helper\Apihelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\calroiesrequest;
use App\Models\Calories;
use App\Models\Order;
use App\Models\Product;
use App\Models\Sugest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CalroiesController extends Controller
{
    public function store(calroiesrequest $request){
     $data=$request->validated();
     $data['user_id']=$request->user()->id;
        if($request['gender'] == 'male') {
            $BMR = ($request['weight'] * 10) + ($request['tall'] * 6.25) - ($request['age'] * 5) + 5;
        } else {
            $BMR = ($request['weight'] * 10) + ($request['tall'] * 6.25) - ($request['age'] * 5) - 161;
        }

        if($request['activity'] == 'Very active') {
            $BMR *= 1.9;
        } elseif($request['activity'] == 'Less active') {
            $BMR *= 1.2;
        } elseif($request['activity'] == 'Moderate active') {
            $BMR *= 1.55;
        }

        if($request['goal']=='Gain weight'||$request['goal']=='Maintain weight')$BMR+=500;
        else $BMR-=500;
       $data['total_calories']=$BMR;
       $insert=Calories::create($data);
        if ($BMR < 1500) {
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '7',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '18',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '23',
            ]);
        }
        elseif ($BMR > 1500 && $BMR < 2000) {
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '6',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '12',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '28',
            ]);
        }
        elseif ($BMR > 2000 && $BMR < 2500) {
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '10',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '13',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '24',
            ]);
        }
        elseif ($BMR > 2500 && $BMR < 3000) {
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '11',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '16',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '26',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '32',
            ]);
        }
        elseif ($BMR > 3000 && $BMR < 3500) {
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '10',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '21',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '22',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '31',
            ]);
        }
        elseif ($BMR > 3500 && $BMR < 4000) {
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '11',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '16',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '24',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '31',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '18',
            ]);
        }
        else{
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '10',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '21',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '22',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '31',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '28',
            ]);
            Sugest::create([
                'user_id' => $data['user_id'],
                'product_id' => '29',
            ]);
        }

       if($insert){
           return Apihelper::sendrespone('201','Calories Created Successfully',round($BMR));
       }
       return Apihelper::sendrespone('400','Bad Request',null);


    }

    public function show(Request $request)
    {
        $id=$request->user()->id;
        $total=Calories::where('user_id',$id)->sum('total_calories');
        return Apihelper::sendrespone('200',
            'Calories Calculated Successfully',
            [
                'total_calories' => $total,
                'Protein' => round(($total * 0.3) / 4, 2),
                'Carb' => round(($total * 0.4) / 4, 2),
                'Fat' => round(($total * 0.3) / 9, 2),
            ]);
    }

    
    public function showTodayCalories(Request $request)
    {
        $userId = $request->user()->id;

        $todayOrderIds = Order::where('user_id', $userId)
            ->whereDate('order_date', now()->toDateString())
            ->pluck('id');
        $totalCalories = DB::table('order_details')
            ->join('products', 'order_details.product_id', '=', 'products.id')
            ->whereIn('order_details.order_id', $todayOrderIds)
            ->sum(DB::raw('order_details.quantity * products.total_calories'));

        return Apihelper::sendrespone(
            200,
            'Total Calories for Today',
            ['total_calories' => $totalCalories]
        );
    }

}
