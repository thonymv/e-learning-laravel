<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\course_playlist;


class CoursePlaylist extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        return course_playlist::create($data);
    }
}
