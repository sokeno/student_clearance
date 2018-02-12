<?php

namespace App\Http\Controllers;

use App\Deficiency;
use App\Student;
use Illuminate\Http\Request;

class StudentDeficiencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('studentprofile');
    }

    public function show($student, $deficiency)
    {
        $student = Student::whereSlug($student)->firstOrFail();
        $deficiency = $student->deficiencies->find($deficiency);

        return view('student.deficiency', compact('deficiency', 'student'));
    }
}
