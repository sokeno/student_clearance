<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class College extends Model
{
    protected $fillable = ['name', 'short_name'];

    public function departments()
    {
        return $this->hasMany('App\Department');
    }

    /**
     * Collection of staff members from all departments
     * @return [type] [description]
     */
    public function staff()
    {
        $staff = new Collection;
        foreach ($this->departments as $department) {
            $staff->push($department->staff);
        }
        return $staff->collapse();
    }

    /**
     * Collection of programs from all departments
     *  in a college
     */
    public function programs()
    {
        $programs = new Collection;

        foreach ($this->departments as $department) {
            $programs->push($department->programs);
        }


        return $programs->collapse();
    }

    /**
     * Collection of students in a college
     */
    public function students()
    {
        $students = new Collection;

        foreach ($this->programs() as $program) {
            $students->push($program->students);
        }


        return $students->collapse();
    }

    public function linkTo()
    {
        return '/college/' . $this->short_name;
    }
}
