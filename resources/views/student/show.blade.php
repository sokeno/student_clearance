@extends('layouts.app')

@section('title')
	@if(isset($student))
		{{$student->name()}}
	@endif
@endsection

@section('content')
	<div class="container">

		@if(isset($student))

			@include('student.information')

			@include('flash::message')

			@if($student->purpose)
				<div class="alert alert-success alert-important">
					Requested Clearance with purpose:
					<strong>{{ $student->purpose }}</strong>
				</div>
			@endif

			<h4 class="page-header">
				Deficiencies

			@hasRole('staff')
				
				<a target="_blank" 
					href="{{$student->linkTo()}}/pdf" 
					class="btn btn-success">
					<span class="glyphicon glyphicon-print"></span>
				 Print Clearance</a>
			@endhasRole

			</h4>


			@hasRole('student')
			<button data-toggle="modal" data-target="#request-clearance-modal"
					class="btn btn-success">
					<span class="glyphicon glyphicon-alert"></span>
				 Request Clearance
			</button>

				@include('student.requestmodal')
			@endhasRole


			@include('errors.list')

			<div id="def">
				<table class="table table-striped def-table">
					<tr>

						<th class="trunc dept-header">
							<a href="{{ url()->current() 
								. "?sort=department&page=1&order="}}
							@if($sort=="department" && $order=="asc")
								desc
							@else
								asc
							@endif
							#def">Department
							@if($sort=="department")
								@include('helpers.sorticons')
							@endif
							</a>
						</th>

						<th class="trunc title-header">
							<a href="{{ url()->current()
								. "?sort=title&page=1&order="}}
							@if($sort=="title" && $order=="asc")
								desc
							@else
								asc
							@endif
							#def">Title
							@if($sort=="title")
								@include('helpers.sorticons')
							@endif
							</a>
						</th>

						<th class="staff-header trunc">
							<a href="{{ url()->current() 
								. "?sort=staff&page=1&order="}}
							@if($sort=="staff" && $order=="asc")
								desc
							@else
								asc
							@endif
							#def">Posted By
							@if($sort=="staff")
								@include('helpers.sorticons')
							@endif
							</a>
						</th>

						<th class="date-header trunc">
							<a href="{{ url()->current() 
								. "?sort=date&page=1&order="}}
							@if($sort=="date" && $order=="asc")
								desc
							@else
								asc
							@endif
							#def">Posted On
							@if($sort=="date")
								@include('helpers.sorticons')
							@endif

							</a>
						</th>
						<th class="hidden-xs action-header trunc">
						@hasRole('staff')	
							Actions
						@endhasRole
						</th>
					</tr>

					@foreach($deficiencies as $deficiency)

						<tr>
							<td title="{{$deficiency->dept_name}}"
								class="trunc"
								data-toggle="tooltip">
							@hasRole('staff')
								<a 
									href="/department/{{$deficiency
															->dept_short_name}}">
							@endhasRole
								{{ $deficiency->dept_name }}

							@hasRole('staff')
								</a>
							@endhasRole
							</td>
							<td data-toggle="tooltip" class="trunc"
								title="{{$deficiency->title}}">
								<a href="{{Deficiency::find($deficiency->id)
															->linkTo()}}">						
														{{$deficiency->title}}
								</a>					
							</td>

							<td class="trunc">
								<a href="{{Staff::find($deficiency->staff_id)
												->linkTo()}}">
								{{str_limit(Staff::find($deficiency->staff_id)
												->name(), 20)}}
								</a>
							</td>

							<td title="{{ Deficiency::find($deficiency->id)
													->postDateTime() }}" 
								data-toggle="tooltip" class="trunc">
								{{ Deficiency::find($deficiency->id)
								->postDate() }}

							</td>

							<td class="hidden-xs trunc">
								@userInSameDepartment(Department::find($deficiency
																->department_id))
								{{ Form::open([
									'method' => 'PATCH',
									'action' => ['DeficiencyController@complete', 
												$deficiency->id],
									'style' => 'display: inline-block'
											])}}

								{{ Form::button('<span class="glyphicon 
												glyphicon-ok"></span>', 
												array('type' => 'submit', 
												'class' => 'btn btn-success
															btn-xs',
												'data-toggle' => 'tooltip',
												'title' => 'Mark as completed'
								)) }}	

								{{ Form::close() }}

								<span data-toggle="tooltip" title="Edit item">
								{{ Form::button(
									'<span class="glyphicon
									glyphicon-edit"></span>',

									array('class' => 'btn btn-xs btn-info',
										'data-toggle' => 'modal',
										'data-target' =>
										'#edit-deficiency-'.$deficiency->id)
								
								) }}

								</span>

								@include('student.editmodal')

								@enduserInSameDepartment
							</td>
						</tr>

					@endforeach

				</table>

				<div class="pagination-links pull-right">			
				{{ $deficiencies->appends(['sort' => $sort, 'order' => $order])
								->fragment('def')->links() }}
						@include('student.addmodal')
				</div>		
			</div>

	@endif
	</div>

@endsection
