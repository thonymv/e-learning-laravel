<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Section;
use App\Course;
use App\course_section;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sections = Section::inRandomOrder()->get();
        foreach ($sections as $section) {
            foreach ($section->courses as $course) {
                foreach ($course->modules as $module) {
                    $module->lessons;
                }
            }   
        }
        return view('home',['sections'=>$sections]);
    }
}
