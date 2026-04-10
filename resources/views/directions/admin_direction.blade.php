@extends('layout/layout')
@section('content')
 <div id="blog" class="blog-area">
    <div class="blog-inner area-padding">
      <div class="blog-overly"></div>
      <div class="container ">
        <div class="row">
        <div class="flex-end" >
            <a href="{{route('admin.directions.create')}}" class="btn btn-sm btn-primary float-right">Nouveau</a>
      </div>
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Nos institutions</h2>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- Start Left Blog -->
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
          <div class="col-sm-12">
                <div class="mb-3">
                  <a href="{{route('admin.directions.edit', $direction->id)}}" class="btn  btn-block btn-outline-warning " >Modifier</a>
                  <a class='btn btn-block btn-outline-danger' href='#'  role='button' onClick="deletedirection({{$direction ->id}});">Supprimer</a>

                                    <form action="{{route('admin.directions.destroy', $direction->id)}}" method="post" id="delete-{{$direction->id}}">
                                    @csrf
                                                @method('delete')

                                   </form>


                </div>
              </div>
        </div>
          
      @endforeach
               <script>
        function deleteDirection(id) {
            if(confirm('Etes vous sure de vouloir supprimer cette enregistrement ?')){
                document.getElementById('delete-' + id).submit();
            }
        }
    </script>
            <!-- Start single blog -->
          </div>
  
        </div>
      </div>
    </div>