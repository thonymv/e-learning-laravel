<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'name','course_id','image','status','name_english'
    ];
    
    public function course()
    {
        return $this->belongsTo('App\Course', 'course_id', 'id');
    }

    public function lessons()
    {
        return $this->hasMany('App\Lesson', 'module_id', 'id');
    }
}
