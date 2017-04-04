@extends('master')
@section('js_src',"src=/js/chips.js")
@section('title','Create Playlist')
@section('content')
<div class="page-header row">
    <div class="col s12 m12 l12">
       <h3>Create Playlist</h3>
    </div>
</div>

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

 <form  id="create-playlist-form" action="{{action('PlaylistController@store')}}" class="s12 m12 l12 " method="post" accept-charset="UTF-8">
        <input type="hidden" name="_token" value="{!! csrf_token() !!}">
        <div class="row">
            <div class="input-field col s12 m12 l12">
                <input name ="name" id="name_input"  type="text" class="validate" value="{{old('name')}}">
                <label for="name">Playlist Name</label>
            </div>
            <div class="input-field col s12 m12 l12">
                  <textarea id="description" name="description" class="materialize-textarea">{{old('description')}}</textarea>
                  <label for="description">Description</label>
                  
            </div>
            
             <div class="input-field col s12 m12 l12">

                <div class="chips chips-placeholder"></div>
                <button id="submitBtn" type="submit"  class="btn col s12 m12 l12" >Submit</button>
            </div>
            
        </div>
        
</form>
@endsection