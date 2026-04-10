@extends('layouts/layout')
@section('content')
<div class="header-bg page-area">
    <div class="home-overly"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="slider-content text-center">
            <div class="header-bottom">
              <div class="layer2 wow zoomIn" data-wow-duration="1s" data-wow-delay=".4s">
                <h1 class="title2">Nos institutions</h1>
              </div>
              <div class="layer3 wow zoomInUp" data-wow-duration="2s" data-wow-delay="1s">
                <h2 class="title3">" Nos institutions de santé, gardiennes bienveillantes de votre santé, aujourd'hui et pour l'avenir"</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="services" class="services-area area-padding">
  <br><br>
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline services-head text-center">
            <h2>Nos institutions</h2>
          </div>
        </div>
      </div>
      <div class="row text-center">
        <div class="services-contents">
        @foreach($institutions as $institution)
          <!-- Start Left services -->
          <div class="col-md-4 col-sm-4 col-xs-12">
          <div class=" about-move">
              <div class="services-details">
                <div class="single-services">
                  <a class="services-icon" href="#">
											<i class="fa fa-ticket"></i>
										</a>
                  <h4>{{$institution->titre}}</h4>
                  <p>
                  {{$institution->description}}
                  </p>
                </div>
              </div>
              <!-- end about-details -->
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
  <!-- End Service area -->
  @endsection