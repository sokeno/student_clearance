<?php

namespace App\Http\Controllers;

use App\College;
use App\Department;
use Illuminate\Http\Request;

class CollegeDepartmentController extends Controller
{
    public function show($college, $department)
    {
        $department = College::whereShortName($college)->firstOrFail()->departments->where('short_name', $department)->first();

        if ($department) {
            return view('department.show', compact('department'));
        }

        abort(404);
    }

    public function create($college)
    {
        $college = College::whereShortName($college)->firstOrFail();

        return view('department.create', compact('college'));
    }
}
