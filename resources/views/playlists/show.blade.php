@extends('master')
@section('title',"Playlist")
@section('content')

<h3>{{$playlist->name}}</h3>
<p>{{$playlist->description}}</p>
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

@if(Auth::user()->id == $playlist->user_id)
	@include('playlists.partials.show_user')
@else
	@include('playlists.partials.show_global')
@endif



@endsection