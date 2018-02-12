@extends('layouts.app')

@section('content')

<script>
	document.title = 'Logs - ' + document.title;
</script>
<div class="container">

	<h3 class="page-heading">Logs</h3>

	<table class="table table-striped">
		<tr>
			<th>Causer</th>
			<th>Action</th>
			<th>Subject</th>
			<th>Student</th>
			<th>Time</th>	
		</tr>

		@foreach($logs as $log)
			<tr>
				<td><a
					href="{{Staff::whereUserId($log->causer->id)
						->first()->linkTo()}}">{{$log->causer->name}}
					</a>
				</td>
				<td>{{$log->description}}</td>
				<td>
					<a href="{{$log->subject->linkTo()}}">
						{{$log->subject->title}}
					</a>
				</td>

				<td>
					@if(isset($log->subject->student))
						<a href="{{$log->subject->student->linkTo()}}">
							{{$log->subject->student->name()}}
						</a>
					@endif
				</td>
				<td>{{$log->created_at->toDayDateTimeString()}}</td>
			</tr>
		@endforeach	
		
	</table>
</div>
@endsection
