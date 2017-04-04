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
    public function __construct()
    {
        $this->middleware('auth');
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
 		return redirect()->action('PlaylistController@show',$playlist->id)->with('status','Playlist has been created. Now add songs!');
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
 		return redirect()->action('PlaylistController@show',$id)->with('status','Playlist has been updated!');
    }

    public function destroy($id)
    {
        $playlist = Playlist::find($id);
        //$playlist->songs()->detach();
        $playlist->destroy($id);
        return redirect()->action('PlaylistController@index')->with('status','Playlist has been deleted!');
    }

    public function userPlaylists($id)
    {   
        $user = User::find($id);
        $playlists = $user->playlists()->get();
        return view('playlists.userPlaylists',['user'=>$user, 'playlists'=>$playlists]);
    }
}
