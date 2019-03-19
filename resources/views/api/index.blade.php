@extends('layouts.app')
@section('content')
<h1>Consume the API</h1>
{{ Form::open() }}
    <div class="form-group">

        {{Form::label('departmentID','Department')}}
        {{Form::select('departmentID', ['01','02'],['class'=>'form-control'])}}
        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Consume',['class'=>'btn-primary'])}}
    </div>
{{ Form::close() }}
@endsection


