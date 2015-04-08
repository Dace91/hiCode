@extends('layouts.master')

@section('content')
@if(!empty($post))

<h2>{{$post->title}}</h2>
<br><samll>{{$post->created_at->format('d/m/Y h:i:s')}}</samll>
{{$post->content}}
@endif
@stop

@section('footer')
    @parent
    mentions légales
@stop