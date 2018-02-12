
<div class="col-md-8">
	<p>
        The current process of applying for a college clearance is tedious and time consuming. A college clearance has to be signed by the heads of every department. Most of the time, department heads are not in their respective offices. They have classes to teach or meetings to attend. Because of this, students requesting for college clearance are left with no choice but to wait for at least a few hours to have their college clearances issued.

This system aims to minimize that wait time. In a few clicks, students can have their clearance released.
    </p>
    
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
	
	


