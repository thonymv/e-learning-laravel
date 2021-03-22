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
        $sections = Section::paginate(5);
        $courses = Course::get();
        $sectionsActive = 0;
        $sectionsEmpty = 0;
        foreach ($sections as $section) {
            if ($section["status"] > 0) {
                ++$sectionsActive;
            }
            foreach ($section->courses as $course) {
                foreach ($course->modules as $module) {
                    $module->lessons;
                }
            }   
            if (count($section->courses) < 1) {
               ++$sectionsEmpty;
            }
        }
        $page = $sections->toArray();
        unset($page["data"]);
        return view('home',[
            'sections'=>$sections,
            'page'=>$page,
            'sectionsActive'=>$sectionsActive,
            'sectionsEmpty'=>$sectionsEmpty,
            'courses'=>$courses
        ]);
    }
}
