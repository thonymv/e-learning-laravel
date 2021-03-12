<?php

namespace App\Http\Middleware;

use Closure;

class CheckCourse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = auth()->user();
        $course_id = $request->route()->parameter('id');

        if (!$user->courses()->find($course_id)) {
            return response()->json([
                'message'=>'Unauthorized.'
            ],401);
        }
        
        return $next($request);
    }
}
