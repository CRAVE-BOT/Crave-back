<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $table = Table::orderBy('number', 'asc')->paginate(10);
        return view('Theme.Table.table',compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
            return view('Theme.Table.table_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
           'number' => 'required|unique:tables',
           'number_chairs' => 'required',
       ]);
       $data = $request->all();
       $insert=Table::create($data);
       if($insert){
           return redirect()->route('Table.index')->with('success','Table created successfully');
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
    public function edit(Table $table)
    {
        return view('Theme.Table.table_edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Table $table)
    {
        $request->validate([
            'number' => 'required|integer|unique:tables,number,' . $table->id,
            'number_chairs' => 'required|integer',
        ]);
        $table->update([
            'number' => $request->input('number'),
            'number_chairs' => $request->input('number_chairs'),
        ]);

        return redirect()->route('Table.index')->with('success', 'Table updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Table $table)
    {
         $table->delete();
         return redirect()->route('Table.index')->with('success', 'Table deleted successfully');
    }
}
