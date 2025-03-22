<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;
use App\Http\Requests\Inventoryequest;
use App\Http\Requests\Inventoryrequest;
use App\Models\Inventory;
use Illuminate\Http\Request;

class InvetoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventory=Inventory::paginate(10);
        return view('Theme.Invetory.invetory',compact('inventory'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Theme.Invetory.item_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Inventoryrequest $request)
    {
         $data=$request->validated();
         $inventory=Inventory::create($data);
         if($inventory){
             return redirect()->route('Inventory.index')->with('success','Item created successfully');
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
    public function edit(Inventory $inventory)
    {
        return view('Theme.Invetory.item_edit',compact('inventory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'name' => 'required|string|unique:inventories,name,'.$inventory->id,
            'Current_price' => 'required|numeric|min:10',
            'quantity' => 'required|integer|min:1',
            'Previous_price' => 'required|numeric|min:10',
        ]);
        $inventory->update([
            'name'=>$request->input('name'),
            'Current_price'=>$request->input('Current_price'),
            'quantity'=>$request->input('quantity'),
             'Previous_price'=>$request->input('Previous_price'),
        ]);
        return redirect()->route('Inventory.index')->with('success','Item updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
          $inventory->delete();
          return redirect()->route('Inventory.index')->with('success','Item deleted successfully');
    }
}
