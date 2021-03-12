<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'name', 'image', 'status','name_english','price','description','description_english'
    ];

    public function sections()
    {
        return $this->belongsToMany('App\Section','course_sections','course_id','section_id');
    }

    public function playlists()
    {
        return $this->belongsToMany('App\Playlist', 'course_playlists', 'course_id', 'playlist_id');
    }

    public function modules()
    {
        return $this->hasMany('App\Module', 'course_id', 'id');
    }
    public function users()
    {
        return $this->belongsToMany('App\User','course_users', 'course_id', 'user_id');
    }
}
