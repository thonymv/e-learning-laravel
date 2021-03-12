<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\lesson_user;

class LessonUserController extends Controller
{
    public function store(Request $request){
        $data = $request->all();
        return lesson_user::create($data);
    }
}
