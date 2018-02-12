@if(!Auth::guest())
	@if(Auth::user()->hasRole('staff'))
		<script>
		
			function validateSearch(){
				var searchText = document.getElementById("search_text");

				//don't submit if search_text is empty
				return (searchText.value.trim().length > 0);
			}

			//enable autocomplete through typeahead.js
			jQuery(document).ready(function($){
				// Set the options for Bloodhound suggestion engine

				var engine = new Bloodhound({
					datumTokenizer: function(data){
						return data;
					},
					
					queryTokenizer: function(data){
						return data;
					},

					remote: {
						 url: '{{route("autocomplete") }}?q=%QUERY%',
						 wildcard: '%QUERY%'
					},

				});

				$("#search_text").typeahead({
					hint: true,
					highlight: true,
					minLength: 3,
				},

				{
					source: engine.ttAdapter(),
					display: function(data){
						return data.user.name;
						},

					// This will be appended to "tt-dataset-" to form the class name
					// suggestion menu

					// the key from the array to display

					templates: {
						empty: [
							'<div class="list-group search-results-dropdown"> <div class="list-group-item">No results found.</div> </div>'
						],

						suggestion: function(data){
							var email = data.user.email;
							var name = data.user.name;
							var program = data.program.name;
							var slug = data.slug;
							
							var year = Math.floor(data.student_number / 100000);
							var num = data.student_number % 100000;

							num = num.toString();

							while(num.length<5){
								num = "0" + num;
							}

							var student_number = year + '-' + num;
							var avatar = data.user.avatar;

							return '<a class="list-group-item" href="/student/' + slug + '">' +
									'<img class="col-3 pull-right student-result-img" src="' + avatar +'">' + 
									'<div class="col-9 student-result-name">' + name + '</div>' + 
										'<div class="student-result-number">' + student_number + '</div>' + 
										'<div class="student-result-program">' + program + '</div>' +
										'<div class="student-result-email">' + email + '</div>' + 
								'</div>' + 
							'</a>';


						},

						pending: [ '<div class="list-group search-results-dropdown"><div class="list-group-item pending-search">Searching<span class="loader"></span></div> </div>']
					}

				});

			});
	</script>
	@endif
@endif
