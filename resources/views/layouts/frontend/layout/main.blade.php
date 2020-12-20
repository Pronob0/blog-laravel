<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <title>@yield('title')-{{ config('app.name', 'Laravel') }}</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">


	<!-- Font -->

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


	<!-- Stylesheets -->

	<link href="{{ asset('public/assets/frontend/css/bootstrap.css') }}" rel="stylesheet">

	<link href="{{ asset('public/assets/frontend/css/ionicons.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
@stack('css')

</head>
<body>
    @include('layouts.frontend.layout.header')

    @yield('content')

    @include('layouts.frontend.layout.footer')




    <script src="{{ asset('public/assets/frontend/js/jquery-3.1.1.min.js') }}"></script>

	<script src="{{ asset('public/assets/frontend/js/tether.min.js') }}"></script>

	<script src="{{ asset('public/assets/frontend/js/bootstrap.js') }}"></script>

	<script src="{{ asset('public/assets/frontend/js/scripts.js') }}"></script>
	<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
		{!! Toastr::message() !!}
		
		
		
	
    
    @stack('js')
</body>
</html>
