<a href="{{action('PlaylistController@edit',$playlist->id)}}">Edit</a>
<hr/>
<p>Name: {{$playlist->name}}</p>
<p>Description:</p>
<p>{{$playlist->description}}</p>
<hr/>

@if($songs)
	<p><b>Songs:</b></p>
	@foreach($songs as $song)
		<p>{{$song->title}}</p>
	@endforeach
@endif

<a href="{{action('SongsController@add',$playlist->id)}}">Add Songs</a>
