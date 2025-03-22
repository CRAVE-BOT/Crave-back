<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;
use App\Models\TableReserve;
use Illuminate\Http\Request;

class Table_reserveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $table=TableReserve::paginate(10);
        return view('Theme.Table_reserve.table',compact('table'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, TableReserve $tablereserve)
    {

        $tablereserve->delete();
        return redirect()->back()->with('success', 'Reservation deleted successfully.');
    }

}
