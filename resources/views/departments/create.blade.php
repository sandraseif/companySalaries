@extends('layouts.app')
@section('content')
<h1>Create New Department</h1>
{{ Form::open(array('action' => 'DepartmentsController@store','method'=>'pots')) }}
    <div class="form-group">
        {{Form::label('name','Name')}}
        {{Form::text('name','',['class'=>'form-control','placeholder'=>'Department Name'])}}


        {{Form::label('basesalary','Base Salary')}}
        {{Form::number('basesalary','',['class'=>'form-control','placeholder'=>'Department Salary'])}}

        {{Form::label('bonuspercentage','Bonus percentage')}}
        {{Form::number('bonuspercentage','',['class'=>'form-control'])}}


        {{Form::submit('Add',['class'=>'btn-primary'])}}
    </div>
{{ Form::close() }}
@endsection


