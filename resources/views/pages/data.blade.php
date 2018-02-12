<ul>
	@foreach($data as $college)
		<li>{{$college->name}}</li>

		<ul>
			@foreach($college->students() as $student)
				<li>{{$student->name()}}</li>
			@endforeach
		</ul>

	@endforeach
</ul>