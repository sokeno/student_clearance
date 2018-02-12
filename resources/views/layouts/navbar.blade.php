
<nav class="navbar navbar-default navbar-static-top" role="navigation">
	<div class="container">
		<div class="navbar-header">

			<!-- Collapsed Hamburger -->
			<button type="button" class="navbar-toggle collapsed" 
				data-toggle="collapse" data-target="#app-navbar-collapse" 
				aria-expanded="false">

				<span class="sr-only">Toggle Navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<!-- Branding Image -->
			<a class="navbar-brand" href="{{ url('/') }}">
				{{ config('app.name', 'JKUAT CLEARANCE SYSTEM') }}
			</a>

			@if(!Auth::guest())
				@if(Auth::user()->hasRole('staff'))
					{{ Form::open(
						array('method' => 'GET',
							  'route' => 'search',
							  'onsubmit' => 'return validateSearch();'
					))}}
					<div id="search-bar" class="input-group">

						{{ Form::text('q', null,
							array('placeholder' => 'Search',
								  'class' => 'form-control',
								  'id' => 'search_text',
								  'autocomplete' => 'off',
								  )
						)}}

					  <span class="input-group-btn">
						{{ Form::button('<span class="glyphicon
							glyphicon-search"></span>',
							array('class' => 'btn btn-secondary',
								  'type' => 'submit')
						)}}
					  </span>
					</div>
						{{ Form::close() }}

				@endif
			@endif
		</div>

		<div class="collapse navbar-collapse" id="app-navbar-collapse">
			<!-- Left Side Of Navbar -->
			<ul class="nav navbar-nav">

				<li class="nav-item {{ active(["index"])}}
				"><a href="{{ URL("/") }}"
						class="nav-link">Home</a></li>

				@if(!Auth::guest())
					@if(Auth::user()->hasRole('student'))
						<li class="nav-item {{ active(["student/"])}}">
					@elseif(Auth::user()->hasRole('staff'))
						<li class="nav-item 
							{{--  {{active(["staff/" . 
								Staff::whereUserId(Auth::user()->id)
								->first()->slug
							])}}  --}}
						">
					@endif
						<a href="/profile"
							class="nav-link">Profile</a></li>
				@endif

				<li class="nav-item {{ active(["about"]) }}">
					<a href="/about" class="nav-link">About</a></li>


				<li class="dropdown" role="presentation">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#"
					   role="button" aria-haspopup="true" area-expanded="false">
						External links <span class="caret"></span>

						<ul class="dropdown-menu">
							<li class="nav-item">
							<a target="_blank"
								href="http://www.jkuat.ac.ke/">JKUAT Website</a>
							</li>
							<li class="nav-item">
							<a target="_blank"
								href="http://www.jkuat.ac.ke/">Computer Science Website</a>
							</li>
							{{--  <li class="nav-item">
							<a target="_blank" href="https://sais.up.edu.ph/">SAIS</a>
							</li>  --}}
						</ul>
				</li>
			</ul>

			<!-- Right Side Of Navbar -->
			<ul class="nav navbar-nav navbar-right">
				<!-- Authentication Links -->
				@guest
					<li><a href="{{ URL('\login') }}">Login</a></li>
					<li><a href="{{ URL('\register') }}">Student Register</a></li>
					<li><a href="{{ URL('\staff_register') }}">Staff Register</a></li>
					
					
					
				@else
							

					<li class="dropdown">
						<a href="#" id="avatar-link" 
							class="dropdown-toggle" 
							data-toggle="dropdown" role="button" 
							aria-expanded="false" 
							aria-haspopup="true">

							<img class="avatar" 
								@if(Auth::user()->hasRole('student'))
									{{--  src="{{Student::whereUserId(Auth::user()->id)
										->first()->avatar()}}"  --}}
								@else
									{{--  src="{{Staff::whereUserId(Auth::user()->id)
										->first()->avatar()}}"  --}}
								@endif
							/>

							{{ Auth::user()->name }} <span class="caret"></span>
						</a>

						<ul class="dropdown-menu">
							<li>
								<a href="{{ URL('\logout') }}"
									onclick="event.preventDefault();
											 document.getElementById('logout-form').submit();">
									Logout
								</a>

								<form id="logout-form" 
									action="{{ URL('logout') }}" 
									method="POST" style="display: none;">
									{{ csrf_field() }}
								</form>
							</li>
						</ul>
					</li>
				@endguest
			</ul>
		</div>
	</div>
</nav>
