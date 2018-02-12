<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class TaskList extends Model
{
	use Sluggable;

	public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true
            ],
        ];
    }

	public function task_list_items()
	{
		return $this->hasMany('App\TaskListItem');
	}
	
	public function department()
	{
		return $this->belongsTo('App\Department');
	}

	public function getSlugSourceAttribute()
	{
		return $this->title;
	}

	public function linkTo()
	{
		return $this->department->linkTo() . '/tasks/' . $this->slug;
	}
	
	
}
