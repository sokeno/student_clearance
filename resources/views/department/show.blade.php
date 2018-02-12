@extends('layouts.app')

@section('title')
	{{$department->name}}
@endsection

@section('content')
	<div class="container">
		<h3>{{$department->name}}</h3>
		<h4>
			<a href="/college/{{$department->college->short_name}}">
				{{$department->college->name}}
			</a>
		</h4>

		<hr>
		<h4>Programs</h4>
		<table class="table table-striped">
			<tr>
				<th>Name</th> <th>Number of students</th>
			</tr>
			@foreach($department->programs as $program)
			<tr>
				<td><a href="/program/{{$program->short_name}}">
					{{$program->name}}
				</a></td>

				<td>
					{{$program->students->count()}}
				</td>
			</tr>
			@endforeach

			<tr>
				<th>Total</th>
				<td>{{$department->students()->count()}}</td>
			</tr>
		</table>

		<hr>
		<h4>Staff Members</h4>
		<table class="table table-striped">
			<tr>
				<th>Name</th>
				<th>Total Deficiencies Posted</th>
			</tr>
			@foreach($department->staff as $staff)
			<tr>
				<td><a href="{{$staff->linkTo()}}">
					{{$staff->name()}}
				</a></td>

				<td>{{$staff->deficiencies->count()}}</td>
			</tr>
			@endforeach

		</table>


		<h3 class="page-header">Task Lists</h3>
		@foreach($department->task_lists as $taskList)
			<h4><a href="{{$taskList->linkTo()}}">{{$taskList->title}}</a></h4>

			<table class="table table-striped">
					<tr><th>Title</th>
					<th>Note</th></tr>
				@foreach($taskList->task_list_items as $item)
					<tr>
						<td><a href="{{$item->linkTo()}}">{{$item->title}}</a></td>
						<td>{{$item->note}}</td>
					</tr>
				@endforeach
			</table>
		@endforeach

    </div>
@endsection
