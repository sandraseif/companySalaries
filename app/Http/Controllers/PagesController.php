<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//The controller to render the views from the routing
class PagesController extends Controller
{   
    //redener the main index
    public function index(){   
        return view('pages.index');
    }

    //render the employees page
    public function employees(){
        $id             = 1;
        $name           = "No-one";
        $salary         = "1000";
        $dapartmentID   = 1;
        $dapartmentName = 'Sales';
        $employees      = ['Employee 1','Employee 2','Employee 3'];

        $data           =  array(   'title'     =>'Employees',
                                    'employess' => $employees); 
     
        return view('pages.employees')->with($data);
    }

    //redner the departments pages
    public function departments(){
        $id        = 1;
        $name      = "Sales";
        $bonus     = "10%";
        $departments = ['Sales','Technology','Advertising'];

        $data      =    array(  'title'     =>'Departments',
                                'departments' => $departments); 
        return view('pages.departments')->with($data);
    }
}
