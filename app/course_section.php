<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class course_section extends Model
{
    protected $fillable = [
        'course_id', 'section_id'
    ];
}
