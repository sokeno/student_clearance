
@hasRole("student")
<div class="modal fade row" id="request-clearance-modal">
	<div class="modal-dialog">
		<div class="modal-content col-xs-10">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"
					 aria-label="Close">
					  <span aria-hidden="true">&times;</span>
				</button>
				<h3 class="modal-title">Request Clearance</h3>
			</div>
				{{ Form::open([
					'method' => 'POST',
					'action' => ['ClearanceController@requestClearance'],
					'autocomplete' => 'off'
				])}}


			<div class="modal-body">
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
			</div>
			<div class="modal-footer">
				{{Form::button("Reset",
					array("type" => "reset", "class" => "btn", "id" =>
					"request-reset")
				)}}
				{{Form::button("Submit Request",
					array("type" => "submit",
						"class" => "btn btn-success",
					)
				)}}

				{{Form::close()}}
			</div>
		</div>
	</div>
</div>

@endhasRole	
