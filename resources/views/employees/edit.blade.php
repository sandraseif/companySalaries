@extends('layouts.app')
@section('content')
<h1>Edit : {{$data['employee']->name}}</h1>
{{ Form::open(array('action' => ['EmployeesController@update',$data['employee']->id],'method'=>'POST')) }}
    <div class="form-group">
        {{Form::label('name','Name')}}
        {{Form::text('name',$data['employee']->name,['class'=>'form-control','placeholder'=>'Employee Name'])}}

        {{Form::label('email','Email')}}
        {{Form::email('email',$data['employee']->email,['class'=>'form-control','placeholder'=>'Employee Email'])}}

        {{Form::label('salary','Salary')}}
        {{Form::number('salary',$data['employee']->salary,['class'=>'form-control','placeholder'=>'Employee Salary'])}}

        {{Form::label('bonuspercentage','Bonus percentage')}}
        {{Form::number('bonuspercentage',$data['employee']->bonuspercentage,['class'=>'form-control'])}}

        {{Form::label('departmentID','Department')}}
        {{Form::select('departmentID', $data['departments'],$data['employee']->departmentID,['class'=>'form-control'])}}
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Update',['class'=>'btn-primary'])}}
    </div>
{{ Form::close() }}
@endsection


