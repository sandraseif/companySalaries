<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class DepartmentsController extends Controller
{   //make sure the user is logged in
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $departments = Department::all();
        $departments = json_encode($departments);
        return view('departments.index')->with('departments',$departments);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //  
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
               //validating the inputs from the user
        $this->validate($request,[
            'name'              => 'required',
            'basesalary'        => 'required',
            'bonuspercentage'   => 'required'  
        ]);
        
        //adding new eomplyee
        $department  =   new Department();

        //getting the inputs
        $department->name             =  $request->input('name'); 
        $department->basesalary           =  $request->input('basesalary'); 
        $department->bonuspercentage  =  $request->input('bonuspercentage'); 
        $department->added_by_id      =  auth()->user()->id;
        if($department->save()){
            $message = 'Department created.';   
        }else{
            $message = "Error occured while adding the department.";
        }
        
        return redirect(url('/').'/departments')->with('success',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $department =  Department::find($id);
        return view('departments.show')->with('department',$department);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $department             = Department::find($id);
        return view('departments.edit')->with('department',$department);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
               //
        //validating the inputs from the user
        $this->validate($request,[
            'name'              => 'required',
            'basesalary'        => 'required',
            'bonuspercentage'   => 'required',
        ]);
        
        //adding new eomplyee
        $department  =  Department::find($id);
        //getting the inputs
        $department->name             =  $request->input('name'); 
        $department->basesalary       =  $request->input('basesalary'); 
        $department->bonuspercentage    =  $request->input('bonuspercentage'); 
        
        if($department->save()){
                $message = "Department Updated.";      
        }else{
                $message = "Error occured while updating the department.";
            }
        
        return redirect(url('/').'/departments')->with('success',$message);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $department   =   Department::find($id);
        $department->delete();

        $message    =   "Department Deleted";

        return redirect(url('/').'/departments')->with('success',$message);
    }
}
