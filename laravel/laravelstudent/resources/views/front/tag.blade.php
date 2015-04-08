@extends('layouts.master')

@section('content')
@if(count($posts)>0)
    <h2>Posts/mot clef</h2>
@foreach($posts as $post)
<h2><a href="{{url('single/'.$post->id)}}">{{$post->title}}</a></h2>
<br><samll>{{$post->created_at->format('d/m/Y h:i:s')}}</samll>
@endforeach
@else
    <p>désolé pas d'article pour l'instant</p>
@endif
@stop

@section('footer')
    @parent
    mentions légales
@stop