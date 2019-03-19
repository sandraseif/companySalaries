@extends('layouts.app')
@section('content')
<h1>Edit : {{$department->name}}</h1>
{{ Form::open(array('action' => ['DepartmentsController@update',$department->id],'method'=>'POST')) }}
    <div class="form-group">
        {{Form::label('name','Name')}}
        {{Form::text('name',$department->name,['class'=>'form-control','placeholder'=>'Department Name'])}}

        {{Form::label('basesalary','Base Salary')}}
        {{Form::number('basesalary',$department->basesalary,['class'=>'form-control','placeholder'=>'Employee Salary'])}}

        {{Form::label('bonuspercentage','Bonus percentage')}}
        {{Form::number('bonuspercentage',$department->bonuspercentage,['class'=>'form-control'])}}

        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Update',['class'=>'btn-primary'])}}
    </div>
{{ Form::close() }}
@endsection


