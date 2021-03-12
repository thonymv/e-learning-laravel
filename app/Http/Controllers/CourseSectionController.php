<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\course_section;


class CourseSectionController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        foreach ($data as $course) {
            if (!course_section::create($course)) {
                return response()->json(['error'=>'error to insert course_section'],500);
            }
        }
        return response()->json(['response'=>'ok'],200);
    }

    public function remove($section_id,$course_id){
        return course_section::where('section_id',$section_id)->where('course_id',$course_id)->delete()? response()->json(['response'=>'ok'],200):  response()->json(['error'=>'error to delete'],500);
    }
    
    public function removeSection($section_id){
        return course_section::where('section_id',$section_id)->delete()? response()->json(['response'=>'ok'],200):  response()->json(['error'=>'error to delete'],500);
    }
}
