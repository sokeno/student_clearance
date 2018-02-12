@extends('layouts.app')

@section('title')
	Home
@endsection

@section('content')
	<div class="container">
		<h3 class="page-header">Home</h3>

		@include('pages.lipsum')
	</div>
@endsection
