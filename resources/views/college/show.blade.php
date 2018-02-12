@extends('layouts.app')

@section('title')
	{{$college->name}}
@endsection

@section('content')

	
	<div class="container">

		<h3>{{$college->name}}</h3>

		<h4>Departments</h4>
		<table class="table table-striped">
			<tr><th>Name</th> <th>Number of Programs</th> <th>Total students</th> <th>Staff Members</th>
			
				@foreach($college->departments as $department)
				<tr>
					<td><a href="/department/{{$department->short_name}}">
						{{$department->name}}
					</a></td>

					<td>{{$department->programs->count()}}</td>
					<td>{{$department->students()->count()}}</td>
					<td>{{$department->staff()->count()}}</td>
				</tr>
				@endforeach

				<tr>
					<th>Total</th>
					<td>{{$college->programs()->count()}}</td>
					<td>{{$college->students()->count()}}</td>
					<td>{{$college->staff()->count()}}</td>
				</tr>
		</table>
    </div>
@endsection
