@extends('layouts.app')

@section('title')
	{{$program->name}}
@endsection

@section('content')
	<div class="container">
		<h3 class="page-header">{{$program->name}}</h3>
		<h4>
			<a href="/department/{{$program->department->short_name}}">
				{{$program->department->name}}
			</a>
		</h4>
		<h5>
			<a href="/college/{{$program->college()->short_name}}">
				{{$program->college()->name}}
			</a>
		</h5>

		<hr>
		<h4>Students</h4>
		<table class="table table-striped">
			<tr><th>Name</th> <th>Student Number</th> <th>Deficiencies</th></tr>
			@foreach($program->students as $student)
				<tr>
					<td><a href="{{$student->linkTo()}}">						
						{{$student->name()}}
					</a></td>
					<td>{{$student->student_number()}}</td>
					<td>{{$student->deficiencies->count()}}</td>
					
				</tr>
			@endforeach
		</table>
    </div>
@endsection
