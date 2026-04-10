<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>CNAS</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="{{URL::to('img/favicon.png" rel="icon ')}}">
  <link href="{{URL::to('img/apple-touch-icon.png" rel="apple-touch-icon ')}}">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,400i,600,700|Raleway:300,400,400i,500,500i,700,800,900" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{URL::to('lib/bootstrap/css/bootstrap.min.css ')}}" rel="stylesheet">

  <!-- Libraries CSS Files -->
  <link href="{{URL::to('lib/nivo-slider/css/nivo-slider.css')}}" rel="stylesheet">
  <link href="{{URL::to('lib/owlcarousel/owl.carousel.css')}}" rel="stylesheet">
  <link href="{{URL::to('lib/owlcarousel/owl.transitions.css')}}" rel="stylesheet">
  <link href="{{URL::to('lib/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
  <link href="{{URL::to('lib/animate/animate.min.css')}}" rel="stylesheet">
  <link href="{{URL::to('lib/venobox/venobox.css')}}" rel="stylesheet">

  <!-- Nivo Slider Theme -->
  <link href="{{URL::to('css/nivo-slider-theme.css')}}" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="{{URL::to('css/style.css')}}" rel="stylesheet">

  <!-- Responsive Stylesheet File -->
  <link href="{{URL::to('css/responsive.css')}}" rel="stylesheet">

  <!-- =======================================================
    Theme Name: eBusiness
    Theme URL: https://bootstrapmade.com/ebusiness-bootstrap-corporate-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body data-spy="scroll" data-target="#navbar-example">

<div id="">
<div id="app">
@include("layout.navbar")
<main classe="py-4 @yield ('mode','')">
@yield('content')
</main>
@include('layout.footer')
</div>
<a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

<!-- JavaScript Libraries -->
<script src="{{URL::to('lib/jquery/jquery.min.js')}}"></script>
<script src="{{URL::to('lib/bootstrap/js/bootstrap.min.js')}}"></script>
<script src="{{URL::to('lib/owlcarousel/owl.carousel.min.js')}}"></script>
<script src="{{URL::to('lib/venobox/venobox.min.js')}}"></script>
<script src="{{URL::to('lib/knob/jquery.knob.js')}}"></script>
<script src="{{URL::to('lib/wow/wow.min.js')}}"></script>
<script src="{{URL::to('lib/parallax/parallax.js')}}"></script>
<script src="{{URL::to('lib/easing/easing.min.js')}}"></script>
<script src="{{URL::to('lib/nivo-slider/js/jquery.nivo.slider.js')}}" type="text/javascript"></script>
<script src="{{URL::to('lib/appear/jquery.appear.js')}}"></script>
<script src="{{URL::to('lib/isotope/isotope.pkgd.min.js')}}"></script>

<!-- Contact Form JavaScript File -->
<script src="{{URL::to('contactform/contactform.js')}}"></script>

<script src="{{URL::to('js/main.js')}}"></script>
</body>

</html>