<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;

class TagsController extends Controller
{
	public function __construct()
	{
	    $this->middleware('auth');
	}
    public function show($id)
    {
    	$tag = Tag::find($id);
    	$playlists = $tag->playlists()->get();
    	
    	return view('tags.show',['playlists'=>$playlists, 'tag'=>$tag]);
    }
}
