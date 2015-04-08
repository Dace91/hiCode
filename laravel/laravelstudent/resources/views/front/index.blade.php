@extends('layouts.master')

@section('content')
@if(count($posts)>0)
@foreach($posts as $post)
<h2><a href="{{url('single/'.$post->id)}}">{{$post->title}}</a></h2>
<br><samll>{{$post->created_at->format('d/m/Y h:i:s')}}</samll>
    @if(count($post->tags)>0)
        <nav>mots clefs:
        @foreach($post->tags as $tag)
            <a href="{{url('tag/'.$tag->id)}}">{{$tag->name}}</a>
        @endforeach
        </nav>
    @endif
@endforeach
@else
    <p>désolé pas d'article pour l'instant</p>
    @endif
@stop

@section('footer')
    @parent
    mentions légales
@stop