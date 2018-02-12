<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use niklasravnsborg\LaravelPdf\Facades\Pdf as PDF;
use App\Student;

class ClearanceController extends Controller
{
	public function requestClearance()
	{
		$student = Student::where('user_id', Auth::user()->id)->firstOrFail();


		$student->purpose = $this->getPurposeStr();
		$student->save();

		//log clearance request activity
        activity()
            ->performedOn($student)
            ->causedBy($student)
            ->withProperties(['purpose' => $student->purpose])
			->log("Requested college clearance");
		
		//redirect
		return redirect()->back();
	}


	public function semesterText($sem)
	{
		$start = floor($sem/10) + 1900;
		$x = $sem%10;

		switch($x){
			case 1: $y = "First Semester"; break;
			case 2: $y = "Second Semester"; break;
			case 3: $y = "Summer"; break;
		}

		return "AY " . $start . "-" . ($start+1) . " " . $y;
	}
	
	public function form()
	{
		$current_sem = 1172;
		return view('clearance.form', compact('current_sem'));
	}

	public function getPurposeStr()
	{
		
		$purpose = request()->get('purpose');

		switch($purpose){
			case 'loa': 
				$purpose_str = 'Leave of Absence: from '
					. $this->semesterText(request()->get('from-sem')) 
					. ' to ' . $this->semesterText(request()->get('to-sem'));
			break;

			case 'grad': 
				$purpose_str = 'Graduation: '
					. $this->semesterText(request()->get('current-sem'));
			break;

			case 'transfer': 
				$purpose_str = 'Transfer to: ' . request()->get('transfer-text');
			break;

			case 'other': 
				$purpose_str = 'Other: ' . request()->get('other-text');
			break;
		}

		return $purpose_str;
	}
	
    public function pdf()
    {

		$student['from_blank_form'] = true;
		$student['name'] = request()->get('student_name');
		$student['program'] = request()->get('student_program');
		$student['purpose'] = $this->getPurposeStr();
		$student['deficiencies'] = [];

		$year = floor(request()->get('student_number') / 100000);
		$num = request()->get('student_number') % 100000;

		$student['student_number'] = $year . '-' . str_pad($num, 5, '0', STR_PAD_LEFT);

		$file_name = $student['student_number'] . "-clearance.pdf";

        $paperSize = 'a4';
        $orientation = 'portrait';
        $pdf = PDF::loadView('student.pdf', compact('student', 'file_name'));

		activity()
			->causedBy(Auth::user())
			->log('Filled out blank clearance form for ' . $student['name']);

        return $pdf->stream($file_name);
    }
	
}
