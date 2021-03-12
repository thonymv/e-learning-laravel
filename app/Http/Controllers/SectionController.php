<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Section;
use App\Course;
use App\course_section;


class SectionController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        return Section::create($data);
    }
    
    public function update(Request $request,$id){
        $data = $request->all();
        return Section::where('id',$id)->update($data)? response()->json(['response'=>'ok'],200):  response()->json(['error'=>'error to update'],500);
    }

    public function getSections()
    {
        $sections = Section::inRandomOrder()->get();
        foreach ($sections as $section) {
            foreach ($section->courses as $course) {
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
        }
        return response()->json($sections,200);
    }

    public function getSection(Request $request,$id)
    {
        $section = Section::find($id);
        foreach ($section->courses as $course) {
            $course["locked"] = $course->users()->find(auth()->user()->id)?false:true;
            $course["modules"] = $course->modules()->where('status',1)->get();
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
        return response()->json($section,200);
    }
    public function remove($id){
        if (course_section::where('section_id',$id)->first()) {
            course_section::where('section_id',$id)->delete();
        }
        return Section::where('id',$id)->delete()? response()->json(['response'=>'ok'],200):  response()->json(['error'=>'error to delete'],500);
    }
}
