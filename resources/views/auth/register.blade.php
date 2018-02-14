@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Student Register</div>
                

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ URL('/register') }}">
                        {{ csrf_field() }}
                        {{ Form::hidden('role', 'student') }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>


                        <div class="form-group {{ $errors->has('student_number') ? ' has-error' : '' }} ">
                            <label for="student_number" class="col-md-4 control-label">Student ID</label>

                            <div class="col-md-6">
                                <input id="student_number" type="text" class="form-control" name="student_number" placeholder= "id should be 9 digits" required>
                                @if ($errors->has('student_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('student_number') }}</strong>
                                </span>
                            @endif

                            </div>
                        </div>

                        <div class="form-group">
		                     
                            <label for="program" class="col-md-4 control-label">Program</label>
                            
                            <div class="col-md-6">
		                        <select name="program" id="basic" class="selectpicker show-tick form-control" data-live-search="true">
										@foreach($program_list as $program)  
										<option value="{{$program->id}}">{{$program->name}}</option>
										
										@endforeach
										  
                                </select>
                            </div>
		                     
                		</div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                                
                            </div>
                        </div>
                    </form>
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
