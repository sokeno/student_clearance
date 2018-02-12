<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function students()
    {
        return $this->hasMany('App\Student');
    }

    public function college()
    {
        return $this->department->college;
    }
}
