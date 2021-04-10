<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class type_node_lesson extends Model
{
    protected $fillable = [
        'name'
    ];

    public function node_lesson()
    {
        return $this->hasMany('App\node_lesson', 'type_id', 'id');
    }
}
