@extends('layouts/layout')
@section('content')
<br> 
 <div id="blog" class="blog-area">
    <div class="blog-inner area-padding">
      <div class="blog-overly"></div>
      <div class="container ">
        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Nos Directions</h2>
            </div>
          </div>
        </div>
        <div class="row">
     @foreach($directions as $direction)
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="single-blog">
              <div class="blog-text">
                <h4><a>{{$direction->titre}}</a></h4>
                <p>{{$direction->description}}</p>
              </div>
               <div class="single-blog-img">
                <a href="#">
               <img src="{{url('images/directions/'.$direction->image)}}" alt="">
                </a>
               </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
      <br><br>
       <div class="suscribe-area">
      <div class="container">
      <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs=12">
          <div class="suscribe-text text-center">
            <h3>Pour en savoir plus sur les directions:</h3>
            <a class="sus-btn" href="details">Détails</a>
          </div>
        </div>
      </div>
    </div>
    </div>
  </div>
@endsection