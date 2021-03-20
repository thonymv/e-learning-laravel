<?php

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PaypalCreatePay;
use App\Http\Controllers\PaypalClient;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\CourseSectionController;
use App\Http\Controllers\CoursePlaylist;
use App\Http\Controllers\CourseUserController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\LessonUserController;
use App\Http\Controllers\Auth\RegisterController;

//header('Access-Control-Allow-Origin: http://admin.simonethg.com');
header('Access-Control-Allow-Origin: http://localhost:80/');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, DELETE, PUT, PATCH');
header('Access-Control-Max-Age:  1000');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization, accept');

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user/current', function () {
    $user = auth()->user();
    foreach ($user->courses as $course) {
        foreach ($course->modules as $module) {
            foreach ($module->lessons as $lesson) {
                $userInLesson = $lesson->users()->find($user->id);
                if($userInLesson){
                    $lesson["percent"] = $userInLesson->pivot->percent;
                }
            }
        }
    }
    return $user;
});

Route::group(['middleware'=>'auth:api'],function ()
{
    //get all users
    Route::get('user',[UserController::class, 'getUsers']);
    Route::get('logged',function(){ return "ok"; });
    Route::get('section',[SectionController::class, 'getSections']);//agregar soporte de ingles
    Route::get('section/{id}',[SectionController::class, 'getSection']);//agregar soporte de ingles
    Route::get('course',[CourseController::class, 'getCourses']);//agregar soporte de ingles
    Route::get('course/{id}',[CourseController::class, 'getCourse']);//agregar soporte de ingles

    Route::middleware('check.course')->group(function () {//middleware para contenido de cursos pagos
    
    });
    
    //Route::get('module/{id}',[ModuleController::class, 'getModule']);//agregar soporte de ingles
    
    //post user
    Route::post('playlist',[PlaylistController::class, 'store']);//agregar soporte de ingles
    Route::post('course_playlist',[CoursePlaylist::class, 'store']);
    Route::post('course_user',[CourseUserController::class, 'store']);
    Route::post('lesson_user',[LessonUserController::class, 'store']);
    //admin
    Route::middleware('check.permissions')->group(function () {
        //post admin
        Route::get('logged_admin',function(){ return "ok"; });
        Route::post('section',[SectionController::class, 'store']);
        Route::post('course',[CourseController::class, 'store']);
        Route::post('course_section',[CourseSectionController::class, 'store']);
        Route::post('module',[ModuleController::class, 'store']);
        Route::post('lesson',[LessonController::class, 'store']);
        Route::post('user_admin', [UserController::class, 'storeAdmin']);

        //put admin
        Route::put('section/{id}',[SectionController::class, 'update']);


        //delete admin
        Route::delete('course_section/{section_id}/{course_id}',[CourseSectionController::class, 'remove']);
        Route::delete('course_section/{section_id}',[CourseSectionController::class, 'removeSection']);
        Route::delete('section/{id}',[SectionController::class, 'remove']);
    });
    //logout user
    Route::get('logout',[UserController::class, 'logout']);
    Route::get('logout/all',[UserController::class, 'logout_all']);
});
Route::post('login_admin', [UserController::class, 'loginAdmin']);
Route::post('login', [UserController::class, 'login']);
Route::post('user', [UserController::class, 'store']);


///Payments With Paypal
Route::get('paypal/pago', [PaypalCreatePay::class,'CrearPago']);
Route::get('paypal/execute', [PaypalCreatePay::class,'EjecutarPago']);

Route::get('paypal/success', function(){ return "success"; } );