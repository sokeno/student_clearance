<?php

namespace App;

use App\AbstractUser;

class Staff extends AbstractUser
{
    public function department()
    {
        return $this->belongsTo('App\Department');
    }

    public function deficiencies()
    {
        return $this->hasMany('App\Deficiency');
    }

    public function posted_deficiencies()
    {
        return $this->deficiencies;
    }

    public function college()
    {
        return $this->department->college;
    }

    public function getSlugSourceAttribute()
    {
        return $this->name();
    }

    public function linkTo()
    {
        return "/staff/" . $this->slug;
    }
}
