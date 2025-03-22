<?php

namespace App\Http\Controllers\API;

use App\helper\Apihelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\favouriterequest;
use App\Http\Resources\Favouriteresourse;
use App\Models\Favourite;
use App\Models\Product;
use Illuminate\Http\Request;

class FavouriteController extends Controller
{
    public function show(Request $request){
        $user_id = $request->user()->id;
        $favourites = Favourite::where('user_id',$user_id)->with('product')->get();
        return Apihelper::sendrespone('200','Favourite done',Favouriteresourse::collection($favourites));
    }


    public function store(favouriterequest $request){
       $request->validated();
        $user_id = $request->user()->id;
        $product=$request->product_name;
       $create['product_id'] = Product::where('name',$product)->first()->id;
       $create['user_id'] = $user_id;
       $insert=Favourite::create($create);
       if($insert){
           return Apihelper::sendrespone('201','Favourite added successfully',null);
       }
       return Apihelper::sendrespone('400','Something went wrong',null);
    }


    public function delete(favouriterequest $request){
        $request->validated();
        $product=$request->product_name;
        $id = Product::where('name',$product)->first()->id;
        $delete=Favourite::where('product_id',$id)->delete();
        if($delete){
            return Apihelper::sendrespone('200','Favourite deleted successfully',null);
        }
        return Apihelper::sendrespone('400','Something went wrong',null);
    }

}
