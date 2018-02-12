
<div class="modal fade row" id="edit-deficiency-{{$deficiency->id}}">
	<div class="modal-dialog">
		<div class="modal-content col-xs-10">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					 aria-label="Close">
					  <span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title">
					Edit Deficiency Information
				</h3>
			</div>
				{{ Form::open([
					'method' => 'PATCH',
					'action' => ['DeficiencyController@update', 
								$deficiency->id],
							])}}

			<div class="modal-body">
				<div class="form-group">
					{{ Form::label('department_id', 'Department') }}
					{{ Form::text('department_id',Department::find($deficiency
						->department_id)->name,
						array("class" => "form-control", "readonly")
					) }}
				</div>
				
				<div class="form-group">
					{{ Form::label('staff_id', 'Staff') }}

					<select id="staff_id" name="staff_id" class="form-control">

						@foreach(Department::find($deficiency->department_id)->staff->sortBy('user.name') as $staff)
							<option value="{{$staff->id}}"
			   {{$staff->id == $deficiency->staff_id?"selected":""}}>
							{{$staff->name()}}
							</option>

						@endforeach
					</select>
				</div>
				
				<div class="form-group">
					{{ Form::label('title', 'Title') }}
					{{ Form::text('title', $deficiency->title,
						array("class" => "form-control", 
							"autocomplete" => "off",
							"placeholder" => "Title",
							"maxlength" => "140",
							"required", "autofocus")
					) }}
				</div>
				
				<div class="form-group">
					{{ Form::label('note', 'Note') }}
					{{ Form::textarea('note', $deficiency->note,
						array("class" => "form-control",
							  "maxlength" => "255",
							  "placeholder" => "Additional information"
						)
					) }}
				</div>
			</div>
			<div class="modal-footer">
				{{Form::button("Reset",
					array("type" => "reset", "class" => "btn")
				)}}
				{{Form::button("Save Changes",
					array("type" => "submit",
						"class" => "btn btn-success",
						"title" => "Submitting notifies the student via email",
						"data-toggle" => "tooltip"
					)
				)}}
				{{Form::close()}}
			</div>
		</div>
	</div>
</div>

