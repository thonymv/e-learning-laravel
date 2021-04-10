<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class options_node_lesson extends Model
{
    protected $fillable = [
        'position_init','position_success','response','response_english','success','node_lesson_id'
    ];
    public function node_lesson()
    {
        return $this->belongsTo('App\node_lesson', 'node_lesson_id', 'id');
    }
}