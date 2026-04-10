@extends('layout/layout')
@section('content')
 <div id="about" class="about-area area-padding">
   <br><br>
    <div class="container">
      <div class="row">
      <div class="flex-end" >
            <a href="{{route('admin.abouts.create')}}" class="btn btn-sm btn-primary float-right">Nouveau</a>
      </div>
        <div class="col-md-6 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Apropos</h2>
          </div>
        </div>
      </div>
       <div class="row">
      
     @foreach($abouts as $about)
        <!-- single-well start-->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="well-left">
            <div class="single-well">
              <a href="#">
      <img src="{{url('images/abouts/'.$about->image)}}" alt="">
								</a>
            </div>
          </div>
        </div>
        <!-- single-well end-->
        <div class="col-md-6 col-sm-6 col-xs-12">
          <div class="well-middle">
            <div class="single-well">
              <a href="#">
                <h4 class="sec-head">{{$about->titre}}</h4>
              </a>
              <p>{{$about->description}}</p>
            </div>
          </div>
        </div>
      <div class="col-sm-12">
                <div class="mb-3">
                  <a href="{{route('admin.abouts.edit', $about->id)}}" class="btn  btn-block btn-outline-warning " >Modifier</a>
                  <a class='btn btn-block btn-outline-danger' href='#'  role='button' onClick="deleteAbout({{$about ->id}});">Supprimer</a>

                                    <form action="{{route('admin.abouts.destroy', $about->id)}}" method="post" id="delete-{{$about->id}}">
                                    @csrf
                                                @method('delete')

                                   </form>


                </div>
              </div>
    </div>
    @endforeach 
    <script>
        function deleteAbout(id) {
            if(confirm('Etes vous sure de vouloir supprimer cette enregistrement ?')){
                document.getElementById('delete-' + id).submit();
            }
        }
    </script>
 </div>