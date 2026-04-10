 @extends('layouts/layout')
@section('content')

        <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
            <br><br><br><br>
              <h2>Adresses</h2>
            </div>
          </div>
        </div>
        <div class="row">
        
        @foreach ($adresses as $adresse )
          <!-- Start contact icon column -->
          
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="contact-icon text-center">
              <div class="single-icon">
                <i class="fa fa-mobile"></i>
                <p>{{$adresse->tel}}<br>
                  <span>{{$adresse->heure}}</span>
                </p>
              </div>
            </div>
          </div>
          <!-- Start contact icon column -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="contact-icon text-center">
              <div class="single-icon">
                <i class="fa fa-envelope-o"></i>
                <p>{{$adresse->email}}<br>
                  <span>{{$adresse->site}}</span>
                </p>
              </div>
            </div>
          </div>
          <!-- Start contact icon column -->
          <div class="col-md-4 col-sm-4 col-xs-12">
            <div class="contact-icon text-center">
              <div class="single-icon">
                <i class="fa fa-map-marker"></i>
                <p>{{$adresse->adresse}}<br>
                  <span>{{$adresse->lieu}}</span>
                </p>
              </div>
            </div>
          </div>
           @endforeach
        </div>

       
       
        @endsection