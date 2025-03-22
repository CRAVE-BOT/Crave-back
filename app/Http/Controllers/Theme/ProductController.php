<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;
use App\Http\Requests\productrequest;
use App\Http\Requests\productupdaterequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Product::orderByRaw("CASE WHEN category_id = 2 THEN 0 ELSE 1 END")
            ->orderBy('id', 'asc')
            ->paginate(5);

        return view('Theme.Products.product', compact('data'));


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $category = Category::paginate(10);
        return view('Theme.Products.product_create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(productrequest $request)
    {
        $data = $request->validated();
        $image = $request->file('image');
        $newImageName = time() . '-' . $image->getClientOriginalName();
        $image->storeAs('Product_image', $newImageName, 'public');
        $data['image'] = $newImageName;
        $insert=Product::create($data);
        if($insert){
            return redirect()->route('Product.index')->with('success', 'Product Added Successfully');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        $id = $request->input('product_id');
        $product = Product::where('id',$id)->find($id);
        $category = Category::get();
        return view('Theme.Products.product_edit', compact('product','category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(request $request)
    {
        $id = $request->input('product_id');
       if($request->hasFile('image')){
           $image = $request->file('image');
           $newImageName = time() . '-' . $image->getClientOriginalName();
           $image->storeAs('Product_image', $newImageName, 'public');
           $data['image'] = $newImageName;
           $data = DB::table('products')->where('id', $id)->update([
               'image' => $data['image'],
           ]);
       }
       $data = DB::table('products')->where('id', $id)->update([
           'name' => $request->input('name'),
           'price' => $request->input('price'),
           'description' => $request->input('description'),
           'category_id' => $request->input('category_id'),
           'total_calories'=>$request->input('total_calories'),
           'protien'=>$request->input('protien'),
           'carb'=>$request->input('carb'),
           'fat'=>$request->input('fat'),
           'weight'=>$request->input('weight'),
       ]);
       return redirect()->route('Product.index')->with('success', 'Product Updated Successfully');




    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);
        $id = $request->input('product_id');
        $data = Product::where('id', $id)->delete();
            return redirect()->route('Product.index')->with('success', 'Product deleted successfully');
    }
}
