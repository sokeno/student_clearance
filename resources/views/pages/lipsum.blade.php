
<div class="col-md-8">
	{{--  {{ HTML::image('imgages/jkuat.jpg', 'a picture') }}  --}}
	<img src="{{URL::asset('images/jkuat.jpg')}}"/>
    
</div>
<div  class="col-md-4">

	<div class="content-agileits">
		<h1 class="title">Login</h1>
		<div class="left">
			<form method="POST" action="{{ URL('\login')}}" data-toggle="validator">
                    {{ csrf_field() }}
				
				<div class="form-group">
					<label for="inputEmail" class="control-label">Email:</label>
					<input type="email" class="form-control" id="email" name="email" placeholder="Email" data-error="This email address is invalid" required>
					<div class="help-block with-errors"></div>
				</div>
				
				<div class="form-group">
					<label for="inputPassword" class="control-label">Password:</label>
					
						
							<input type="password"class="form-control" id="password" name="password" placeholder="Password" required>
							<div class="help-block">Minimum of 6 characters</div>
						
						
					
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-lg">submit</button>
				</div>
			</form>
		</div>
		<div class="right"></div>
		<div class="clear"></div>
    </div>
</div>
	
	


