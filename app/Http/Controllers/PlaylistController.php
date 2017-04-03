<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Playlist;
use App\User;
use App\Song;
use App\Tag;
use App\TagPlaylist;
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
        $this->validate($request, [
            'name' => 'bail|required|unique:playlists|max:255',
            'description' => 'required',
            'tags' => 'required',
         ]);

 		$playlist = new Playlist();
 		$playlist->name = $request->input('name');
 		$playlist->description = $request->input('description');
 		$playlist->user_id = Auth::user()->id;
 		$playlist->save();
        if($request->tags)
            foreach($request->tags as $tag)
            {
                if(! Tag::where('tag_name',$tag)->first()) //Tag Name hasn't yet been registered in the database
                {
                   $tag_record = new Tag();
                   $tag_record->tag_name = $tag;
                   $tag_record->save();

                }
                else
                   $tag_record = Tag::where('tag_name',$tag)->first();
                
                $playlist->tags()->attach($tag_record->id);
              
            }
 		return redirect()->action('PlaylistController@home');
    }

    public function show($id)
    {
    	$playlist = Playlist::find($id);
    	$songs = $playlist->songs()->get();
        $tags = $playlist->tags()->get();
        $i=1;
    	return view('playlists.show',['playlist'=>$playlist , 'songs'=>$songs, 'i'=>$i, 'tags'=>$tags] );
    }

    public function edit($id)
    {
    	$playlist = Playlist::where('id',$id)->first();
        $tags = $playlist->tags()->get();
    	return view('playlists.edit',[ 'playlist'=>$playlist, 'tags'=>$tags ]);
    }

    public function update($id,Request $request)
    {

        $this->validate($request, [
            'name' => 'bail|required|max:255',
            'description' => 'required',
            'tags' => 'required',
         ]);
       // return $request->all();
    	$playlist = Playlist::where('id',$id)->first();
    	$playlist->name = $request->input('name');
 		$playlist->description = $request->input('description');
 		$playlist->save();
        $playlist->tags()->detach(); //Remove all current tags associated with the playlist
        if($request->tags)
            foreach($request->tags as $tag)
            {
                if(! Tag::where('tag_name',$tag)->first()) //Tag Name hasn't yet been registered in the database
                {
                   $tag_record = new Tag();
                   $tag_record->tag_name = $tag;
                   $tag_record->save();

                }
                else
                   $tag_record = Tag::where('tag_name',$tag)->first();
                
                $playlist->tags()->attach($tag_record->id);
              
            }
 		return redirect()->action('PlaylistController@show',$id);
    }
}
