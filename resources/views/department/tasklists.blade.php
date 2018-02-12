@extends('layouts.app')

@section('content')
	<div class='container'>
		<h4 class="page-header">Task Lists for
			{{$taskLists->first()->department->name}}</h4>
		@foreach($taskLists as $taskList)
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
