<?php

namespace App\Http\Controllers\API;

use App\helper\Apihelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TableRequest;
use App\Models\Table;
use App\Models\TableReserve;
use Illuminate\Http\Request;

class TablereserveController extends Controller
{
    public function store(TableRequest $request){
        $data = $request->validated();
        $table_id=$data['number'];
        $table_id=Table::where('number',$table_id)->first()->id;
        $table['table_id']=$table_id;
        $table['user_id']=$request->user()->id;
        $table['date']=$data['date'];
        $table['the_time']=$data['time'];
        $table['number_people']=$data['number_people'];
        $insert=TableReserve::create($table);
        if($insert){
            return Apihelper::sendrespone('201','Booking Table Successfully Created',null);
        }
    }
     public function last_reserve(Request $request){
            $userId = $request->user()->id;
            $last=TableReserve::where('user_id', $userId)->latest()->first();
            return Apihelper::sendrespone('200','The last table reserve of user here ',new TableReserveResource($last));

        }
}
