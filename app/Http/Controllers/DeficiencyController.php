<?php

namespace App\Http\Controllers;

use App\Deficiency;
use App\Staff;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class DeficiencyController extends Controller
{
    public function __construct()
    {
        $this->middleware('studentprofile');
    }


    //Triggered when authorized user clicks "complete" button
    public function complete($id)
    {
        $def = Deficiency::findOrFail($id);
	
        //Flash notification confirming user's action
		$flash_message = 
			"Deficiency <strong>" 
			. $def->title . "</strong> updated.";

		$def->checkDepartmentAndFlashMessage($flash_message);

        $def->completed = !$def->completed;
        $def->save();

		if($def->completed)
			$log_message = "Marked deficiency as completed.";
		else
			$log_message = "Marked deficiency as incomplete.";

        //Log action
        activity()
            ->performedOn($def)
            ->causedBy(Auth::user())
            ->withProperties(['completed' => $def->completed])
			->log($log_message);

        //Redirect
        $previous = URL::previous() . "#def";
        return redirect()->away($previous);
    }


	public function update($id)
	{
		$def = Deficiency::findOrFail($id);

        //Flash notification confirming user's action
		$flash_message = "Item <strong>". request()->get('title') . "</strong> edited";

		$def->checkDepartmentAndFlashMessage($flash_message);

		$validatedRequest = request()->validate([
			'title' => 'required',
			'note' => 'nullable',
			'staff_id' => 'required'
		]);


		$def->update($validatedRequest);

		activity()
			->performedOn($def)
			->causedBy(Auth::user())
			->withProperties(['title' => $def->title, 'note' => $def->note])
			->log('Edited deficiency item');

		return redirect()->back();
	}


    public function store()
    {
		$staff = Staff::whereUserId(Auth::user()->id)->firstOrFail();

		$validatedRequest = request()->validate([
			'title' => 'required',
			'note' => 'nullable',
			'student_id' => 'digits:9',
		]);

		$student = Student::whereStudentNumber($validatedRequest['student_id'])
			->firstOrFail();
		$validatedRequest['student_id'] = $student->id;
		$validatedRequest['staff_id'] = $staff->id;
		$validatedRequest['department_id'] = $staff->department_id;

		$def = Deficiency::create($validatedRequest);

		$flash_message = "Item successfully added";
		$def->checkDepartmentAndFlashMessage($flash_message);

		return redirect()->back();
	}

	
}
