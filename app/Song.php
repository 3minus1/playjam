<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $table = 'Songs';

    public function playlist()
    {
    	return $this->belongsTo('App\Playlist');
    }
}
