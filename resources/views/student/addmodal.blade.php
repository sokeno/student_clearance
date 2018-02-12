
@hasRole("staff")
	<div class="container-fluid">
		<a class="btn btn-danger pull-right"
				data-toggle="modal"
				data-target="#add-deficiency-modal"
			>
			<span class="glyphicon glyphicon-plus"></span>
			Add Item
		</a>
	</div>
@php
	$staff = Staff::whereUserId(Auth::user()->id)->firstOrFail();
	$department = $staff->department;
@endphp
<div class="modal fade row" id="add-deficiency-modal">
	<div class="modal-dialog">
		<div class="modal-content col-xs-10">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					 aria-label="Close">
					  <span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title">Add Item</h3>
			</div>
				{{ Form::open([
					'method' => 'POST',
					'action' => ['DeficiencyController@store'],
				])}}

			<div class="modal-body">
				<div class="form-group">
					{{ Form::label('student', 'Student') }}
					{{ Form::text('student',
						$student->name(),
						array("class" => "form-control", "readonly")
					) }}
				</div>

				<div class="form-group">
					{{ Form::label('department', 'Department') }}
					{{ Form::text('department', $department->name,
						array("class" => "form-control", "readonly")
					) }}
				</div>
				
				<div class="form-group">
					{{ Form::label('staff_id', 'Staff') }}
					{{ Form::text('staff_id', $staff->name(),
						array("class" => "form-control", "readonly")
					) }}
				</div>
				
				<div class="form-group">
					{{ Form::label('title', 'Title') }}
					{{ Form::text('title', null,
						array("class" => "form-control", 
							"autocomplete" => "off",
							"placeholder" => "Title",
							"maxlength" => "140",
							"required", "autofocus")
					) }}
				</div>
				
				<div class="form-group">
					{{ Form::label('title', 'Note') }}
					{{ Form::textarea('note', null,
						array("class" => "form-control",
							  "placeholder" => "Additional information",
							"maxlength" => "255",
						)
					) }}
				</div>
			</div>
			<div class="modal-footer">
				{{Form::button("Reset",
					array("type" => "reset", "class" => "btn")
				)}}
				{{Form::button("Add Item",
					array("type" => "submit",
						"class" => "btn btn-success",
						"title" => "Submitting notifies the student via email",
						"data-toggle" => "tooltip"
					)
				)}}


				{{ Form::hidden("student_id", $student->student_number)}}
				{{Form::close()}}
			</div>
		</div>
	</div>
</div>

@endhasRole	
