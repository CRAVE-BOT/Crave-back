<?php

namespace App\Http\Controllers\Api;

use App\helper\Apihelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Resources\OrderhistoryResource;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function store(OrderRequest $request){
       $data = $request->validated();
        $user = $request->user()->id;
        $order = Order::create([
            'user_id' => $user,
            'order_date' => now()->format('Y-m-d H:i:s'),
            'status'=>'pending',
            'total_price'=>$data['total_price'],
            'payment_method'=>$data['payment_method'],
        ]);
        $f=0;
        foreach ($data['products'] as $product){
            $f=1;
            OrderDetail::create([
                'order_id'=>$order->id,
                'product_id'=>$product['product_id'],
                'quantity'=>$product['product_quantity'],
                'unit_price'=>$product['product_unit_price'],
                'subtotal'=>$product['product_quantity']*$product['product_unit_price'],
            ]);
            $randomReduction = rand(200, 500);
            \DB::table('inventories')
                ->whereIn('id', [1, 2, 3, 4, 6, 8, 12, 14, 13, 17, 21, 25, 29, 34, 35, 37, 40, 42, 43, 45, 48, 51, 52])
                ->decrement('quantity_in_grams', $randomReduction);
        }

       if($f==1)return Apihelper::sendrespone('201','Order created successfully',null);
       else return Apihelper::sendrespone('200','Some times Wrong',null);

    }


    public function show(Request $request) {
        $user = $request->user()->id;

        $orders = Order::where('user_id', $user)->with('orderDetails')->latest()->get();

        if ($orders->isEmpty()) {
            return Apihelper::sendrespone(404, 'No orders found for this user', null);
        }

        return Apihelper::sendrespone(200, 'Order History Fetched successfully', OrderhistoryResource::collection($orders));
    }


}
