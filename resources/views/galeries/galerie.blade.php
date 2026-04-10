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
                <h1 class="title2">Nos galeries</h1>
              </div>
              <div class="layer3 wow zoomInUp" data-wow-duration="2s" data-wow-delay="1s">
                <h2 class="title3">" Une galerie en ligne, une exposition accessible a tous"</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="portfolio" class="portfolio-area area-padding fix">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Nos Galeries</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <!-- Start Portfolio -page -->
        
        <div class="awesome-project-content">
     @foreach($galeries as $galerie)
          <div class="col-md-4 col-sm-4 col-xs-12 design development">
            <div class="single-awesome-project">
              <div class="awesome-img">
                   <a href="#"><img src="{{url('images/galeries/'.$galerie->image)}}" alt=""></a>
                <div class="add-actions text-center">
                  <div class="project-dec">
                    <a class="venobox" data-gall="myGallery" href="images/galeries/{{$galerie->image}}">
                      <h4>{{$galerie->titre}}</h4>
                      <span>{{$galerie->description}}</span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
       @endforeach
        </div>
      </div>
    </div>
  </div>

@endsection