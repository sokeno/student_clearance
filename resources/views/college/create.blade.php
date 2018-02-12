@extends('layouts.app')

@section('content')
	<div class="container">
		<h3 class="page-header">Add College</h3>

		{{ Form::open(['method' => 'POST', 'action' => 'CollegeController@store', 'class' => 'col-md-3']) }}

		{{ Form::token() }}
		<!-- College_name Form Input -->
		<div class="form-group">
			{!! Form::label('name',  'Name of college') !!}
			{!! Form::text('name', null, ['class' => 'form-control']) !!}
		</div>

		<!-- short_name Form Input -->
		<div class="form-group">
			{!! Form::label('short_name', 'Abbreviation') !!}
			{!! Form::text('short_name', null, ['class' => 'form-control']) !!}
		</div>

		<!-- Add College Form Input -->
		<div class="form-group">
			{!! Form::submit('Add College', ['class' => 'btn btn-primary form-control']) !!}
		</div>

		{{ Form::close()}}
	</div>
@endsection
