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
  <div class="fb-share-button" data-href="http://localhost:8000/playlists/4" data-layout="button" data-size="large" data-mobile-iframe="true"><a class="fb-xfbml-parse-ignore" target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A%2F%2Flocalhost%3A8000%2Fplaylists%2F4&amp;src=sdkpreparse">Share</a></div>
</div>

@if(Auth::user()->id == $playlist->user_id)
	@include('playlists.partials.show_user')
@else
	@include('playlists.partials.show_global')
@endif



@endsection