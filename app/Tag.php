<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'tags';

    public function playlists()
    {
    	return $this->belongsToMany('App\Playlist','TagPlaylist')->withTimestamps();
    }
}
