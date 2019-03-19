@extends('layouts.app')

@section('content')
<h1>{{$title}}</h1>
<p>You can modify {{$title}} from here</p>
<ul class="list-group">
    @if(count($employess >  0))
        @foreach($employess as $employee)
            <li class="list-group-item">
                <td>{{$employee}}</td>
            </li>
        @endforeach
    @endif
</ul>
@endsection


