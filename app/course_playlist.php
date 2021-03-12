<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course_playlist extends Model
{
    protected $fillable = [
        'course_id', 'playlist_id'
    ];
}
