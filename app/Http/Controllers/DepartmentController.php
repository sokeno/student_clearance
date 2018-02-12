<?php

namespace App\Http\Controllers;

use App\College;
use App\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function show($short_name)
    {
        $department = Department::whereShortName($short_name)->firstOrFail();

        return redirect('/college/'. $department->college->short_name . '/department/' . $department->short_name);
    }


    public function store()
    {
        $validated_request = request()->validate([
                            'name' => 'required',
                            'short_name' => 'required',
                            'college_id' => 'required'
                            ]);

        $dept = Department::create($validated_request);

        return redirect('/department/' . $dept->short_name);
    }
}
