@extends('master')
@section('title','Home')
@section('content')
<div id="fb-root"></div>

@if(Auth::user())
	<br/>
	<div class="header row">
		<div class="heading col s5 m5 l5">
			<h3>Browse Playlists:</h3>
		</div>
		<div class="addBtn col s1 m1 l1">
			<a href="{{action('PlaylistController@create')}}" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
		</div>
	</div>
        
	<hr/>

@if (session('status'))
    <div class="alert alert-success">
       <p>{{ session('status') }}</p>
    </div>
@endif

 <div class="playlists-container row">
	@foreach($playlists as $playlist)

		
	        <div class="col s4 m4 l4">
	          <div class="card small" >
	            <div class="card-image">
	              <img src="https://maxcdn.icons8.com/Color/PNG/512/Music/playlist-512.png" height="195px" width="auto">
	              <span class="card-title"></span>
	            </div>
	            <div class="card-content">
	              <p>{{$playlist->name}}</p>
	            </div>
	            <div class="card-action">
	              <a href="{{action('PlaylistController@show',$playlist->id)}}">View Playlist</a>
	            </div>
	          </div>
	     </div>

	@endforeach
</div>


       

    


@else
	
	<div class="page-header row">
	    <div class="col s12 m12 l12">
	       <h3>Welcome to PlayJam!</h3>
	    </div>
	</div>
	<div class="home-banner row">
		<div class="col s12 m12 l12">
			<h2><i>Create, curate, and share playlists</i></h2>
			<h3> from across the web!</h3>
			<div class="login-btn">
				<a href="/auth/facebook"><img width="40%" src="/logo/fb-btn.png"></a>
			</div>

		</div>
		<i>Please login via Facebook to use PlayJam.</i>
	</div>
	
	<hr/>
@endif
@endsection