@extends('layouts/layout')
@section('content')


  <div id="services" class="services-area area-padding">
    <br><br>
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Mot du directeur</h2>
          </div>
        </div>
      </div>
      <div class="row">
      
   @foreach($presidents as $president)
        <div class="col-md-4 col-sm-8 col-xs-12">
            <div class="single-team-member">
              <div class="team-img">
                <a href="#">
                   <img src="{{url('images/presidents/'.$president->image)}}" alt="">
									</a>
                <div class="team-social-icon text-center">
                  <ul>
                    <li>
                      <a href="#">
													<i class="fa fa-facebook"></i>
												</a>
                    </li>
                    <li>
                      <a href="#">
													<i class="fa fa-twitter"></i>
												</a>
                    </li>
                    <li>
                      <a href="#">
													<i class="fa fa-instagram"></i>
												</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
  
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="well-middle ">
            <div class="single-well">
              <a href="#">
                <h3 class="sec-head">{{$president->titre}}</h3>
              </a>
              <a href="#">
              <p>{{$president->description}}</p>
              </a>
            </div>
          </div>
        </div>
        @endforeach
        <!-- End col-->
      </div>
    </div>
  </div>
  @endsection