<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Creativeitem Software Installation" />
	<meta name="author" content="Creativeitem" />
	<title>{{ __('Installation').' | '.__('Locus') }}</title>
	
	<!-- CSRF Token for ajax for submission -->
    <meta name="csrf_token" content="{{ csrf_token() }}" />

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link rel="shortcut icon" href="{{asset('storage/logo/favicon/favicon.png')}}" />
    <!-- CSS Library -->
    <link rel="stylesheet" href="{{asset('public/assets/global/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/global/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/assets/global/css/style.css')}}">
    <script src="{{ asset('public/assets/global/js/jquery-3.7.1.min.js') }}"></script>


</head>
<body class="page-body">

<div class="page-container horizontal-menu">

	<header class="navbar navbar-fixed-top ins-one bg-dark">
		<div class="container">
			<div class="navbar-inner">
				<!-- logo -->
				<div class="navbar-brand">
					<a href="#">
						<img width="130px" src="{{ asset('storage') }}/logo/light_logo.png" alt="">
					</a>
				</div>
			</div>
		</div>
	</header>
	<div class="main_content py-4">
		@yield('content')
	</div>

	<!--Javascript
    ========================================================-->
    <script src="{{asset('public/assets/global/js/bootstrap.bundle.min.js')}}"></script>

</body>
</html>