@extends('layout/layout')
@section('content')








<div id="contact" class="contact-area">
<div class="contact-inner area-padding">
      <div class="contact-overly"></div>
      <div class="container ">
 <div class="row">
          <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="section-headline text-center">
              <h2>Contactez-nous</h2>
            </div>
          </div>
        </div>
 <div class="row">

<div class="col-md-6 col-sm-6 col-xs-12 m-center">
@foreach ($contacts as $contact)
            <div class="form contact-form">
            
             
                <div class="form-group">
                  <input type="text" name="nom" class="form-control" value="{{$contact->nom}}" id="nom" disabled />
                  </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="email" value="{{$contact->email}}" id="email"disabled  />
                 </div>
                <div class="form-group">
                  <input type="text" class="form-control" name="objet" value="{{$contact->objet}}" id="objet" disabled/> 
                </div>
                <div class="form-group">
                  <textarea class="form-control" name="message"  id="message"  disabled>$contact->message"</textarea>
                  </div>


                  <div class="col-sm-12">
                <div class="mb-3">
                  <a href="{{route('admin.contacts.edit', $contact->id)}}" class="btn  btn-block btn-outline-warning " >Modifier</a>
                  <a class='btn btn-block btn-outline-danger' href='#'  role='button' onClick="deletecontact({{$contact ->id}});">Supprimer</a>

                                    <form action="{{route('admin.contacts.destroy', $contact->id)}}" method="post" id="delete-{{$contact->id}}">
                                    @csrf
                                                @method('delete')

                                   </form>
                                   <script>
function deleteBlog(id) {
    if (confirm('Etes vous sure de vouloir supprimer cette enregistrement ?')) {
        document.getElementById('delete-' + id).submit();
    }
}
</script>


                </div>
              </div>
                  @endforeach
            </div>
          </div>
          </div>
          </div>
          </div>
          </div>
          </div>
          @endsection