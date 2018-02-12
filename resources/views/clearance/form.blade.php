@extends('layouts.app')

@section('title')
	Clearance Form
@endsection

@section('content')
	<div class="container">
		<div class="col-md-6 col-md-offset-3">
		<h3 class="page-header">Clearance Form</h3>

		<div class="alert alert-important alert-warning">
			This form is only to be filled out in case the student's information is not in the
			system. 
			<strong>Filling out this form does not check if any of the
				information is valid</strong> (e.g. if student number entered matches the
			student's name).
		</div>

		{{ Form::open(array(
				'action' => 'ClearanceController@pdf',
				'method' => 'POST',
				'autocomplete' => 'off'
		)) }}


		<div class="form-group">
			{{ Form::label('student_name', 'Student\'s Name') }}
			{{ Form::text('student_name', null,
				array('class' => 'form-control', 
					  'placeholder' => 'Student\'s Name',
					  'required'
				  )) }}
		</div>

		<div class="form-group">
			{{ Form::label('student_number', 'Student Number') }}
			{{ Form::text('student_number', null,
				array('class' => 'form-control', 
					  'placeholder' => 'Example: 201512345',
					  'required',
					  'pattern' => '[0-9]{9}',
					  'maxlength' => '9',
					  'title' => 'Nine-digit student number'
				  )) }}
		</div>


		<div class="form-group">
			{{ Form::label('student_program', 'Degree Program') }}

			<select required name="student_program" class="form-control">
				<option value="" selected="selected"
			   disabled="disabled">Select one</option>

				@foreach(Program::all()->sortBy('name') as $program)
					<option value="{{$program->name}}">{{$program->name}}</option>
				@endforeach
			</select>
		</div>

		<div class="form-group">
			{{ Form::label('purpose', 'Purpose') }}

			<select required name="purpose" class="form-control" id="purpose-select">
				<option value="" selected="selected"
			   disabled="disabled">Select one</option>
				<option value="grad">Graduation</option>
				<option value="loa">Leave of Absence</option>
				<option value="transfer">Transfer</option>
				<option value="other">Other</option>
			</select>
			
		</div>
			<div class="form-group" id="request-text">
			</div>

		<div class="pull-right">
			{{ Form::reset('Reset', array('class' => 'btn btn-secondary',
				'id' => 'request-reset')) }}
			{{ Form::submit('Print PDF', array('class' => 'btn btn-success')) }}
		</div>
		{{ Form::close() }}


		</div>
	</div>
@endsection
