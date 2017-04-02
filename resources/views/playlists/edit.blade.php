@extends('master')
@section('title','Create Playlist')
@section('content')

 <form  id="create-playlist-form" action="{{action('PlaylistController@update',$playlist->id)}}" class="s12 m12 l12 " method="post" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <input type="hidden" name="_method" value="PUT">
        <div class="row">
            <div class="input-field col s12 m12 l12">
                <input name ="name" id="name_input"  type="text" class="validate" value="{{$playlist->name}}" >
                <label for="name">Playlist Name</label>
            </div>
            <div class="input-field col s12 m12 l12">
                  <textarea id="description" name="description" class="materialize-textarea" >{{$playlist->description}}</textarea>
                  <label for="description">Description</label>
                  <input type="submit"  class="btn col s12 m12 l12" value="Save">
            </div>
            
        </div>
        
</form>
@endsection