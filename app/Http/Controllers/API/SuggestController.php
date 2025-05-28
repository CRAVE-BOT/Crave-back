<?php

namespace App\Http\Controllers\API;

use App\helper\Apihelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\Suggestresource;
use App\Models\Sugest;
use Illuminate\Http\Request;

class SuggestController extends Controller
{
    public function show(request $request){
       $id=$request->user()->id;
       $data=Sugest::where("user_id",$id)->get();
          return Apihelper::sendrespone('200','your meals here',SuggestResource::collection($data));
    }
}
