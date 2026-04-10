@extends('layouts/layout')
@section('content')
    
    
    <!-- ======= Contact Section ======= -->
<div class="breadcrumbs">
      <nav>
        <div class="container">
          <ol>
            <li><a  href="Acceuil.index">Home</a></li>
            <li>contact</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Breadcrumbs -->

<section id="actualite" class="actualite">
      <div class="container" data-aos="fade-up">

        <div class="row g-5">

          <div class="col-lg-8">

            <article class="actualite-details">
         

              <div class="post-img">
              <img src="{{url('img/blogs/'.$actualite -> image)}}" class="img-fluid" alt="">
              </div>

              <h2 class="title">{{$actualite->titre}}</h2>

              <div class="meta-top">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="actualite-details.html"><time datetime="2020-01-01">{{$actualite->created_at}}</time></a></li>
                </ul>
              </div><!-- End meta top -->

              <div class="content">
                <p>{{$actualite->description}} </p>

              </div><!-- End post content -->
   
            </article><!-- End actualite post -->

         </div>
    </div>
</div>
        
</section><!-- End Blog Details Section -->

@endsection