@extends('layouts/layout')
@section('content')
 <div class="header-bg page-area">
    <div class="home-overly"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="slider-content text-center">
            <div class="header-bottom">
              <div class="layer2 wow zoomIn" data-wow-duration="1s" data-wow-delay=".4s">
                <h1 class="title2">Nos actualités</h1>
              </div>
              <div class="layer3 wow zoomInUp" data-wow-duration="2s" data-wow-delay="1s">
                <h2 class="title3">" Vie éphémere , brefs instants."</h2>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- END Header -->
  <div class="blog-page area-padding">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <div class="page-head-blog">
            <div class="single-blog-page">
              <!-- search option start -->
              <form action="#">
                <div class="search-option">
                  <input type="text" placeholder="Search...">
                  <button class="button" type="submit">
                                            <i class="fa fa-search"></i>
                                        </button>
                </div>
              </form>
              <!-- search option end -->
            </div>
             <div class="single-blog-page">
              <!-- recent start -->
              <div class="left-blog">
                <h4>les actualités récentes</h4>
                <div class="recent-post">
                  <!-- start single post -->
                  
               @foreach($actualites as $actualite)
                  <div class="recent-single-post">
                    <div class="post-img">
                      <a href="detail">
                         <img src="{{url('images/actualites/'.$actualite->image)}}" alt="">
												</a>
                    </div>
                    <div class="pst-content">
                      <p><a href="detail">{{$actualite->titre}}</a></p>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- End left sidebar -->
        <!-- Start single blog -->
        <div class="col-md-8 col-sm-8 col-xs-12">
          <div class="row">
          
           @foreach($actualites as $actualite)
            <div class="col-md-12 col-sm-12 col-xs-12">
              <div class="single-blog">
                <div class="single-blog-img">
                  <a href="blog-details.html">
               <img src="{{url('images/actualites/'.$actualite->image)}}" alt="">
										</a>
                </div>
                <div class="blog-meta">
                  <span class="date-type">
											<i class="fa fa-calendar"></i>{{$actualite ->created_at}}
										</span>
                </div>
                <div class="blog-text">
                  <h4>
											<a href="#">{{$actualite->titre}}</a>
										</h4>
                  <p>{{$actualite->description}}  </p>
                  <p>{{$actualite->details}}  </p>
                </div>
               
              </div>
            </div>
            @endforeach
            <!-- End single blog -->
            
            <!-- Start single blog -->
            
            <!-- End single blog -->
           
            <!-- Start single blog -->
            <!-- End single blog -->
            <div class="blog-pagination">
              <ul class="pagination">
                <li><a href="#">&lt;</a></li>
                <li class="active"><a href="#">1</a></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Blog Area -->

  <div class="clearfix"></div>

  @endsection
