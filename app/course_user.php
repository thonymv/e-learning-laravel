<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course_user extends Model
{
    protected $fillable = [
        'user_id', 'course_id'
    ];
}
