@extends('layout/layout')
@section('content')
 <div id="portfolio" class="portfolio-area area-padding fix">
    <div class="container">
      <div class="row"><br><br>        
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Nos realisations</h2>
          </div>
        </div>
      </div>
      <div class="row">
      <div class="flex-end" >
            <a href="{{route('admin.realisations.create')}}" class="btn btn-sm btn-primary float-right">Nouveau</a>
      </div>

      <div class="awesome-project-content">
          <!-- single-awesome-project start --> 
          <div class="col-md-4 col-sm-4 col-xs-12 design development">
           @foreach($realisations as $realisation)
            <div class="single-awesome-project">
              <div class="awesome-img">
              <a>
              <h4>{{$realisation->titre}}</h4>  
              <img src="{{url('/images/realisations/'.$realisation->image)}}" alt="">
                <p>{{$realisation->description}}</p>
            </a>
              <div class="add-actions text-center">
                  <div class="project-dec">
                    <a class="venobox" data-gall="myGallery" href="/images/realisations/{{$realisation->image}}">
                    </a>
                  </div>
                </div>
              </div>

            </div>

          </div>
      <div class="col-sm-12">
                <div class="mb-3">
                  <a href="{{route('admin.realisations.edit', $realisation->id)}}" class="btn  btn-block btn-outline-warning " >Modifier</a>
                  <a class='btn btn-block btn-outline-danger' href='#'  role='button' onClick="deleteorganigramme({{$realisation ->id}});">Supprimer</a>

                                    <form action="{{route('admin.realisations.destroy', $realisation->id)}}" method="post" id="delete-{{$realisation->id}}">
                                    @csrf
                                                @method('delete')

                                   </form>


                </div>
              </div>
        </div>
 @endforeach
    </div>
    <script>
        function deleteorganigramme(id) {
            if(confirm('Etes vous sure de vouloir supprimer cette enregistrement ?')){
                document.getElementById('delete-' + id).submit();
            }
        }
    </script>
    </div>
  </div>    
   </div>
      </div>
    </div>
  </div>
  @endsection