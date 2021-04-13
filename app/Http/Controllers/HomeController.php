<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Section;
use App\Course;
use App\Module;
use App\course_section;
use App\Lesson;
use App\node_lesson;


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

    public function courses()
    {
        $courses = Course::paginate(5);
        $coursesActive = 0;
        $coursesEmpty = 0;
        foreach ($courses as $course) {
            if ($course["status"] > 0) {
                ++$coursesActive;
            }
            if (count($course->modules) < 1) {
                ++$coursesEmpty;
            }
        }
        $page = $courses->toArray();
        unset($page["data"]);
        return view('courses',[
            'courses'=>$courses,
            'page' => $page,
            'coursesActive'=>$coursesActive,
            'coursesEmpty'=>$coursesEmpty
        ]);
    }

    public function modules($id)
    {
        $course = Course::find($id);
        if (!$course) {
            abort(404);
        }
        $modules = Module::where('course_id',$id)->paginate(5);
        $modulesActive = 0;
        $modulesEmpty = 0;
        foreach ($modules as $module) {
            if ($module["status"] > 0) {
                ++$modulesActive;
            }
            if (count($module->lessons) < 1) {
                ++$modulesEmpty;
            }
        }
        $page = $modules->toArray();
        unset($page["data"]);
        unset($course["modules"]);
        return view('modules',[
            'course'=>$course,
            'modules'=>$modules,
            'page' => $page,
            'modulesActive'=>$modulesActive,
            'modulesEmpty'=>$modulesEmpty
        ]);
    }

    public function lessons($id_course,$id_module)
    {
        $course = Course::find($id_course);
        $module = Module::find($id_module);
        if (!$course || !$module) {
            abort(404);
        }
        $lessons = Lesson::where('module_id',$id_module)->paginate(5);
        $lessonsActive = 0;
        $lessonsEmpty = 0;
        foreach ($lessons as $lesson) {
            if ($lesson["status"] > 0) {
                ++$lessonsActive;
            }
            if (count($lesson->nodes) < 1) {
                ++$lessonsEmpty;
            }
        }
        $page = $lessons->toArray();
        unset($page["data"]);
        unset($course["modules"]);
        unset($module["lessons"]);
        return view('lessons',[
            'course'=>$course,
            'module'=>$module,
            'lessons'=>$lessons,
            'page' => $page,
            'lessonsActive'=>$lessonsActive,
            'lessonsEmpty'=>$lessonsEmpty
        ]);
    }


    public function nodes($id_course,$id_module,$id_lesson,$message = "",$err = false)
    {
        $course = Course::find($id_course);
        $module = Module::find($id_module);
        $lesson = Lesson::find($id_lesson);
        if (!$course || !$module) {
            abort(404);
        }
        $nodes = node_lesson::where('lesson_id',$id_lesson)->paginate(5);
        $nodesActive = 0;
        $nodesEmpty = 0;
        foreach ($nodes as $node) {
            if ($node["status"] > 0) {
                ++$nodesActive;
            }
            if (count($node->options) < 1) {
                ++$nodesEmpty;
            }
        }
        $page = $nodes->toArray();
        unset($page["data"]);
        unset($course["modules"]);
        unset($module["lessons"]);
        unset($lesson["options"]);
        return view('nodes',[
            'course'=>$course,
            'module'=>$module,
            'lesson'=>$lesson,
            'nodes'=>$nodes,
            'page' => $page,
            'nodesActive'=>$nodesActive,
            'nodesEmpty'=>$nodesEmpty,
            'message'=>$message,
            'err'=>$err
        ]);
    }

    public function node_content_register(Request $request,$id_course,$id_module,$id_lesson){
        $data = $request->all();
        $data["success"] = false;
        $message = "Hubo un error al registrar el nodo tipo \"Contenido\" ";
        $err = false;
        if(node_lesson::create($data)){
            $message = "Se ha registrado el nodo tipo \"Contenido\" exitosamente";
            $err = false;
        }
        return $this->nodes($id_course,$id_module,$id_lesson,$message,$err);
    }

}
