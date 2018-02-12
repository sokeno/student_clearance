<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title', 'Clearance')</title>

    <!-- Styles -->
    <link href="//fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
	<link rel="icon" href="{{ asset('images/upm-favicon.png') }}" />
     <link href="{{ asset('css/app.css') }}" rel="stylesheet">  
    {{--  <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet">  --}}
    {{--  <link href="{{ asset('css/style.css') }}" rel="stylesheet">  --}}

    <script>
            addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false);
    
            function hideURLbar() {
                window.scrollTo(0, 1);
            }
        </script>

</head>
<body>
    <div id="app">
       
		@include('layouts.navbar')

		<div id="content">
			@yield('content')
		</div>

		@include('layouts.footer')

    </div>

    <!-- Scripts -->
    
    {{--  <script src="{{ asset('js/jquery-2.1.4.min.js') }}"></script>
    <script src="{{ asset('js/validator.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>  --}}
	 <script src="{{ asset('js/app.js') }}"></script>  
	<script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>

	@include("layouts.autocompletescript")
	@include("layouts.requestclearancescript")

</body>
</html>
