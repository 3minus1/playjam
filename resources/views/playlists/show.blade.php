@extends('master')
@section('title',"Playlist")
@section('content')

<h3>{{$playlist->name}}</h3>
<p>{{$playlist->description}}</p>
<hr/>


<div class="row">
	<div class="col s4 m4 l4">
		<button type="button" id="prev" class="btn">Previous</button>
	</div>
	<div class="col s4 m4 l4">
		<button type="button" id="togglePlay" class="btn">Play/Pause</button>
	</div>
	<div class="col s4 m4 l4">
		<button type="button" id="next" class="btn">Next</button>
	</div>
</div>

@if(Auth::user()->id == $playlist->user_id)
	@include('playlists.partials.show_user')
@else
	@include('playlists.partials.show_global')
@endif



@endsection