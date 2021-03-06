<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Playlist;
use App\Song;

class SongsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function add($playlist_id)
    {
    	$playlist = Playlist::where('id',$playlist_id)->first();
    	return view('songs.new',['playlist'=>$playlist]);
    }

    public function store($playlist_id,Request $request)
    {
        $this->validate($request, [
            'url' => 'bail|required|unique:songs|max:255',    
        ]);
    	$song = new Song();
    	$song->title = $request->input('title');
    	$song->description = $request->input('description');
    	$song->thumbnail = $request->input('thumbnail');
    	$song->source = $request->input('source');
    	$song->url = $request->input('url');
    	$song->playlist_id = $playlist_id;
    	$song->duration = $request->input('duration');
    	$song->save();
    	return redirect()->action('PlaylistController@show',$playlist_id)->with('status','Song has been added!');
    }

    public function destroy($id)
    {
        $song = Song::find($id);
        $playlist = $song->playlist;
        $song->destroy($id);
        return redirect()->action('PlaylistController@show',$playlist)->with('status','Song has been deleted!');
    }
}
