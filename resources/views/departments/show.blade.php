@extends('layouts.app')
@section('content')
<a href="{{ url('/') }}/departments" class="btn btn-default">Back</a>
<h1>{{$department->name}}</h1>
    <div class="well">
        <h3><a href="departments/{{$department->id}}">{{$department->name}}</a><h3>
            <div>  
                <small>Base Salary : {{$department->basesalary}}</small>
                </br>
                <small>Bonus percentage : {{$department->bonuspercentage}}</small>
            </div>
        </div> 
@endsection


