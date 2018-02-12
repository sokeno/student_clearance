@extends('layouts.app')

@section('content')
	
	<div class="container">
		<div class="container">

			Showing results for <kbd>{{ request()->get('q') }}</kbd>
			<br/>
			{{ $students->count()==1? "One record found" : $students->count() .
				" records found." }}
		</div>
	@if($students->count() > 0)
		<div class="list-group">
			@foreach($students as $student)
				<a href="{{$student->linkTo()}}" class="col-8 list-group-item">
					<img class="student-result-img pull-right" src="{{$student->picture()}}"/>
					<div class="student-result-name">{{ $student->name() }}</div>
					<div class="student-result-number">{{ $student->student_number() }}</div>
					<div class="student-result-program">{{ $student->program->name }}</div>
					<div class="student-result-email">{{ $student->email() }}</div>
				</a>
			@endforeach
		</div>
	@endif

	</div>

@endsection

@section('title')
	Search results
@endsection
