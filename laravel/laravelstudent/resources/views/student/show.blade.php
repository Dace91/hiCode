@extends('layouts.admin')

@section('nav')
    @parent
    <nav><a href="{{url('student')}}">retour crud student</a></nav>
@stop

@section('content')
    @if(isset($student))
        <h1>{{$student->firstname}}</h1>
        <p>{{$student->name}}</p>
    @endif
@stop