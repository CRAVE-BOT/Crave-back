<?php

namespace App\Http\Controllers\API;

use App\helper\Apihelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::get();
        return Apihelper::sendrespone(200,'categories is received Successful',CategoryResource::collection($categories));
    }

}
