@extends('layouts.app')

@section('content')
	<div class="container">
		Hello, {{Auth::user()->name}}
		<br>
		You can add colleges to the record
    </div>
@endsection