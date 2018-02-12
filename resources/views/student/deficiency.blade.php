@extends('layouts.app')

@section('title')
	{{$student->name()}}
@endsection

@section('content')
<div class="container">
	@include('student.information')

	<h4 class="page-heading">Deficiency Information</h4>
	@include('errors.list')

	@include('flash::message')
	<table class="table table-striped">
		@if($deficiency)
		<tr>
			<th>Title</th>
			<td>{{$deficiency->title}}</td>	
		</tr>

		<tr>
			<th>Note</th>	
			<td>{{$deficiency->note}}</td>
		</tr>	

		<tr>
			<th>Department</th>
			<td>
				<a href="{{$deficiency->department->linkTo()}}">
					{{$deficiency->department->name}}
				</a>
			</td>
		</tr>

		<tr>
			<th>Staff</th>
			<td>
				<a href="{{$deficiency->staff->linkTo()}}">
					{{$deficiency->staff->name()}}
				</a>
			</td>
		</tr>

		<tr>
			<th>Posted On</th>
			<td>{{$deficiency->postDate()}}</td>
		</tr>

		<tr>
			<th>Updated on</th>
			<td>{{$deficiency->updateDate()}}</td>
		</tr>
		<tr>
			<th>Completion Status</th>
			<td>{{$deficiency->completionStatus()}}</td>
		</tr>

		@else
		<tr>
			<th>Item not found.</th>
		</tr>

		@endif

	</table>

	@userInSameDepartment($deficiency->department)
	<div class="container">
		<div class="pull-right">

			{{ Form::open([
				'method' => 'PATCH',
				'action' => ['DeficiencyController@complete', $deficiency->id],
				'style' => 'display: inline-block'])}}

			@if($deficiency->completed)
				{{ Form::button(
					'<span class="glyphicon glyphicon-remove"></span> Mark as incomplete',
					array('type' => 'submit',
						  'class' => 'btn btn-danger',
					)
				)}}
			@else 
				{{ Form::button(
					'<span class="glyphicon glyphicon-ok"></span> Mark as completed',
					array('type' => 'submit',
						  'class' => 'btn btn-success',
					)
				)}}
			@endif

			{{ Form::close() }}

			{{ Form::button(
				'<span class="glyphicon
				glyphicon-edit"></span> Edit item',

				array('class' => 'btn btn-info',
					'data-toggle' => 'modal',
					'data-target' =>
					'#edit-deficiency-'.$deficiency->id)
			
			) }}

			@include('student.editmodal')
		</div>
	</div>
	@enduserInSameDepartment
</div>
@endsection
