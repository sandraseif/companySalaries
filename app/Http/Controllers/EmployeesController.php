<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\Department;
use App\DepartmentsEmployees;
//getting the model here to interact with it and return it to the views
class EmployeesController extends Controller
{   

     //make sure the user is logged in
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
        $employees = Employee::orderBy('created_at','desc')->get();
        $employees = json_encode($employees);
        return view('employees.index')->with('employees',$employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    
    public function create()
    {
        //return the form for creating new employee

        //getting all the departments in proper array for the select
        $departments            = Department::orderBy('basesalary','desc')->get();
        $selectedDepartments    = [];
        if($departments){
            foreach($departments as $department) {
                 $selectedDepartments[$department->id] = $department->name;
            }
        }
        
        return view('employees.create')->with('departments',$selectedDepartments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

   
    public function store(Request $request)
    {
        //validating the inputs from the user
        $this->validate($request,[
            'name'              => 'required',
            'email'             => 'required',
            'salary'            => 'required',
            'bonuspercentage'   => 'required',
            'departmentID'      => 'required'   
        ]);
        
        //adding new eomplyee
        $employee  =   new Employee();

        //getting the inputs
        $employee->name             =  $request->input('name'); 
        $employee->email            =  $request->input('email'); 
        $employee->salary           =  $request->input('salary'); 
        $employee->bonuspercentage  =  $request->input('bonuspercentage'); 
        $employee->added_by_id      =  auth()->user()->id;
        if($employee->save()){
            $depemployee  =   new DepartmentsEmployees();

                //getting the inputs
            $depemployee->employeeID    =  $employee->id; 
            $depemployee->departmentID  =  $request->input('departmentID');
            if($depemployee ->save()){
                $message = 'Employee created.';
            }else{
                $message = "Error occured while adding the employee to department.";
            }
        }else{
            $message = "Error occured while adding the employee.";
        }
        
        return redirect(url('/').'/employees')->with('success',$message);
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
        $employee =  Employee::find($id);
        return view('employees.show')->with('employee',$employee);
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
        $employee               = Employee::find($id);
        $depemployee            = DepartmentsEmployees::where('employeeID', $employee->id)->first(); 
        $employee->departmentID = $depemployee->departmentID;
        $departments            = Department::orderBy('basesalary','desc')->get();
        $selectedDepartments    = [];
       
        if($departments){
            foreach($departments as $department) {      
                 $selectedDepartments[$department->id] = $department->name;
            }

        }
        $data['employee']    = $employee;
        $data['departments'] = $selectedDepartments;
        return view('employees.edit')->with('data',$data);
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
        //validating the inputs from the user
        $this->validate($request,[
            'name'              => 'required',
            'email'             => 'required',
            'salary'            => 'required',
            'bonuspercentage'   => 'required',
            'departmentID'      => 'required'   
        ]);
        
        //adding new eomplyee
        $employee  =  Employee::find($id);
        //getting the inputs
        $employee->name             =  $request->input('name'); 
        $employee->email            =  $request->input('email'); 
        $employee->salary           =  $request->input('salary'); 
        $employee->bonuspercentage  =  $request->input('bonuspercentage'); 
        
        if($employee->save()){
            $depemployee                = DepartmentsEmployees::where('employeeID', $employee->id)->first(); 
            //getting the inputs
            $depemployee->employeeID    =  $employee->id; 
            $depemployee->departmentID  =  $request->input('departmentID');
            if($depemployee ->save()){
                $message = 'Employee Updated.';
            }else{
                $message = "Error occured while updating the employee to department.";
            }
            }else{
                $message = "Error occured while updating the employee.";
            }
        
        return redirect(url('/').'/employees')->with('success',$message);       
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
        $employee   =   Employee::find($id);
        $employee->delete();

        $message    =   "Employee Deleted";

        return redirect(url('/').'/employees')->with('success',$message);
    }
}
