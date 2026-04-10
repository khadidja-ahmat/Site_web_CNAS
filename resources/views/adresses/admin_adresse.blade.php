@extends('layout/layout')
@section('content')
 <div id="portfolio" class="portfolio-area area-padding fix">
    <div class="container">
      <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Contactez-nous</h2>
            </div>
          </div>
        </div>
        <div class="row">
      <div class="flex-end" >
            <a href="{{route('admin.adresses.create')}}" class="btn btn-sm btn-primary float-right">Nouveau</a>
      </div>

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
      <div class="col-sm-12">
                <div class="mb-3">
                  <a href="{{route('admin.adresses.edit', $adresse->id)}}" class="btn  btn-block btn-outline-warning " >Modifier</a>
                  <a class='btn btn-block btn-outline-danger' href='#'  role='button' onClick="deleteAdresse({{$adresse ->id}});">Supprimer</a>

                                    <form action="{{route('admin.adresses.destroy', $adresse->id)}}" method="post" id="delete-{{$adresse->id}}">
                                    @csrf
                                                @method('delete')

                                   </form>


                </div>
              </div>
     @endforeach
        </div>
    <script>
        function deleteAdresse(id) {
            if(confirm('Etes vous sure de vouloir supprimer cette enregistrement ?')){
                document.getElementById('delete-' + id).submit();
            }
        }
    </script>
    </div>
  </div>    
   </div>
   