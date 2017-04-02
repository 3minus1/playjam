@extends('master')
@section('title','Home')
@section('content')
@if(Auth::user())
	<br/>
	<a href="{{action('PlaylistController@create')}}">Create Playlist</a>

	
	@foreach($playlists as $playlist)

		 <div class="row">
	        <div class="col s4 m4 l4">
	          <div class="card small" >
	            <div class="card-image">
	              <img src="/logo/yt.png">
	              <span class="card-title">Playlist #1</span>
	            </div>
	            <div class="card-content">
	              <p>{{$playlist->description}}</p>
	            </div>
	            <div class="card-action">
	              <a href="{{action('PlaylistController@show',$playlist->id)}}">View Playlist</a>
	            </div>
	          </div>
	        </div>

	@endforeach

       

    


@else
	<h2>Not Logged In</h2>
	<a href="/auth/facebook">Login</a>
@endif
@endsection