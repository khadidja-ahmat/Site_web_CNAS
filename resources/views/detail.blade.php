 @extends('layouts_admin/layouts')
@section('content')
 <div class="header-bg page-area">
    <div class="home-overly"></div>
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="slider-content text-center">
            <div class="header-bottom">
              <div class="layer2 wow zoomIn" data-wow-duration="1s" data-wow-delay=".4s">
                <h1 class="title2">Détails de nos actualité</h1>
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
            
           {{--  <div class="single-blog-page">
              <!-- recent start -->
              <div class="left-blog">
                <h4>les actualités récentes</h4>
                <div class="recent-post">
                  <!-- start single post -->
                  
               @foreach($actualites as $actualite)
                  <div class="recent-single-post">
                    <div class="post-img">
                      <a href="actualites/{id}">
                         <img src="{{url('images/actualites/'.$actualite->image)}}" alt="">
												</a>
                    </div>
                    <div class="pst-content">
                      <p><a href="actualites/{id}">{{$actualite->titre}}</a></p>
                    </div>
                  </div>
                  @endforeach
                </div>
              </div>
            </div> --}}
            {{-- <div class="single-blog-page">
              <div class="left-blog">
                <h4>categories</h4>
                <ul>
                  <li>
                    <a href="#">Portfolio</a>
                  </li>
                  <li>
                    <a href="#">Project</a>
                  </li>
                  <li>
                    <a href="#">Design</a>
                  </li>
                  <li>
                    <a href="#">wordpress</a>
                  </li>
                  <li>
                    <a href="#">Joomla</a>
                  </li>
                  <li>
                    <a href="#">Html</a>
                  </li>
                  <li>
                    <a href="#">Website</a>
                  </li>
                </ul>
              </div>
            </div> --}}
           {{--  <div class="single-blog-page">
              <div class="left-blog">
                <h4>archive</h4>
                <ul>
                  <li>
                    <a href="#">07 July 2016</a>
                  </li>
                  <li>
                    <a href="#">29 June 2016</a>
                  </li>
                  <li>
                    <a href="#">13 May 2016</a>
                  </li>
                  <li>
                    <a href="#">20 March 2016</a>
                  </li>
                  <li>
                    <a href="#">09 Fabruary 2016</a>
                  </li>
                </ul>
              </div>
            </div> --}}
         {{--    <div class="single-blog-page">
              <div class="left-tags blog-tags">
                <div class="popular-tag left-side-tags left-blog">
                  <h4>popular tags</h4>
                  <ul>
                    <li>
                      <a href="#">Portfolio</a>
                    </li>
                    <li>
                      <a href="#">Project</a>
                    </li>
                    <li>
                      <a href="#">Design</a>
                    </li>
                    <li>
                      <a href="#">wordpress</a>
                    </li>
                    <li>
                      <a href="#">Joomla</a>
                    </li>
                    <li>
                      <a href="#">Html</a>
                    </li>
                    <li>
                      <a href="#">Masonry</a>
                    </li>
                    <li>
                      <a href="#">Website</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div> --}}
          </div>
        </div>
        <!-- End left sidebar -->
        <!-- Start single blog -->
        <div class="col-md-8 col-sm-8 col-xs-12">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
              <!-- single-blog start -->
              <article class="blog-post-wrapper">
               @foreach($actualites as $actualite)
                <div class="post-thumbnail">
                  <img src="{{url('images/actualites/'.$actualite->image)}}" alt="">
                </div>
                <div class="post-information">
                  <h2>{{$actualite->titre}}</h2>
                  <div class="entry-meta">
                   {{--  <span class="author-meta"><i class="fa fa-user"></i> <a href="#">admin</a></span>
                     --}}
                    <span><i class="fa fa-clock-o"></i> {{$actualite->created_at}}</span>
                    {{-- <span class="tag-meta">
												<i class="fa fa-folder-o"></i>
												<a href="#">painting</a>,
												<a href="#">work</a>
											</span>
                    <span>
												<i class="fa fa-tags"></i>
												<a href="#">tools</a>,
												<a href="#"> Humer</a>,
												<a href="#">House</a>
											</span> --}}
                   {{--  <span><i class="fa fa-comments-o"></i> <a href="#">6 comments</a></span>
                   --}}</div>
                  <div class="entry-content">
                    <p>{{$actualite->description}}</P>
                    <blockquote>
                    <p>{{$actualite->description1}}</P>
                    </blockquote>
                    <p>{{$actualite->description2}}</P>
                  </div>
                </div>
                @endforeach
              </article>
              <div class="clear"></div>
            {{--   <div class="single-post-comments">
                <div class="comments-area">
                  <div class="comments-heading">
                    <h3>6 comments</h3>
                  </div> --}}
                  {{-- <div class="comments-list">
                    <ul>
                      <li class="threaded-comments">
                        <div class="comments-details">
                          <div class="comments-list-img">
                            <img src="img/blog/b02.jpg" alt="post-author">
                          </div>
                          <div class="comments-content-wrap">
                            <span>
																<b><a href="#">demo</a></b>
																Post author
																<span class="post-time">October 6, 2014 at 4:25 pm</span>
                            <a href="#">Reply</a>
                            </span>
                            <p>Quisque semper nunc vitae erat pellentesque, ac placerat arcu consectetur</p>
                          </div>
                        </div>
                      </li>
                      <li>
                        <div class="comments-details">
                          <div class="comments-list-img">
                            <img src="img/blog/b02.jpg" alt="post-author">
                          </div>
                          <div class="comments-content-wrap">
                            <span>
																<b><a href="#">admin</a></b>
																Post author
																<span class="post-time">October 6, 2014 at 6:18 pm </span>
                            <a href="#">Reply</a>
                            </span>
                            <p>Quisque orci nibh, porta vitae sagittis sit amet, vehicula vel mauris. Aenean at justo dolor. Fusce ac sapien bibendum, scelerisque libero nec</p>
                          </div>
                        </div>
                      </li>
                      <li class="threaded-comments">
                        <div class="comments-details">
                          <div class="comments-list-img">
                            <img src="img/blog/b02.jpg" alt="post-author">
                          </div>
                          <div class="comments-content-wrap">
                            <span>
																<b><a href="#">demo</a></b>
																Post author
																<span class="post-time">October 6, 2014 at 7:25 pm</span>
                            <a href="#">Reply</a>
                            </span>
                            <p>Quisque semper nunc vitae erat pellentesque, ac placerat arcu consectetur</p>
                          </div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div> --}}
               {{--  <div class="comment-respond">
                  <h3 class="comment-reply-title">Leave a Reply </h3>
                  <span class="email-notes">Your email address will not be published. Required fields are marked *</span>
                  <form action="#">
                    <div class="row">
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <p>Name *</p>
                        <input type="text" />
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <p>Email *</p>
                        <input type="email" />
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                        <p>Website</p>
                        <input type="text" />
                      </div>
                      <div class="col-lg-12 col-md-12 col-sm-12 comment-form-comment">
                        <p>Website</p>
                        <textarea id="message-box" cols="30" rows="10"></textarea>
                        <input type="submit" value="Post Comment" />
                      </div>
                    </div>
                  </form>
                </div> --}}
              </div>
              <!-- single-blog end -->
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- End Blog Area -->
  @endsection
  