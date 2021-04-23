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
    public function getLesson(Request $request,$id)
    {
        $lesson = Lesson::find($id);
        $lesson["nodes"] = $lesson->nodes()->get();
        $userInLesson = $lesson->users()->find(auth()->user()->id);
        if($userInLesson){
            $lesson["percent"] = $userInLesson->pivot->percent;
        }
        foreach ($lesson->nodes as $node) {
            $node["options"] = $node->options()->get();
        }
        return response()->json($lesson,200);
    }
}
