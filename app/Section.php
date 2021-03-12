<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $fillable = [
        'name', 'description', 'status' , 'name_english' , 'description_english'
    ];

    public function courses()
    {
        return $this->belongsToMany('App\Course','course_sections');
    }
}
