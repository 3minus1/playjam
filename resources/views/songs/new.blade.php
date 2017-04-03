@extends('master')
@section('title','Add Song to Playlist')
@section('content')

<div class="page-header row">
    <div class="col s12 m12 l12">
       <h3>{{$playlist->name}}: Add Song </h3>
    </div>
</div>

 <form  id="add-song-form" action="{{action('SongsController@store',$playlist->id)}}" class="s12 m12 l12 " method="post" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="row">
            <div class="input-field col s12 m12 l12">
                <input name ="url" id="url"  type="text" class="validate">
                <label for="url">Enter the song url (YouTube, Gaana, or Saavn)</label>
                <input name="title" id="title" type="hidden">
                <input name="description" id="description" type="hidden">
            	<input name="source" id="source" type="hidden">
                <input name="duration" id="duration" type="hidden">
                <input name="thumbnail" id="thumbnail" type="hidden">
                <button id="fetch_data" type="button" class="btn col s12 m12 l12">Fetch Data</button>
                <br/>
            </div>
            <div id="loader" class="row">
                <div class="col s12 m12 l12 center">
                    <div class="preloader-wrapper big  active">
                        <div class="spinner-layer spinner-red-only">
                          <div class="circle-clipper left">
                            <div class="circle"></div>
                          </div><div class="gap-patch">
                            <div class="circle"></div>
                          </div><div class="circle-clipper right">
                            <div class="circle"></div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="song_meta row">
			<div class="thumbnail col s4 l4 m4 center">
				<img id="song-thumbnail" class="song-thumbnail" src="">
                <button type="button" id="reset" class="btn resetBtn">Reset</button>
			</div>
			<div class="text-meta col s8 l8 m8">
				<p id="song-title" class="song-title"></p>
				<p id="song-duration" class="song-duration"></p>
                <img id="song-source-logo" class="song-source-logo" src="">
			</div>
		</div>

		<div class="row">
			<div class="input-field col s12 m12 l12">
       			 <button id="form-submit" type="submit" class="btn col s12 m12 l12">Add song to playlist!</button>
       		</div>
       	</div>
	        
</form>



@endsection
