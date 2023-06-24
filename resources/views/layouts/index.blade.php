<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link rel="shortcut icon" href="{{ asset('assets/img/icons/icon-48x48.png') }}" />

	<link rel="canonical" href="https://demo-basic.adminkit.io/" />

	<title>AdminKit Demo - Bootstrap 5 Admin Template</title>

	<link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/formvalidation/dist/css/formValidation.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/spinkit/spinkit.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/sweetalert/sweetalert2.min.css') }}">
    @yield('css')
</head>

<body>
	<div class="wrapper" id="main-body">
        @include('layouts.sidebar')

		<div class="main">
            @include('layouts.header')

			<main class="content">
				<div class="container-fluid p-0">
                    @yield('content')
				</div>
			</main>

            @include('layouts.footer')
		</div>
	</div>

	<script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('assets/sweetalert/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('assets/block-ui/block-ui.js') }}"></script>
    <script src="{{ asset('assets/formvalidation/dist/js/FormValidation.min.js') }}"></script>
    <script src="{{ asset('assets/formvalidation/dist/js/plugins/Bootstrap5.min.js') }}"></script>
    <!-- AutoFocus plugin, automatically focus on the first invalid input  -->
    <script src="{{ asset('assets/formvalidation/dist/js/plugins/AutoFocus.min.js') }}"></script>
    <script>
     @if ($message = session('fail'))
        Swal.fire({
            text: '{{ $message }}',
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        });
    @endif
    @if ($message = session('success'))
        Swal.fire({
            text: '{{ $message }}',
            icon: "success",
            buttonsStyling: false,
            confirmButtonText: "Ok",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        });
    @endif

    function blockui ()
    {
        $("#main-body").block({
            message:
                '<div class="sk-wave sk-primary mx-auto"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div>',
            css: {
                backgroundColor: "transparent",
                border: "0"
            },
            overlayCSS: {
                backgroundColor: "#35363A",
                opacity: 0.8
            }
        })
    }
    </script>
    @yield('js')

</body>

</html>
