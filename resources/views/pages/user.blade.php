@extends('layouts.app')

@section('content')
<div class="container">
	@if($user = Auth::user())
	Logged in user:
	<br>
	{{$user->name}}
	<br>
	Roles:
	<ul>
		@foreach($user->roles as $role)
		<li>{{$role->name}}</li>
		@endforeach
	</ul>
	@else
	Guest
	@endif
</div>
@endsection