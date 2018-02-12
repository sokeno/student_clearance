<?php

namespace App\Http\Middleware;

use App\Student;
use Closure;
use Illuminate\Support\Facades\Auth;

class StudentProfileMiddleware
{
    /**
     * The following are allowed to view a student profile:
     * admin
     * staff
     * a student can only view their own profile
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guest()) {
            abort(403);
		}

		$user = $request->user();

		if ($user->hasRole('staff') || $user->hasRole('admin')) {
			return $next($request);
		}

		if ($user->hasRole('student')) {
			$slug = $request->route('slug');

			$student = Student::whereUserId($user->id)->first();
			if ($student->student_number == intval($request->student)
				|| $student->student_number == intval($slug)
				) {
				return $next($request);
			}
			abort(403);
		}
	
    }
}
