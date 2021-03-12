<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
        'name','module_id','content','test','status','name_english'
    ];

    public function module()
    {
        return $this->belongsTo('App\Module', 'module_id', 'id');
    }
    public function users()
    {
        return $this->belongsToMany('App\User','lesson_users')->withPivot('percent');
    }
}
