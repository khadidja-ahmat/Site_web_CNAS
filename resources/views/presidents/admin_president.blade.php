@extends('layout/layout')
@section('content')
<div id="about" class="about-area area-padding">
 <br><br>
    <div class="container">
      <div class="row">
      <div class="flex-end" >
            <a href="{{route('admin.presidents.create')}}" class="btn btn-sm btn-primary float-right">Nouveau</a>
      </div>
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
          <div class="well-middle">
            <div class="single-well">
              <a href="#">
                <h3 class="sec-head">{{$president->titre}}</h3>
              </a>
              <p>{{$president->description}}</p>
            </div>
          </div>
        </div>
        <!-- End col-->
      </div>
      <div class="col-sm-12">
                <div class="mb-3">
                  <a href="{{route('admin.presidents.edit', $president->id)}}" class="btn  btn-block btn-outline-warning " >Modifier</a>
                  <a class='btn btn-block btn-outline-danger' href='#'  role='button' onClick="deletepresident({{$president ->id}});">Supprimer</a>

                                    <form action="{{route('admin.presidents.destroy', $president->id)}}" method="post" id="delete-{{$president->id}}">
                                    @csrf
                                                @method('delete')

                                   </form>


                </div>
              </div>
        </div>
 @endforeach
    </div>
    <script>
        function deletePresident(id) {
            if(confirm('Etes vous sure de vouloir supprimer cette enregistrement ?')){
                document.getElementById('delete-' + id).submit();
            }
        }
    </script>
    </div>
  </div>