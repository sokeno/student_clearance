<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Deficiency extends Model
{
	protected $guarded = [];


    public function student()
    {
        return $this->belongsTo('App\Student');
    }

    public function staff()
    {
        return $this->belongsTo('App\Staff');
    }

    public function postedBy()
    {
        return $this->staff->name();
    }

    public function department()
    {
        return $this->belongsTo('App\Department');
    }

	
    /*
        Returns the post date of a deficiency,
        converted to a device's local timezone
        and formatted to a readable format
     */
    public function postDate()
    {
        return $this->created_at->toFormattedDateString();
    }

    public function postDateTime()
    {
        return $this->created_at->toDayDateTimeString();
    }

	public function updateDate()
	{
		return $this->updated_at->toFormattedDateString();
	}
	
	public function updateDateTime()
	{
		return $this->updated_at->toFormattedDateTimeString();
	}

    public function completionStatus()
    {
        return $this->completed? "Complete" : "Incomplete";
    }

    public function userInSameDepartment()
    {
        $user = Auth::user();

        if (!$user) {
            abort(403);
        }

        $staff = Staff::whereUserId($user->id)->firstOrFail();

        return $this->department == $staff->department;
    }

    public function linkTo()
    {
        return $this->student->linkTo() . "/deficiency/" . $this->id;
    }


	public function checkDepartmentAndFlashMessage($success_message)
	{
		
        if (!$this->userInSameDepartment()) {
			$fail_message = 
				"Sorry. You do not have permission to perform that action.";
            flash($fail_message)->error()->important();

            return redirect()->back();
        }

        flash($success_message)->success()->important();
	}
}
