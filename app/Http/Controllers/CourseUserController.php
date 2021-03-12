<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\course_user;


class CourseUserController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        return course_user::create($data);
    }
}