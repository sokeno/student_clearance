@extends('layouts.app')

@section('content')
	<div class="container">
		@guest()
		<a class="btn btn-lg btn-success" href="{{ route('glogin') }}">
			<span class="glyphicon glyphicon-log-in"></span>
			&nbsp;&nbsp; Sign in with UP Mail</a>
		@endguest

		@include('pages.lipsum')
	</div>
@endsection


@section('title')
	Google
@endsection
