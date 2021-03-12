<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Course;


class CourseController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        return Course::create($data);
    }

    public function getCourses(Request $request)
    {
        $courses = Course::inRandomOrder()->get();
        foreach ($courses as $course) {
            $course["locked"] = $course->users()->find(auth()->user()->id)?false:true;
            foreach ($course->modules as $module) {
                $module["lessons"] = $module->lessons()->where('status',1)->get();
                foreach ($module->lessons as $lesson) {
                    $userInLesson = $lesson->users()->find(auth()->user()->id);
                    if($userInLesson){
                        $lesson["percent"] = $userInLesson->pivot->percent;
                    }
                }
            }
        }   
        return response()->json($courses,200);
    }
    
    public function getCourse(Request $request,$id)
    {
        $course = Course::find($id);
        $course["modules"] = $course->modules()->where('status',1)->get();
        $course["locked"] = $course->users()->find(auth()->user()->id)?false:true;
        foreach ($course->modules as $module) {
            $module["lessons"] = $module->lessons()->where('status',1)->get();
            foreach ($module->lessons as $lesson) {
                $userInLesson = $lesson->users()->find(auth()->user()->id);
                if($userInLesson){
                    $lesson["percent"] = $userInLesson->pivot->percent;
                }
            }
        }
        return response()->json($course,200);
    }
}
