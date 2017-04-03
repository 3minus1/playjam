@extends('master')
@section('title','Create Playlist')
@section('content')

 <form  id="create-playlist-form" action="{{action('PlaylistController@store')}}" class="s12 m12 l12 " method="post" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="row">
            <div class="input-field col s12 m12 l12">
                <input name ="name" id="name_input"  type="text" class="validate">
                <label for="name">Playlist Name</label>
            </div>
            <div class="input-field col s12 m12 l12">
                  <textarea id="description" name="description" class="materialize-textarea"></textarea>
                  <label for="description">Description</label>
                  
            </div>
            
             <div class="input-field col s12 m12 l12">

                <div class="chips chips-placeholder"></div>

            </div>
            <button id="submitBtn" type="submit"  class="btn col s12 m12 l12" >Submit</button>
        </div>
        
</form>
@endsection