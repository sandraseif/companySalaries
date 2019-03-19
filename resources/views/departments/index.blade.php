@extends('layouts.app')
@section('content')
<h1>Departments</h1>
<p>You can modify Departments from here</p>
<a class="btn btn-primary" href="{{ url('/') }}/departments/create">Create</a>
    @if(count($departments >  0))
        @foreach(json_decode($departments) as $department)
            <div class="well">
                <h3><a href="departments/{{$department->id}}">{{$department->name}}</a><h3>  
                    <a href="departments/{{$department->id}}/edit" class="btn btn-primary left">Edit</a> 
                    {{Form::open(['action'  =>  
                                    ['DepartmentsController@destroy',
                                     $department->id
                                    ],  
                                'method'    =>  'POST',
                                'class'    =>  'pull-right'   ])}}
                    {{Form::submit('Delete',['class'=>'btn btn-danger'])}}
                    {{Form::hidden('_method','DELETE')}}
                    {{Form::close()}}             
            </div> 
        @endforeach
        
    @else
        <p>No Departments Found</p>    
    @endif
@endsection


