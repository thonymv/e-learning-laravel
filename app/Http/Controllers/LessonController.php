<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Lesson;

class LessonController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        return Lesson::create($data);
    }
}
