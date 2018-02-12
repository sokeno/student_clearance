<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
                'college_id',
                'short_name',
                'name'
                ];

    public function college()
    {
        return $this->belongsTo('App\College');
    }

    public function programs()
    {
        return $this->hasMany('App\Program');
    }

    public function staff()
    {
        return $this->hasMany('App\Staff');
    }

	public function linkTo()
	{
		return 	"/department/" . $this->short_name;
	}
	
	public function task_lists()
	{
		return $this->hasMany('App\TaskList');
	}
	

    /**
     * Collection of students from all programs
     *  in a department
     */
    public function students()
    {
        $students = new Collection;

        foreach ($this->programs as $program) {
            $students->push($program->students);
        }


        return $students->collapse();
    }
}
