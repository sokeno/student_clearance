<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;

class TaskListController extends Controller
{
	public function index($departmentShortName)
	{
		$department = Department::whereShortName($departmentShortName)->firstOrFail();

		$taskLists = $department->task_lists;
		return view('department.tasklists', compact('taskLists'));
	}

	public function show($departmentShortName, $taskListSlug)
	{
		$taskLists = Department::whereShortName($departmentShortName)
						->firstOrFail()->task_lists
						->where('slug', $taskListSlug)
						->first();
		return $taskLists;
	}
	
	
}
