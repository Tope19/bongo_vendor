<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('dashboard/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('dashboard/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('dashboard/images/favicon/favicon-16x16.png') }}">
    {{-- <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5"> --}}
	{{-- <meta name="author" content="NobleUI"> --}}
	{{-- <meta name="keywords" content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web"> --}}

	<title>{{$title ?? ''}} | {{ env("APP_NAME") }}</title>
    {{-- @toastr_js --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	@include('dashboard.layouts.includes.style')
    {{-- <link rel="shortcut icon" href="{{ $web_source }}/assets/images/favicon.png"> --}}
</head>
<body>
	<div class="main-wrapper">
		<!-- partial:partials/_sidebar.html -->
		@include('dashboard.layouts.includes.sidebar')
		<!-- partial -->

		<div class="page-wrapper">
			<!-- partial:partials/_navbar.html -->
            @include('dashboard.layouts.includes.header')

			<div class="page-content">

                @yield('content')

			</div>
			<!-- partial:partials/_footer.html -->
            @include('dashboard.layouts.includes.footer')
			<!-- partial -->
		</div>
	</div>

	@include('dashboard.layouts.includes.script')

</body>
{{-- @toastr_render --}}
</html>
