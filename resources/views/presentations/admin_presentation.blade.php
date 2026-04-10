@extends('layout/layout')
@section('content')
 <div id="about" class="about-area area-padding">
   <br><br>
    <div class="container">
      <div class="row">
      <div class="flex-end" >
            <a href="{{route('admin.presentations.create')}}" class="btn btn-sm btn-primary float-right">Nouveau</a>
      </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="section-headline text-center">
            <h2>Présentation</h2>
          </div>
        </div>
      </div>
        <header class="section-header">
       @foreach($presentations as $presentation) 
        <p>{{$presentation->description}}</p>    
        </header>
        <div class="col-sm-12">
                <div class="mb-3">
                  <a href="{{route('admin.presentations.edit', $presentation->id)}}" class="btn  btn-block btn-outline-warning " >Modifier</a>
                  <a class='btn btn-block btn-outline-danger' href='#'  role='button' onClick="deletepresentation({{$presentation ->id}});">Supprimer</a>

                                    <form action="{{route('admin.presentations.destroy', $presentation->id)}}" method="post" id="delete-{{$presentation->id}}">
                                    @csrf
                                                @method('delete')

                                   </form>


                </div>
              </div>
        </div>
    </div>
    @endforeach 
    <script>
        function deletePresentation(id) {
            if(confirm('Etes vous sure de vouloir supprimer cette enregistrement ?')){
                document.getElementById('delete-' + id).submit();
            }
        }
    </script>
 </div>
