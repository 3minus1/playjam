<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Playlist;
use App\User;
use App\Song;
use App\Tag;
use Auth;


class PlaylistController extends Controller
{

    public function home()
    {
        $playlists = Playlist::all();
        return view('home',['playlists'=>$playlists]);
    }

	public function index()
	{
		$playlists = Playlist::where('user_id',Auth::user()->id)->get();

		return view('playlists.index',['playlists' => $playlists] );
	}

	public function create()
	{
		return view('playlists.new');
	}

    public function store(Request $request)
    {
       // return $request->all();
        
        //return;
 		$playlist = new Playlist();
 		$playlist->name = $request->input('name');
 		$playlist->description = $request->input('description');
 		$playlist->user_id = Auth::user()->id;
 		$playlist->save();
        foreach($request->tags as $tag)
        {
            $tag_record = new Tag();
            $tag_record->tag_name = $tag;
            $tag_record->playlist_id = $playlist->id;
            $tag_record->save();
        }
 		return redirect()->action('PlaylistController@home');
    }

    public function show($id)
    {
    	$playlist = Playlist::where('id',$id)->first();
    	$songs = Song::where('playlist_id',$id)->get();
        $i=1;
    	return view('playlists.show',['playlist'=>$playlist , 'songs'=>$songs, 'i'=>$i] );
    }

    public function edit($id)
    {
    	$playlist = Playlist::where('id',$id)->first();
    	return view('playlists.edit',[ 'playlist'=>$playlist ]);
    }

    public function update($id,Request $request)
    {
    	$playlist = Playlist::where('id',$id)->first();
    	$playlist->name = $request->input('name');
 		$playlist->description = $request->input('description');
 		$playlist->save();
 		return redirect()->action('PlaylistController@show',$id);
    }
}
