@extends('layouts.app')
@section('content')
<h1>Create New Employee</h1>
{{ Form::open(array('action' => 'EmployeesController@store','method'=>'POST')) }}
    <div class="form-group">
        {{Form::label('name','Name')}}
        {{Form::text('name','',['class'=>'form-control','placeholder'=>'Employee Name'])}}

        {{Form::label('email','Email')}}
        {{Form::email('email','',['class'=>'form-control','placeholder'=>'Employee Email'])}}

        {{Form::label('salary','Salary')}}
        {{Form::number('salary','',['class'=>'form-control','placeholder'=>'Employee Salary'])}}

        {{Form::label('bonuspercentage','Bonus percentage')}}
        {{Form::number('bonuspercentage','',['class'=>'form-control'])}}

        {{Form::label('departmentID','Department')}}
        {{Form::select('departmentID', $departments,['class'=>'form-control'])}}

        {{Form::submit('Create',['class'=>'btn-primary'])}}
    </div>
{{ Form::close() }}
@endsection


