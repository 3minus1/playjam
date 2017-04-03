@extends('master')
@section('title','My Playlists')
@section('content')

<div class="page-header row">
    <div class="col s12 m12 l12">
       <h3>My Playlists</h3>
    </div>
</div>

<table>
	<thead>
	  <tr>
	      <th>Name</th>
	      <th>Songs</th>
	      <th>Description</th>
	      <th>Created At</th>
	      <th></th>
	      <th></th>
	  </tr>
	</thead>

	<tbody>
	@foreach($playlists as $playlist)
	  <tr>
	    <td><a href="{{action('PlaylistController@show',$playlist->id)}}">{{$playlist->name}}</a></td>
	    <td>{{$playlist->songs->count()}}</td>
	    <td>{{$playlist->description}}</td>
	    <td>{{date('F d, Y', strtotime($playlist->created_at))}}</td>
	    <td><a href="{{action('PlaylistController@edit',$playlist->id)}}" class="btn">Edit</a></td>
	    <td>
		    <form action="{{action('PlaylistController@destroy',$playlist->id)}}"" method="POST">
			    {{ csrf_field() }}
			    {{ method_field('DELETE') }}
			    <button class="btn btn-danger" type="submit" onclick='return confirm("Are you sure you want to delete ?")'>Delete</button>
			</form>
		</td>
	  </tr>
	@endforeach
	</tbody>
</table>
@endsection
    

