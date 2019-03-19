@extends('layouts.app')
@section('content')
<h1>{{$title}} </h1>
<p>You can modify {{$title}} from here</p>
<ul class="list-group">
    @if(count($departments >  0))
        @foreach($departments as $department)
            <li class="list-group-item">
                <td>{{$department}}</td>
            </li>
        @endforeach
    @endif
</ul>
@endsection


