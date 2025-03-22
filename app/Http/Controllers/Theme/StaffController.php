<?php

namespace App\Http\Controllers\Theme;

use App\Http\Controllers\Controller;
use App\Http\Requests\staffrequest;
use App\Http\Requests\staffupdaterequest;
use App\Models\Category;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $staffs = Staff::paginate(10);
        return view('Theme.Staff.staff', compact('staffs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Theme.Staff.staff_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(staffrequest $request)
    {
         $data=$request->validated();
       $insert=Staff::create($data);
       if($insert){
           return redirect()->route('Staff.index')->with('success','Staff Added Successfully');
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
    public function edit(Staff $staff)
    {
        return view('Theme.Staff.staff_edit',compact('staff'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
         $request->validate([
             'name' => 'required|string|max:255',
             'email' => 'required|email|unique:staffs,email,' . $staff->id,
             'salary' => 'required|numeric|min:0',
             'phone' => 'required|string|min:10',
             'role' => 'required|string',
         ]);
        $staff->update([
            'name'  => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'role'  => $request->input('role'),
            'salary'=>$request->input('salary'),
        ]);
        return redirect()->route('Staff.index')->with('success', 'Employee updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request,Staff $staff)
    {
        $delete=$staff->delete();
        if($delete){
            return redirect()->route('Staff.index')->with('success','Staff deleted successfully');
        }
    }
}
