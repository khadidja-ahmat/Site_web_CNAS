@extends('layout/layout')
@section('content')
 <div id="portfolio" class="portfolio-area area-padding fix">
    <div class="container">
      <div class="row"><br><br>        
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Nos institutions</h2>
          </div>
        </div>
      </div>
      <div class="row">
      <div class="flex-end" >
            <a href="{{route('admin.institutions.create')}}" class="btn btn-sm btn-primary float-right">Nouveau</a>
      </div>

      <div class="awesome-project-content">
          <!-- single-awesome-project start --> 
          <div class="col-md-4 col-sm-4 col-xs-12 design development">
           @foreach($institutions as $institution)
            <div class="single-awesome-project">
              <div class="awesome-img">
              <a>
              <h4>{{$institution->titre}}</h4>  
                <p>{{$institution->description}}</p>
            </a>
              </div>

            </div>

          </div>
      <div class="col-sm-12">
                <div class="mb-3">
                  <a href="{{route('admin.institutions.edit', $institution->id)}}" class="btn  btn-block btn-outline-warning " >Modifier</a>
                  <a class='btn btn-block btn-outline-danger' href='#'  role='button' onClick="deleteorganigramme({{$institution ->id}});">Supprimer</a>

                                    <form action="{{route('admin.institutions.destroy', $institution->id)}}" method="post" id="delete-{{$institution->id}}">
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