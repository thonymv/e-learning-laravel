<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class node_lesson extends Model
{
    public $table = "node_lesson";

    protected $fillable = [
        'title','content','title_english','content_english','image','type_id','lesson_id'
    ];

    public function lesson()
    {
        return $this->belongsTo('App\Lesson', 'lesson_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo('App\type_node_lesson', 'type_id', 'id');
    }

    public function options()
    {
        return $this->hasMany('App\options_node_lesson', 'node_lesson_id', 'id');
    }
}
