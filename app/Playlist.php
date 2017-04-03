<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $table='Playlists';

    public function songs()
    {
    	return $this->hasMany('App\Song');
    }

    public function tags()
    {
    	return $this->hasMany('App\Tag');
    }
}
