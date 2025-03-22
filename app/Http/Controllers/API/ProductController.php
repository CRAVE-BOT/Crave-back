<?php

namespace App\Http\Controllers\API;

use App\helper\Apihelper;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function getProductsByCategory($categoryName)
    {
        $category = Category::where('name', $categoryName)->first();

        if (!$category) {
            return Apihelper::sendrespone('200','Category not found',null);
        }

        $products = Product::where('category_id', $category->id)->get();

        return Apihelper::sendrespone('200','Products is recevied successfully',ProductResource::collection($products));
    }
    public function get3ProductsByCategory($categoryName)
    {

        $category = Category::where('name', $categoryName)->first();

        if (!$category) {
            return Apihelper::sendrespone('200','Category not found',null);
        }

        $products = Product::where('category_id', $category->id)->limit(3)->get();

        return Apihelper::sendrespone('200','Products is recevied successfully',ProductResource::collection($products));
    }
}
