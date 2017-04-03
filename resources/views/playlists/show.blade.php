@extends('master')
@section('title',"Playlist")
@section('content')
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.8";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div class="page-header row">
    <div class="heading col s5 m5 l5" style="float: left;">
       <h3>{{$playlist->name}}</h3>
    </div>
    @if(Auth::user()->id == $playlist->user_id)
    <div class="flatBtn col s2 m2 l2">
    	<a href="{{action('PlaylistController@edit',$playlist->id)}}" class="waves-effect waves-light btn"><i class="material-icons left">edit</i>Edit</a>
   	</div>
   	<div class="flatBtn col s3 m3 l3">
    	<a class="waves-effect waves-light btn" href="{{action('SongsController@add',$playlist->id)}}" ><i class="material-icons left">playlist_add</i>Add Songs</a>
    </div>
    @endif
    <div class="col s2 m2 l2 fb-share-button" data-href="http://localhost:8000/playlists/4" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flocalhost%3A8000%2Fplaylists%2F4&amp;src=sdkpreparse">Share</a></div>
</div>

@if (session('status'))
    <div class="alert alert-success">
       <p>{{ session('status') }}</p>
    </div>
@endif


<p>Created by: <a href="{{action('PlaylistController@userPlaylists',$playlist->user->id)}}">{{$playlist->user->name}}</a></p>
<p>About playlist: {{$playlist->description}}</p>
<p>Tags:
@foreach($tags as $tag)
	<a href="{{action('TagsController@show',$tag->id)}}">{{$tag->tag_name}} </a>
@endforeach
</p>
<hr/>

<p id="current_song"></p>
<div class="row player-controls">

	<div class="col s1 m1 l1 offset-l4 ">
		<button type="button" class="waves-effect waves-light btn" id="prev" ><i class="material-icons">skip_previous</i></button>
	</div>
	<div class="col s1 m1 l1">
		<button type="button" class="waves-effect waves-light btn" id="togglePlay"><i id="play-pause" class="material-icons">play_arrow</i></button>
	</div>
	<div class="col s1 m1 l1">
		<button type="button" class="waves-effect waves-light btn" id="next"><i class="material-icons">skip_next</i></button>
	</div>
	<div class="switch col s3 m3 l3">
	    <label>
	      <input id="toggleShuffle" type="checkbox">
	      <span class="lever"></span>
	      Shuffle
	    </label>
  	</div> 
</div>
<hr/>

<ul class="collection">


    @foreach($songs as $song)
    <li id="{{$i++}}" class="song_listing collection-item avatar">
      <div class="hidden">{{$song->url}}</div>
      <div class="song_id hidden">{{$song->id}}</div>
      <div class="source hidden">{{$song->source}}</div>
      <img src="{{$song->thumbnail}}" alt="" class="circle">
      <span class="title">{{$song->title}}</span>
      <p class="song_description">{{$song->description}}
      </p>
      @if(Auth::user()->id == $playlist->user_id)
     	 <form action="{{action('SongsController@destroy',$song->id)}}"" method="POST">
		    {{ csrf_field() }}
		    {{ method_field('DELETE') }}
		    <button class="btn btn-danger" type="submit" onclick='return confirm("Are you sure you want to delete ?")'>Delete</button>
		 </form>
    	@endif
    </li>
    @endforeach
</ul>

<div class="row">
	<div class="offset-l2 col s8 l8 m8">
		<iframe id="ytplayer" type="text/html" width="100%" height="405" src="" frameborder="2" allowfullscreen ></iframe>
	</div>
<iframe id="gaanaplayer"  type="text/html" width="0px" height="0px" sandbox='allow-forms allow-scripts allow-same-origin' src="" frameborder="0" ></iframe>




	



@endsection