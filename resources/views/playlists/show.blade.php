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
<h3>{{$playlist->name}}</h3>

@if(Auth::user()->id == $playlist->user_id)
	<a class="btn" href="{{action('PlaylistController@edit',$playlist->id)}}">Edit</a>
	<a class="btn" href="{{action('SongsController@add',$playlist->id)}}">Add Songs</a>
	
@endif
<div class="fb-share-button" data-href="http://localhost:8000/playlists/4" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flocalhost%3A8000%2Fplaylists%2F4&amp;src=sdkpreparse">Share</a></div>
<p>{{$playlist->description}}</p>
<p>Tags:
@foreach($tags as $tag)
	<a href="#">{{$tag->tag_name}} </a>
@endforeach
</p>
<hr/>

<p id="current_song"></p>
<div class="row">
	<div class="col s3 m3 l3">
		<button type="button" id="prev" class="btn">Previous</button>
	</div>
	<div class="col s3 m3 l3">
		<button type="button" id="togglePlay" class="btn">Play/Pause</button>
	</div>
	<div class="col s3 m3 l3">
		<button type="button" id="next" class="btn">Next</button>
	</div>
	<div class="switch col s3 m3 l3">
    <label>
      Linear
      <input id="toggleShuffle" type="checkbox">
      <span class="lever"></span>
      Shuffle
    </label>

  </div>
  
</div>

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

<iframe id="ytplayer" type="text/html" width="720" height="405" src="" frameborder="2" allowfullscreen ></iframe>

<iframe id="gaanaplayer"  type="text/html" width="0px" height="0px" sandbox='allow-forms allow-scripts allow-same-origin' src="" frameborder="0" ></iframe>




	



@endsection