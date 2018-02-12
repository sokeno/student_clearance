<h4 class="page-header">Basic Information</h4>
<table class="table table-striped">
	<tr><th>Name</th>
		<td><a href="{{$student->linkTo()}}">{{$student->name()}}</a></td>
		<td rowspan="5">
			<img src="{{$student->picture()}}" style="max-height: 180px; border: 2px solid #021a40;">
		</td>
	</tr>
	<tr><th>Student number</th><td>{{$student->student_number()}}</td></tr>
	
	<tr><th>Email</th><td>{{$student->email()}}</td></tr>
	<tr><th>Program</th>
		<td>
			<a href="/program/{{$student->program->short_name}}">
				{{$student->program->name}}
			</a></td>

		</tr>
		<tr>
			<th>Department</th>
			<td><a href="/department/{{$student->department()->short_name}}">
				{{$student->department()->name}}
			</a></td>
		</tr>
		<tr>
			<th>College</th>			
			<td><a href="/college/{{$student->college()->short_name}}">
				{{ $student->college()->name }}
			</a></td>

		</tr>

</table>
