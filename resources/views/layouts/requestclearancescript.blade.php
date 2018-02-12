@if(Auth::user())
	@php
		$current_sem = 1172;
	@endphp

	<script>
		$(document).ready(function(){
			function displaySem(sem){
				var start = Math.floor(sem / 10) + 1900;
				var x = sem%10;

				var y = "";
				switch(x){
					case 1: y = "First Semester"; break;
					case 2: y = "Second Semester"; break;
					case 3: y = "Summer"; break;
				}

				return "AY " + start + "-" + (start+1) + " " + y;
			}

			$("#request-reset").click(function(){
				$("#request-text").html("");
			});

			$("#purpose-select").on('change', function(){
				var purposeValue = this.value;

				var input = $("#request-text");
				switch(purposeValue){
					case 'grad':
						input.html('<input name="current-sem" type="hidden" id="current-sem" value="{{ $current_sem }}">' +
										'<label for="grad-text">Semester</label>' +
										'<div class="input-group">' +
										'<span class="input-group-btn">' +
											'<button type="button" id="grad-decrement"' +
												'class="btn btn-secondary">' +
											'<span class="glyphicon glyphicon-chevron-left"></span></button></span>' +
							'<p class="form-control" id="grad-sem-display">' + displaySem({{$current_sem}})+ '</p>'+
					'<span class="input-group-btn">' +
							'<button id="grad-increment" type="button" class="btn btn-secondary">'+
							'<span class="glyphicon glyphicon-chevron-right"></span></button></span></div>'
							); 

						$("#grad-decrement").click(function(){
							var currentValue = $("#current-sem").val();

							currentValue--;

							if(currentValue%10 == 0){
								currentValue -= 7;
							}

							$("#current-sem").val(currentValue);

							$("#grad-sem-display").html(displaySem(currentValue));
						});

						$("#grad-increment").click(function(){
							var currentValue = $("#current-sem").val();

							if(currentValue < {{ $current_sem }}){
								currentValue++;

								if(currentValue%10 == 4){
									currentValue += 7;
								}
							}

							$("#current-sem").val(currentValue);

							$("#grad-sem-display").html(displaySem(currentValue));
						});
					break;

					case 'loa':
						input.html('<input name="from-sem" type="hidden" id="from-sem" value="{{ $current_sem }}">' +
							'<input name="to-sem" type="hidden" id="to-sem" value="{{$current_sem+1}}">' + 
							'<div class="form-group"><label for="from-text">From</label>' +
										'<div class="input-group">' +
										'<span class="input-group-btn">' +
											'<button type="button" id="from-decrement"' +
												'class="btn btn-secondary">' +
											'<span class="glyphicon glyphicon-chevron-left"></span></button></span>' +
							'<p class="form-control" id="from-sem-display">' + displaySem({{$current_sem}})+ '</p>'+
					'<span class="input-group-btn">' +
							'<button id="from-increment" type="button" class="btn btn-secondary">'+
							'<span class="glyphicon glyphicon-chevron-right"></span></button></span></div></div>' +
							'<div class="form-group"><label for="from-text">To</label>' +
										'<div class="input-group">' +
										'<span class="input-group-btn">' +
											'<button type="button" id="to-decrement"' +
												'class="btn btn-secondary">' +
											'<span class="glyphicon glyphicon-chevron-left"></span></button></span>' +
							'<p class="form-control" id="to-sem-display">' + displaySem({{$current_sem+1}})+ '</p>'+
					'<span class="input-group-btn">' +
							'<button id="to-increment" type="button" class="btn btn-secondary">'+
							'<span class="glyphicon glyphicon-chevron-right"></span></button></span></div></div>' +
							'<p class="alert alert-info">Applicants for graduation,must ensure they pay the required graduation fee , prior to the approval of the Dean/College Secretary.</p>'
							);


							$("#from-decrement").click(function(){
								var fromSem = $("#from-sem").val();

								if(fromSem > {{ $current_sem }}){
									fromSem--;
								}
								
								if(fromSem%10 == 0){
									fromSem -= 7;
								}

								$("#from-sem").val(fromSem);
								$("#from-sem-display").html(displaySem(fromSem));
							});

							$("#from-increment").click(function(){
								var fromSem = $("#from-sem").val();
								var toSem = $("#to-sem").val();

								fromSem++;

								if(fromSem%10 == 4){
									fromSem += 7;
								}

								if(fromSem == toSem){
									toSem = fromSem+1;
								}

								if(toSem%10 == 4){
									toSem += 7;
								}

								$("#from-sem").val(fromSem);
								$("#from-sem-display").html(displaySem(fromSem));

								$("#to-sem").val(toSem);
								$("#to-sem-display").html(displaySem(toSem));
							});

							$("#to-decrement").click(function(){
								var toSem = $("#to-sem").val();
								var fromSem = $("#from-sem").val();

								toSem--;

								if(toSem%10 == 0){
									toSem -= 7;
								}

								if(toSem > fromSem){
									$("#to-sem").val(toSem);
									$("#to-sem-display").html(displaySem(toSem));
								}

							});

							$("#to-increment").click(function(){
								var toSem = $("#to-sem").val();

								toSem++;

								if(toSem%10 == 4){
									toSem += 7;
								}

								$("#to-sem").val(toSem);
								$("#to-sem-display").html(displaySem(toSem));
							});
					break;

					case 'transfer': 
							input.html('{{ Form::text("transfer-text", null,
							array("class" => "form-control",
								  "required",
								  "placeholder" => "Transfer to what institution?"
							)) }}');
					break;

					case 'other': 
							input.html('{{ Form::text("other-text", null,
							array("class" => "form-control",
								  "required",
								  "placeholder" => "Enter other reason"
							)) }}');
					break;

					default:
						input.html("");

				}


			});


		});
	</script>
@endif
