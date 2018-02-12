<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractUser extends Model
{
    use Sluggable;

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slugSource',
                'onUpdate' => true
            ],
        ];
    }

    public function name()
    {
        return $this->user->name;
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function email()
    {
        return $this->user->email;
    }

    public function roles()
    {
        return $this->user->roles;
    }

	public function avatar()
	{
		$avatar = $this->user->avatar;

		if($avatar)
			return $avatar;

		return $this->picture();
	}
	
	
    /**
     * URI to studet's ID photo
     */
    public function picture()
    {
		$file = public_path() . '/images/id/' . $this->slug . '.jpg';
		if(file_exists($file)){
			return '/images/id/' . $this->slug . '.jpg';
		}
        return asset('images/id/default.png');
    }

    abstract public function department();
    abstract public function college();
    abstract public function getSlugSourceAttribute();
    abstract public function linkTo();
}
