@extends('master')
@section('title',"Tag: " . $tag->tag_name)

@section('content')

<div class="page-header row">
    <div class="col s12 m12 l12">
       <h3>Tag: {{$tag->tag_name}} </h3>
    </div>
</div>
<i>The following playlists are associated with this tag name:</i>
<hr/>


<div class="collection tag-collection">
@foreach($playlists as $playlist)
<a href="{{action('PlaylistController@show',$playlist->id)}}" class="collection-item">{{$playlist->name}}</a>
@endforeach
</div>

@endsection