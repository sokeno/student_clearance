<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class TaskListItem extends Model
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

	public function task_list()
	{
		return $this->belongsTo('App\TaskList');
	}

	public function department()
	{
		return $this->task_list->department;
	}

	public function linkTo()
	{
		return $this->task_list->linkTo() . '/items/' . $this->slug;
	}
	
}
