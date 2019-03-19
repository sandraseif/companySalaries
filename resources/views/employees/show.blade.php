@extends('layouts.app')
@section('content')
<a href="{{ url('/') }}/employees" class="btn btn-default">Back</a>
<h1>{{$employee->name}}</h1>
    <div class="well">
        <h3><a href="employees/{{$employee->id}}">{{$employee->name}}</a><h3>
            <div>  
                <small>Email : {{$employee->email}}</small>
                </br>
                <small>Salary : {{$employee->salary}}</small>
                 </br>
                <small>Salary : @if($employee->bonuspercentage !=0){{$employee->bonuspercentage}} @else 'The base bonus' @endif</small>
            </div>
        </div> 
@endsection


