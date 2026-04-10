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
                <h1 class="title2">Nos organigrammes</h1>
              </div>
              <div class="layer3 wow zoomInUp" data-wow-duration="2s" data-wow-delay="1s">
                <h2 class="title3">" Un organigramme bien structuré peut décrire toute une entreprise et son mode de fonctionnement"</h2>
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
          <div class="section-headline text-center">
            <h2>Organigramme</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- single-well start-->
        
   @foreach($organigrammes as $organigramme)
        <div class="col-md-6 col-sm-8 col-xs-12">
              <div class="">
                <a href="#">
                   <img src="{{url('images/organigrammes/'.$organigramme->image)}}" alt="">
								</a>
              </div>
        </div>
        @endforeach
          </div>
      </div>
    </div>
  </div>
  
@endsection