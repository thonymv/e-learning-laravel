<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class lesson_user extends Model
{
    protected $fillable = [
        'lesson_id', 'user_id','percent'
    ];
}