<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>  @yield('title') {{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles
    <link href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.3.0/css/font-awesome.css"rel="stylesheet"  type='text/css'>
    -->
    <link href="{{ asset('assets/font/fontawesome.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        @include('navbar')

        <main class="py-4 @yield('mode','')" >
            @yield('content')
        </main>
        @include('footer')
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
	
	<script>
		$('#play-video').on('click', function(ev) {
		$(this).hide();
		$("#video")[0].src += "?rel=0&autoplay=1";
	</script>
});
</body>
</html>
