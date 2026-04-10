@extends('layouts/layout')
@section('content')
<div id="about" class="about-area area-padding">
 <br><br>
    <div class="container">
      <div class="row">
      <div class="flex-end" >
            <a href="{{route('admin.sliders.create')}}" class="btn btn-sm btn-primary float-right">Nouveau</a>
      </div>
        <div id="home" class="slider-area">
    <div class="bend niceties preview-2">
    
   @foreach($sliders as $slider)
      <div id="ensign-nivoslider" class="slides">
      <img src="{{url('images/sliders/'.$slider->image)}}" alt="">
      </div>

      <!-- direction 1 -->
      <div id="slider-direction-1" class="slider-direction slider-one">
        <div class="container">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="slider-content">
                <!-- layer 1 -->
                <div class="layer-1-1 hidden-xs wow slideInDown" data-wow-duration="2s" data-wow-delay=".2s">
                  <h2 class="title1">{{$slider->titre}}</h2>
                </div>
                <!-- layer 2 -->
                <div class="layer-1-2 wow slideInUp" data-wow-duration="2s" data-wow-delay=".1s">
                  <h1 class="title2">{{$slider->description}}</h1>
                </div>                
                <!-- layer 3 -->
                <div class="layer-1-3 hidden-xs wow slideInUp" data-wow-duration="2s" data-wow-delay=".2s">
                  <a class="ready-btn right-btn page-scroll" href="#services">See Services</a>
                  <a class="ready-btn page-scroll" href="#about">Learn More</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
  </div>
      <div class="col-sm-12">
                <div class="mb-3">
                  <a href="{{route('admin.sliders.edit', $slider->id)}}" class="btn  btn-block btn-outline-warning " >Modifier</a>
                  <a class='btn btn-block btn-outline-danger' href='#'  role='button' onClick="deleteSlider({{$slider ->id}});">Supprimer</a>

                                    <form action="{{route('admin.sliders.destroy', $slider->id)}}" method="post" id="delete-{{$slider->id}}">
                                    @csrf
                                                @method('delete')

                                   </form>


                </div>
              </div>
        </div>
 @endforeach
    </div>
    <script>
        function deleteSlider(id) {
            if(confirm('Etes vous sure de vouloir supprimer cette enregistrement ?')){
                document.getElementById('delete-' + id).submit();
            }
        }
    </script>
    </div>
  </div>
  @endsection