@extends('layoutCNAS.layouts')
@section('content')

<br><br>
  <div id="team" class="our-team-area area-padding">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Nos activites</h2>
          </div>
        </div>
      </div>
      <div class="row">
             @foreach($activites as $activite)
          <div class="col-md-3 col-sm-3 col-xs-12">
            <div class="single-team-member">
              <div class="awesome-img">
                <a href="#">
                   <img src="{{url('images/activites/'.$activite->image)}}" alt="">
									</a>
              </div>
              <div class="team-content text-center">
               <a class="venobox" data-gall="myGallery"  href="images/activites/{{$activite->image}}">
                      <h4>{{$activite->titre}}</h4>
                      <p>{{$activite->description}}</p>
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