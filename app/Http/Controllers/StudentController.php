<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use niklasravnsborg\LaravelPdf\Facades\Pdf as PDF;
use Illuminate\Support\Carbon;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('studentprofile');
    }

    public function show($slug, Request $request)
    {
        $items_per_page = 5;
        $student = Student::whereSlug($slug)->first();

        if ($student) {
            //column sort
            if ($request->has('sort')) {
                switch ($request->input('sort')) {
                case "department":
                    $sort = "dept_short_name";
                    break;
                case "staff":
                    $sort = "staff_slug";
                    break;
                case "date":
                    $sort = "created_at";
                    break;
                case "title":
                    $sort = "title";
                    break;
                case "date":
                default:
                $sort = "created_at";
                }
            } else {
                $sort = "created_at";
            }

            if ($request->has('order')) {
                switch ($request->input('order')) {
                case "asc":
                    $order = "asc";
                    break;
                case "desc":
                default:
                $order = "desc";
                }
            } else {
                $order = "desc";
            }

			$deficiencies = $student
					->deficienciesForShow($sort, $order, $items_per_page);

            $sort = $request->input('sort');
            $order = $request->input('order');

            if ($deficiencies->count() == 0) {
                $flash_message = "No entries found. Student can proceed to OCS for clearance.";
                flash($flash_message)->success()->important();
            }

            return view('student.show',
                        compact(['student', 'deficiencies', 'sort', 'order']));
        }//end if($student)

        // Only evaluates the first numeric part (student number)
        // everything that comes after the student number is ignored
        // redirect to the proper slug with
        // 20XXXXXXX-first-last format
        // HTTP 404 error if no student is found
        $student_number = intval($slug);
        $student = Student::whereStudentNumber($student_number)->firstOrFail();
        return redirect()->action('StudentController@show',
                                 ['slug' => $student->slug]);
    }


    public function pdf($slug)
    {
        $paperSize = 'a4';
        $orientation = 'portrait';

        $student = Student::whereSlug($slug)->first();

		/* When saved, the PDF file generated will have a name with the format */
		/* 2010-john-doe-01012085945.pdf */
		$format = "mdyhis";
		$file_name = $student->slug . "-".
					Carbon::now()->format($format) . ".pdf";

        $pdf = PDF::loadView('student.pdf', compact('student', 'file_name'));

		activity()
			->performedOn($student)
			->causedBy(Auth::user())
			->log('Generated clearance PDF for student ' . $student->name());

        return $pdf->stream($file_name);
    }
}
