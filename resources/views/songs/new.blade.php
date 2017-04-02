@extends('master')
@section('title','Add Song to Playlist')
@section('content')


<h3>Playlist: {{$playlist->name}} </h3>


 <form  id="add-song-form" action="{{action('SongsController@store',$playlist->id)}}" class="s12 m12 l12 " method="post" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="row">
            <div class="input-field col s12 m12 l12">
                <input name ="url" id="url"  type="text" class="validate">
                <label for="url">Enter the song url (YouTube, SoundCloud, etc.)</label>
                <input name="title" id="title" type="hidden">
                <input name="description" id="description" type="hidden">
            	<input name="source" id="source" type="hidden">
                <input name="duration" id="duration" type="hidden">
                <input name="thumbnail" id="thumbnail" type="hidden">
                <button id="fetch_data" type="button" class="btn col s12 m12 l12">Fetch Data</button>
                <br/>
            </div>
            
        </div>
        <div class="song_meta row">
			<div class="thumbnail col s4 l4 m4">
				<img class="song-thumbnail" src="">
			</div>
			<div class="text-meta col s7 l7 m7">
				<img class="song-source-logo" src="">
				<p class="song-title"></p>
				<p class="song-duration"></p>
			</div>
		</div>

		<div class="row">
			<div class="input-field col s12 m12 l12">
       			 <button id="form-submit" type="submit" class="btn col s12 m12 l12">Add song to playlist!</button>
       		</div>
       	</div>
	        
</form>



@endsection
