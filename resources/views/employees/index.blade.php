@extends('layouts.app')
@section('content')
<h1>Employees</h1>
<p>You can modify Employees from here</p>
<a class="btn btn-primary" href="{{ url('/') }}/employees/create">Create</a>
    @if(count($employees >  0))
        @foreach(json_decode($employees) as $employee)
            <div class="well">
                <h3><a href="employees/{{$employee->id}}">{{$employee->name}}</a><h3>  
                    <a href="employees/{{$employee->id}}/edit" class="btn btn-primary left">Edit</a> 
                    {{Form::open(['action'  =>  
                                    ['EmployeesController@destroy',
                                     $employee->id
                                    ],  
                                'method'    =>  'POST',
                                'class'    =>  'pull-right'   ])}}
                    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                    {{Form::hidden('_method','DELETE')}}
                    {{Form::close()}}           
            </div> 
        @endforeach
        
    @else
        <p>No Employees Found</p>    
    @endif
@endsection


