@extends('layouts.app')

@section('content')
	<div class="container">
		
		<h3 class="page-header">Add a Department to {{$college->name}}</h3>

		@include('errors.list')

		{{ Form::open(['method'=>'POST', 'action' => 'DepartmentController@store']) }}

		{{ Form::token() }}

		<input type="hidden" name="college_id" value="{{$college->id}}">
	

		<!-- Name Form Input -->
		<div class="form-group">
			{!! Form::label('name', 'Department name') !!}
			{!! Form::text('name', null, ['class' => 'form-control']) !!}
		</div>

		<div class="form-group">
			{!! Form::label('short_name', 'Abbreviation') !!}
			{!! Form::text('short_name', null, ['class' => 'form-control']) !!}
		</div>

		<!-- Add Department Form Input -->
		<div class="form-group">
			{!! Form::submit('Add Department', ['class' => 'btn btn-primary']) !!}
		</div>
		{{ Form::close() }}
		

    </div>
@endsection