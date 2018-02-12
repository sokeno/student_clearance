<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class TaskListItemController extends Controller
{
	public function show($departmentShortName, $taskListSlug, $taskListItemSlug)
	{
		$taskListItem = Department::whereShortName($departmentShortName)->firstOrFail()
			->task_lists->where('slug', $taskListSlug)->first()
			->task_list_items->where('slug', $taskListItemSlug)->first();

		return $taskListItem;
	}
	
}
