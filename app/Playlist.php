<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Playlist extends Model
{
    protected $fillable = [
        'name','user_id'
    ];
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function courses()
    {
        return $this->belongsToMany('App\Course', 'course_playlists', 'playlist_id', 'course_id');
    }
}