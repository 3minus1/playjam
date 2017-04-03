@extends('master')
@section('title',"Tag: " . $tag->tag_name)

@section('content')

<h3>Tag: {{$tag->tag_name}} </h3>
<i>The following playlists are associated with this tag name:</i>
<hr/>

@foreach($playlists as $playlist)
<a href="{{action('PlaylistController@show',$playlist->id)}}">{{$playlist->name}}</a><br/>
@endforeach

@endsection