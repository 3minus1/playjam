<a href="{{action('PlaylistController@edit',$playlist->id)}}">Edit</a>
<hr/>
<p>Name: {{$playlist->name}}</p>
<p>Description:</p>
<p>{{$playlist->description}}</p>
<hr/>

@if($songs)
	<p><b>Songs:</b></p>
	@foreach($songs as $song)
		<p>{{$song->title}} </p>
		<form action="{{action('SongsController@destroy',$song->id)}}"" method="POST">
		    {{ csrf_field() }}
		    {{ method_field('DELETE') }}
		    <button type="submit" onclick='return confirm("Are you sure you want to delete ?")'>Delete</button>
		</form>
	@endforeach
@endif
<br/>

<a href="{{action('SongsController@add',$playlist->id)}}">Add Songs</a>
