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
                <h1 class="title2">Nos realisations</h1>
              </div>
              <div class="layer3 wow zoomInUp" data-wow-duration="2s" data-wow-delay="1s">
                <h2 class="title3">"Nos réalisations en assurance santé sont le résultat de notre engagement constant à innover, à vous accompagner et à vous offrir des solutions qui font une réelle différence dans votre vie."</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="team" class="our-team-area area-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Nos realisation</h2>
          </div>
        </div>
      </div>
      <div class="row">
             @foreach($realisations as $realisation)
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="single-team-member">
              <div class="awesome-img">
                <a href="#">
                   <img src="{{url('images/realisations/'.$realisation->image)}}" alt="">
									</a>
              </div>
              <div class="team-content text-center">
               <a class="venobox" data-gall="myGallery"  href="images/realisations/{{$realisation->image}}">
                      <h4>{{$realisation->titre}}</h4>
                      <p>{{$realisation->description}}</p>
                    </a>
              </div>
            </div>
          </div>
           @endforeach
          <!-- End column -->
        </div>
      </div>
    </div>
  </div>
  @endsection
  <!-- End Team Area -->