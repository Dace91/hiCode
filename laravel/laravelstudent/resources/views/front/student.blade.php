@extends('layouts.master')

@section('content')
@if(!empty($student))

<h2>{{$student->title}}</h2>
{{$student->name}}
{{$student->bio}}
@endif
@stop

@section('footer')
    @parent
    mentions légales
@stop